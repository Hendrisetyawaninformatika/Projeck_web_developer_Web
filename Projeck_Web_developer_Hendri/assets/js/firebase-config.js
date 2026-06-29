// ============================================
// FIREBASE CONFIGURATION
// ============================================

// Konfigurasi Firebase - Ganti dengan config Anda sendiri
const firebaseConfig = {
    apiKey: "AIzaSyDummyKeyForDemo",
    authDomain: "webdevpro-demo.firebaseapp.com",
    projectId: "webdevpro-demo",
    storageBucket: "webdevpro-demo.appspot.com",
    messagingSenderId: "123456789",
    appId: "1:123456789:web:abcdef123456"
};

// Initialize Firebase
if (!firebase.apps.length) {
    firebase.initializeApp(firebaseConfig);
}

// Ekspor Firebase services
const auth = firebase.auth();
const db = firebase.firestore();

// ============================================
// FUNGSI UTILITY
// ============================================

// Format Rupiah
function formatRupiah(angka) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
}

// Format Tanggal
function formatDate(timestamp) {
    if (!timestamp) return '-';
    const date = timestamp.toDate ? timestamp.toDate() : new Date(timestamp);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}

// Generate Kode Pesanan
function generateOrderCode() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const random = String(Math.floor(Math.random() * 10000)).padStart(4, '0');
    return `ORD-${year}${month}${day}-${random}`;
}

// ============================================
// AUTH FUNCTIONS
// ============================================

// Check Admin
async function checkAdmin() {
    return new Promise((resolve, reject) => {
        auth.onAuthStateChanged(async (user) => {
            if (!user) {
                window.location.href = '../login.html';
                return reject();
            }

            try {
                const doc = await db.collection('users').doc(user.uid).get();
                if (doc.exists && doc.data().role === 'admin') {
                    resolve(user);
                } else {
                    window.location.href = '../login.html';
                    reject();
                }
            } catch (error) {
                console.error('Error checking admin:', error);
                window.location.href = '../login.html';
                reject();
            }
        });
    });
}

// Get Current User
async function getCurrentUser() {
    return new Promise((resolve) => {
        auth.onAuthStateChanged(async (user) => {
            if (user) {
                try {
                    const doc = await db.collection('users').doc(user.uid).get();
                    resolve({ uid: user.uid, ...doc.data() });
                } catch (error) {
                    console.error('Error getting user data:', error);
                    resolve(null);
                }
            } else {
                resolve(null);
            }
        });
    });
}

// Logout
function logoutUser() {
    return auth.signOut();
}

console.log('🔥 Firebase Config loaded successfully!');