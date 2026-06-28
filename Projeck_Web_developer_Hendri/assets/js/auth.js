// ============================================
// AUTHENTICATION SERVICE - WebDevPro
// ============================================

class AuthService {
    constructor() {
        this.currentUser = null;
        this.userRole = null;
        this.init();
    }

    init() {
        // Listen auth state changes
        auth.onAuthStateChanged(async (user) => {
            if (user) {
                this.currentUser = user;
                await this.loadUserProfile(user.uid);
                this.updateUI();
            } else {
                this.currentUser = null;
                this.userRole = null;
                this.redirectToLogin();
            }
        });
    }

    // Register new user
    async register(email, password, userData) {
        try {
            const userCredential = await auth.createUserWithEmailAndPassword(email, password);
            const user = userCredential.user;

            // Send email verification
            await user.sendEmailVerification();

            // Save user data to Firestore
            await collections.users.doc(user.uid).set({
                uid: user.uid,
                email: email,
                nama: userData.nama || '',
                telepon: userData.telepon || '',
                alamat: userData.alamat || '',
                role: 'user',
                status: 'active',
                createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });

            return { success: true, user: user };
        } catch (error) {
            console.error('Register error:', error);
            return { success: false, error: this.getErrorMessage(error.code) };
        }
    }

    // Login user
    async login(email, password, rememberMe = false) {
        try {
            // Set persistence
            const persistence = rememberMe 
                ? firebase.auth.Auth.Persistence.LOCAL 
                : firebase.auth.Auth.Persistence.SESSION;
            
            await auth.setPersistence(persistence);

            const userCredential = await auth.signInWithEmailAndPassword(email, password);
            const user = userCredential.user;

            // Check if email verified
            if (!user.emailVerified) {
                await auth.signOut();
                return { success: false, error: 'Email belum diverifikasi. Silakan cek inbox Anda.' };
            }

            // Update last login
            await collections.users.doc(user.uid).update({
                lastLogin: firebase.firestore.FieldValue.serverTimestamp()
            });

            return { success: true, user: user };
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, error: this.getErrorMessage(error.code) };
        }
    }

    // Login with Google
    async loginWithGoogle() {
        try {
            const provider = new firebase.auth.GoogleAuthProvider();
            const result = await auth.signInWithPopup(provider);
            const user = result.user;

            // Check if user exists in Firestore
            const userDoc = await collections.users.doc(user.uid).get();
            
            if (!userDoc.exists) {
                // Create new user document
                await collections.users.doc(user.uid).set({
                    uid: user.uid,
                    email: user.email,
                    nama: user.displayName || '',
                    foto: user.photoURL || '',
                    role: 'user',
                    status: 'active',
                    provider: 'google',
                    createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                    updatedAt: firebase.firestore.FieldValue.serverTimestamp()
                });
            } else {
                await collections.users.doc(user.uid).update({
                    lastLogin: firebase.firestore.FieldValue.serverTimestamp()
                });
            }

            return { success: true, user: user };
        } catch (error) {
            console.error('Google login error:', error);
            return { success: false, error: this.getErrorMessage(error.code) };
        }
    }

    // Reset password
    async resetPassword(email) {
        try {
            await auth.sendPasswordResetEmail(email);
            return { success: true, message: 'Email reset password telah dikirim.' };
        } catch (error) {
            console.error('Reset password error:', error);
            return { success: false, error: this.getErrorMessage(error.code) };
        }
    }

    // Update password
    async updatePassword(currentPassword, newPassword) {
        try {
            const user = auth.currentUser;
            const credential = firebase.auth.EmailAuthProvider.credential(
                user.email, 
                currentPassword
            );
            
            await user.reauthenticateWithCredential(credential);
            await user.updatePassword(newPassword);
            
            return { success: true, message: 'Password berhasil diubah.' };
        } catch (error) {
            console.error('Update password error:', error);
            return { success: false, error: this.getErrorMessage(error.code) };
        }
    }

    // Update profile
    async updateProfile(userId, data) {
        try {
            await collections.users.doc(userId).update({
                ...data,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });

            // Update display name if provided
            if (data.nama) {
                await auth.currentUser.updateProfile({
                    displayName: data.nama
                });
            }

            return { success: true, message: 'Profil berhasil diperbarui.' };
        } catch (error) {
            console.error('Update profile error:', error);
            return { success: false, error: error.message };
        }
    }

    // Upload avatar
    async uploadAvatar(userId, file) {
        try {
            const storageRef = storage.ref(`avatars/${userId}`);
            await storageRef.put(file);
            const downloadURL = await storageRef.getDownloadURL();

            await collections.users.doc(userId).update({
                foto: downloadURL,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });

            await auth.currentUser.updateProfile({
                photoURL: downloadURL
            });

            return { success: true, url: downloadURL };
        } catch (error) {
            console.error('Upload avatar error:', error);
            return { success: false, error: error.message };
        }
    }

    // Load user profile
    async loadUserProfile(uid) {
        try {
            const doc = await collections.users.doc(uid).get();
            if (doc.exists) {
                const data = doc.data();
                this.userRole = data.role || 'user';
                this.userProfile = data;
            }
        } catch (error) {
            console.error('Load profile error:', error);
        }
    }

    // Check if admin
    isAdmin() {
        return this.userRole === 'admin';
    }

    // Check if authenticated
    isAuthenticated() {
        return !!this.currentUser;
    }

    // Logout
    async logout() {
        try {
            await auth.signOut();
            this.currentUser = null;
            this.userRole = null;
            return { success: true };
        } catch (error) {
            console.error('Logout error:', error);
            return { success: false, error: error.message };
        }
    }

    // Update UI based on auth state
    updateUI() {
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');
        const userMenu = document.getElementById('userMenu');
        const userName = document.getElementById('userName');

        if (this.currentUser) {
            if (loginBtn) loginBtn.classList.add('hidden');
            if (registerBtn) registerBtn.classList.add('hidden');
            if (userMenu) {
                userMenu.classList.remove('hidden');
                if (userName) userName.textContent = this.currentUser.displayName || 'User';
            }
        } else {
            if (loginBtn) loginBtn.classList.remove('hidden');
            if (registerBtn) registerBtn.classList.remove('hidden');
            if (userMenu) userMenu.classList.add('hidden');
        }
    }

    // Redirect to login
    redirectToLogin() {
        const publicPages = ['index.html', 'tentang.html', 'layanan.html', 
                            'portofolio.html', 'harga.html', 'blog.html', 
                            'kontak.html', 'login.html', 'register.html', 
                            'lupa-password.html', 'faq.html'];
        
        const currentPage = window.location.pathname.split('/').pop() || 'index.html';
        
        if (!publicPages.includes(currentPage) && !currentPage.includes('user/')) {
            window.location.href = 'login.html';
        }
    }

    // Protect admin routes
    protectAdminRoute() {
        if (!this.isAuthenticated() || !this.isAdmin()) {
            window.location.href = '../index.html';
        }
    }

    // Get error message
    getErrorMessage(code) {
        const messages = {
            'auth/email-already-in-use': 'Email sudah terdaftar.',
            'auth/invalid-email': 'Format email tidak valid.',
            'auth/weak-password': 'Password minimal 6 karakter.',
            'auth/user-not-found': 'Email tidak terdaftar.',
            'auth/wrong-password': 'Password salah.',
            'auth/invalid-credential': 'Email atau password salah.',
            'auth/too-many-requests': 'Terlalu banyak percobaan. Silakan coba lagi nanti.',
            'auth/user-disabled': 'Akun ini telah dinonaktifkan.',
            'auth/requires-recent-login': 'Silakan login ulang untuk melanjutkan.',
            'auth/popup-closed-by-user': 'Login dibatalkan.',
            'auth/cancelled-popup-request': 'Terlalu banyak popup login.',
            'auth/account-exists-with-different-credential': 'Akun dengan email ini sudah ada dengan metode login berbeda.'
        };
        return messages[code] || 'Terjadi kesalahan. Silakan coba lagi.';
    }
}

// Initialize auth service
const authService = new AuthService();