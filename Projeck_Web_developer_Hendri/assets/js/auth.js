// ============================================
// AUTHENTICATION FUNCTIONS
// ============================================

// ============================================
// LOGIN
// ============================================
async function loginUser(email, password) {
    try {
        const userCredential = await auth.signInWithEmailAndPassword(email, password);
        const user = userCredential.user;

        // Cek apakah user memiliki role admin
        const doc = await db.collection('users').doc(user.uid).get();
        if (doc.exists && doc.data().role === 'admin') {
            // Simpan session
            sessionStorage.setItem('webdevpro_session', JSON.stringify({
                uid: user.uid,
                email: user.email,
                role: doc.data().role,
                nama: doc.data().nama
            }));
            return { success: true, user: doc.data() };
        } else {
            await auth.signOut();
            return { success: false, message: 'Akun ini bukan admin!' };
        }
    } catch (error) {
        console.error('Login error:', error);
        let message = 'Gagal login. Periksa email dan password Anda.';
        if (error.code === 'auth/user-not-found') {
            message = 'Email tidak ditemukan!';
        } else if (error.code === 'auth/wrong-password') {
            message = 'Password salah!';
        } else if (error.code === 'auth/too-many-requests') {
            message = 'Terlalu banyak percobaan. Coba lagi nanti.';
        }
        return { success: false, message };
    }
}

// ============================================
// REGISTER
// ============================================
async function registerUser(email, password, nama, telepon = '') {
    try {
        const userCredential = await auth.createUserWithEmailAndPassword(email, password);
        const user = userCredential.user;

        // Simpan data user ke Firestore
        await db.collection('users').doc(user.uid).set({
            uid: user.uid,
            nama: nama,
            email: email,
            telepon: telepon,
            role: 'user', // Default role user
            status: 'aktif',
            createdAt: firebase.firestore.FieldValue.serverTimestamp(),
            updatedAt: firebase.firestore.FieldValue.serverTimestamp()
        });

        return { success: true, user: user };
    } catch (error) {
        console.error('Register error:', error);
        let message = 'Gagal mendaftar.';
        if (error.code === 'auth/email-already-in-use') {
            message = 'Email sudah digunakan!';
        } else if (error.code === 'auth/weak-password') {
            message = 'Password terlalu lemah. Gunakan minimal 6 karakter.';
        }
        return { success: false, message };
    }
}

// ============================================
// RESET PASSWORD
// ============================================
async function resetPassword(email) {
    try {
        await auth.sendPasswordResetEmail(email);
        return { success: true, message: 'Email reset password telah dikirim!' };
    } catch (error) {
        console.error('Reset password error:', error);
        let message = 'Gagal mengirim email reset.';
        if (error.code === 'auth/user-not-found') {
            message = 'Email tidak ditemukan!';
        }
        return { success: false, message };
    }
}

// ============================================
// UPDATE PROFILE
// ============================================
async function updateUserProfile(uid, data) {
    try {
        await db.collection('users').doc(uid).update({
            ...data,
            updatedAt: firebase.firestore.FieldValue.serverTimestamp()
        });
        return { success: true };
    } catch (error) {
        console.error('Update profile error:', error);
        return { success: false, message: error.message };
    }
}

// ============================================
// GET USER DATA
// ============================================
async function getUserData(uid) {
    try {
        const doc = await db.collection('users').doc(uid).get();
        if (doc.exists) {
            return { success: true, data: doc.data() };
        } else {
            return { success: false, message: 'User tidak ditemukan' };
        }
    } catch (error) {
        console.error('Get user data error:', error);
        return { success: false, message: error.message };
    }
}

// ============================================
// GET ALL USERS (Admin Only)
// ============================================
async function getAllUsers() {
    try {
        const snapshot = await db.collection('users').orderBy('createdAt', 'desc').get();
        const users = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        return { success: true, users };
    } catch (error) {
        console.error('Get all users error:', error);
        return { success: false, message: error.message };
    }
}

// ============================================
// DELETE USER (Admin Only)
// ============================================
async function deleteUser(uid) {
    try {
        await db.collection('users').doc(uid).delete();
        return { success: true };
    } catch (error) {
        console.error('Delete user error:', error);
        return { success: false, message: error.message };
    }
}

// ============================================
// CHECK AUTH STATE
// ============================================
function onAuthStateChanged(callback) {
    return auth.onAuthStateChanged(callback);
}

// ============================================
// SESSION MANAGEMENT
// ============================================
function getSession() {
    try {
        const session = sessionStorage.getItem('webdevpro_session');
        return session ? JSON.parse(session) : null;
    } catch (error) {
        return null;
    }
}

function setSession(data) {
    sessionStorage.setItem('webdevpro_session', JSON.stringify(data));
}

function clearSession() {
    sessionStorage.removeItem('webdevpro_session');
}

// ============================================
// EXPORT FUNCTIONS
// ============================================
console.log('🔐 Auth functions loaded successfully!');