// Firebase Configuration - WebDevPro
// Ganti dengan konfigurasi proyek Firebase Anda sendiri

const firebaseConfig = {
    apiKey: "AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
    authDomain: "webdevpro-XXXXX.firebaseapp.com",
    projectId: "webdevpro-XXXXX",
    storageBucket: "webdevpro-XXXXX.appspot.com",
    messagingSenderId: "123456789012",
    appId: "1:123456789012:web:XXXXXXXXXXXXXXXX",
    measurementId: "G-XXXXXXXXXX"
};

// Inisialisasi Firebase
firebase.initializeApp(firebaseConfig);

// Export instances
const auth = firebase.auth();
const db = firebase.firestore();
const storage = firebase.storage();
const analytics = firebase.analytics();

// Collection references
const collections = {
    users: db.collection('users'),
    pesanans: db.collection('pesanans'),
    pakets: db.collection('pakets'),
    portofolios: db.collection('portofolios'),
    blogs: db.collection('blogs'),
    testimonis: db.collection('testimonis'),
    faqs: db.collection('faqs'),
    kontaks: db.collection('kontaks'),
    settings: db.collection('settings')
};

console.log('Firebase initialized successfully');