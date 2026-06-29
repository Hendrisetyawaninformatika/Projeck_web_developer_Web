// ============================================================
// FIREBASE CONFIGURATION - WEB DEFELOPER HENDRI
// ============================================================

console.log('🔥 Initializing Firebase...');

// Konfigurasi Firebase dari project Anda
const firebaseConfig = {
    apiKey: "AIzaSyDvIsc3igsRSbjYlv9i3adSQSFIABoTdM8",
    authDomain: "web-defeloper-hendri.firebaseapp.com",
    databaseURL: "https://web-defeloper-hendri-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "web-defeloper-hendri",
    storageBucket: "web-defeloper-hendri.firebasestorage.app",
    messagingSenderId: "308915481624",
    appId: "1:308915481624:web:c71ec63a419143c80fa76d",
    measurementId: "G-ZEJEVKSBSP"
};

// Initialize Firebase
try {
    if (typeof firebase !== 'undefined') {
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
            console.log('✅ Firebase initialized successfully');
            console.log('📁 Project: web-defeloper-hendri');
        } else {
            console.log('✅ Firebase already initialized');
        }
        
        // Initialize services
        var auth = firebase.auth();
        var db = firebase.firestore();
        
        // Enable offline persistence with sync tabs
        db.enablePersistence({ synchronizeTabs: true })
            .then(() => {
                console.log('✅ Firestore persistence enabled');
            })
            .catch((err) => {
                console.warn('⚠️ Firestore persistence error:', err.message);
                console.log('ℹ️ Using memory cache instead');
            });
            
        console.log('✅ Firebase services ready');
    } else {
        console.error('❌ Firebase SDK not loaded!');
    }
} catch (error) {
    console.error('❌ Firebase initialization error:', error);
}

// Export untuk digunakan di file lain
window.auth = auth;
window.db = db;

console.log('📁 File location: ' + window.location.pathname);
console.log('✅ Firebase Config loaded!');