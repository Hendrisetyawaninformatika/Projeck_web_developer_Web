// ============================================================
// AUTH HELPER FUNCTIONS - COMPLETE
// ============================================================

/**
 * Get current user's role from Firestore with retry
 * @returns {Promise<string>} - 'admin' or 'user'
 */
async function getUserRole() {
    try {
        const user = firebase.auth().currentUser;
        if (!user) return null;

        let retries = 3;
        let lastError = null;

        while (retries > 0) {
            try {
                const docRef = firebase.firestore().collection('users').doc(user.uid);
                const docSnap = await docRef.get();

                if (docSnap.exists) {
                    return docSnap.data().role || 'user';
                }
                
                // If document doesn't exist, create it
                await docRef.set({
                    nama: user.displayName || 'Pengguna',
                    email: user.email,
                    role: 'user',
                    createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                    uid: user.uid,
                    photoURL: user.photoURL || null
                });
                return 'user';
            } catch (e) {
                lastError = e;
                retries--;
                if (retries > 0) {
                    await new Promise(resolve => setTimeout(resolve, 500));
                }
            }
        }

        console.warn('Error getting user role after retries:', lastError);
        return 'user';
    } catch (error) {
        console.error('Error getting user role:', error);
        return 'user';
    }
}

/**
 * Check if current user is admin
 * @returns {Promise<boolean>}
 */
async function isAdmin() {
    try {
        const role = await getUserRole();
        return role === 'admin';
    } catch (error) {
        console.error('Error checking admin:', error);
        return false;
    }
}

/**
 * Check if user is authenticated
 * @returns {Promise<boolean>}
 */
function isAuthenticated() {
    return new Promise((resolve) => {
        const unsubscribe = firebase.auth().onAuthStateChanged((user) => {
            unsubscribe();
            resolve(!!user);
        });
    });
}

/**
 * Require authentication - redirect if not logged in
 * @param {string} redirectUrl - URL to redirect if not authenticated
 * @returns {Promise<boolean>} - true if authenticated
 */
function requireAuth(redirectUrl = 'login.html') {
    return new Promise((resolve) => {
        const unsubscribe = firebase.auth().onAuthStateChanged((user) => {
            unsubscribe();
            if (!user) {
                window.location.href = redirectUrl;
                resolve(false);
            } else {
                resolve(true);
            }
        });
    });
}

/**
 * Require admin - redirect if not admin
 * @param {string} redirectUrl - URL to redirect if not admin
 * @returns {Promise<boolean>} - true if admin
 */
async function requireAdmin(redirectUrl = '../index.html') {
    try {
        const user = firebase.auth().currentUser;
        if (!user) {
            window.location.href = 'login.html';
            return false;
        }

        const role = await getUserRole();
        if (role !== 'admin') {
            window.location.href = redirectUrl;
            return false;
        }
        return true;
    } catch (error) {
        console.error('Error checking admin:', error);
        window.location.href = 'login.html';
        return false;
    }
}

/**
 * Check admin for admin pages
 * @returns {Promise<void>}
 */
async function checkAdmin() {
    try {
        const user = firebase.auth().currentUser;
        if (!user) {
            window.location.href = 'login.html';
            return;
        }

        const role = await getUserRole();
        if (role !== 'admin') {
            window.location.href = '../index.html';
            return;
        }
        console.log('✅ Admin access granted');
    } catch (error) {
        console.error('Error checking admin:', error);
        window.location.href = 'login.html';
    }
}

/**
 * Logout user
 * @param {string} redirectUrl - URL to redirect after logout
 */
function logoutUser(redirectUrl = 'login.html') {
    firebase.auth().signOut()
        .then(() => {
            localStorage.removeItem('webdevpro_session');
            sessionStorage.clear();
            window.location.href = redirectUrl;
        })
        .catch((error) => {
            console.error('Logout error:', error);
            window.location.href = redirectUrl;
        });
}

/**
 * Get current user data with retry
 * @returns {Promise<Object|null>}
 */
async function getCurrentUserData() {
    try {
        const user = firebase.auth().currentUser;
        if (!user) return null;

        let retries = 3;
        let lastError = null;

        while (retries > 0) {
            try {
                const docRef = firebase.firestore().collection('users').doc(user.uid);
                const docSnap = await docRef.get();

                const baseData = {
                    uid: user.uid,
                    email: user.email,
                    displayName: user.displayName,
                    photoURL: user.photoURL
                };

                if (docSnap.exists) {
                    return {
                        ...baseData,
                        ...docSnap.data()
                    };
                }
                return baseData;
            } catch (e) {
                lastError = e;
                retries--;
                if (retries > 0) {
                    await new Promise(resolve => setTimeout(resolve, 500));
                }
            }
        }

        console.warn('Error getting user data after retries:', lastError);
        return null;
    } catch (error) {
        console.error('Error getting user data:', error);
        return null;
    }
}

/**
 * Update user data in Firestore
 * @param {Object} data - Data to update
 * @returns {Promise<boolean>}
 */
async function updateUserData(data) {
    try {
        const user = firebase.auth().currentUser;
        if (!user) return false;

        const docRef = firebase.firestore().collection('users').doc(user.uid);
        await docRef.update({
            ...data,
            updatedAt: firebase.firestore.FieldValue.serverTimestamp()
        });
        return true;
    } catch (error) {
        console.error('Error updating user data:', error);
        return false;
    }
}

/**
 * Create admin user (for development)
 * @param {string} email - Admin email
 * @returns {Promise<boolean>}
 */
async function makeAdmin(email) {
    try {
        const usersSnapshot = await firebase.firestore()
            .collection('users')
            .where('email', '==', email)
            .get();

        if (usersSnapshot.empty) {
            console.error('User not found:', email);
            return false;
        }

        const userDoc = usersSnapshot.docs[0];
        await userDoc.ref.update({
            role: 'admin',
            updatedAt: firebase.firestore.FieldValue.serverTimestamp()
        });
        console.log('✅ User promoted to admin:', email);
        return true;
    } catch (error) {
        console.error('Error making admin:', error);
        return false;
    }
}

// ============================================================
// EXPOSE FUNCTIONS TO GLOBAL SCOPE
// ============================================================
window.getUserRole = getUserRole;
window.isAdmin = isAdmin;
window.isAuthenticated = isAuthenticated;
window.requireAuth = requireAuth;
window.requireAdmin = requireAdmin;
window.checkAdmin = checkAdmin;
window.logoutUser = logoutUser;
window.getCurrentUserData = getCurrentUserData;
window.updateUserData = updateUserData;
window.makeAdmin = makeAdmin;

console.log('✅ Auth helper functions loaded!');