// ============================================================
// FIREBASE CONFIGURATION
// ============================================================
// 🔴 PERINGATAN: GANTI DENGAN KONFIGURASI FIREBASE ANDA!
// Dapatkan dari: Firebase Console → Project Settings → Your apps

console.log('🔥 Initializing Firebase...');
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
let auth, db;

try {
    if (typeof firebase !== 'undefined') {
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
            console.log('✅ Firebase initialized successfully');
        } else {
            console.log('✅ Firebase already initialized');
        }
        
        auth = firebase.auth();
        db = firebase.firestore();
        
        // Enable offline persistence
        db.enablePersistence()
            .then(() => {
                console.log('✅ Firestore persistence enabled');
            })
            .catch((err) => {
                console.warn('⚠️ Firestore persistence error:', err);
            });
            
        console.log('✅ Firebase services ready');
    } else {
        console.error('❌ Firebase SDK not loaded!');
    }
} catch (error) {
    console.error('❌ Firebase initialization error:', error);
}

// Export for use in other files
window.auth = auth;
window.db = db;

console.log('📁 File location: ' + window.location.pathname);
console.log('✅ Firebase Config loaded!');