// Firebase Configuration - WebDevPro
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

const auth = firebase.auth();
const db = firebase.firestore();
const storage = firebase.storage();

// 🔥 TAMBAHKAN INI UNTUK GOOGLE LOGIN - SETTING PERSISTENCE
auth.setPersistence(firebase.auth.Auth.Persistence.LOCAL)
    .then(() => console.log('🔥 Auth persistence set to LOCAL'))
    .catch((error) => console.error('Error setting persistence:', error));

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

console.log('✅ Firebase initialized successfully');