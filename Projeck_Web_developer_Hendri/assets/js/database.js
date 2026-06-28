// ============================================
// DATABASE SERVICE - WebDevPro
// ============================================

class DatabaseService {
    
    // ========== PESANAN ==========
    
    async createPesanan(data) {
        try {
            const pesanan = {
                ...data,
                orderId: await this.generateOrderId(),
                status: 'menunggu',
                progress: 0,
                createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            };
            
            const docRef = await collections.pesanans.add(pesanan);
            return { success: true, id: docRef.id, orderId: pesanan.orderId };
        } catch (error) {
            console.error('Create pesanan error:', error);
            return { success: false, error: error.message };
        }
    }

    async getPesanans(filters = {}) {
        try {
            let query = collections.pesanans.orderBy('createdAt', 'desc');

            if (filters.status) query = query.where('status', '==', filters.status);
            if (filters.paket) query = query.where('paket', '==', filters.paket);
            if (filters.userId) query = query.where('userId', '==', filters.userId);

            const snapshot = await query.get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get pesanans error:', error);
            return [];
        }
    }

    async updatePesananStatus(id, status, progress = null, note = '') {
        try {
            const updateData = {
                status,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            };
            if (progress !== null) updateData.progress = progress;
            if (note) updateData.statusNote = note;

            await collections.pesanans.doc(id).update(updateData);
            return { success: true };
        } catch (error) {
            console.error('Update pesanan error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== PAKET ==========

    async getPakets() {
        try {
            const snapshot = await collections.pakets.where('isActive', '==', true).get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get pakets error:', error);
            return [];
        }
    }

    async createPaket(data) {
        try {
            const docRef = await collections.pakets.add({
                ...data,
                createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Create paket error:', error);
            return { success: false, error: error.message };
        }
    }

    async updatePaket(id, data) {
        try {
            await collections.pakets.doc(id).update({
                ...data,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });
            return { success: true };
        } catch (error) {
            console.error('Update paket error:', error);
            return { success: false, error: error.message };
        }
    }

    async deletePaket(id) {
        try {
            await collections.pakets.doc(id).delete();
            return { success: true };
        } catch (error) {
            console.error('Delete paket error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== PORTOFOLIO ==========

    async getPortofolios(filters = {}) {
        try {
            let query = collections.portofolios.orderBy('createdAt', 'desc');

            if (filters.category) query = query.where('category', '==', filters.category);
            if (filters.status) query = query.where('status', '==', filters.status);

            const snapshot = await query.get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get portofolios error:', error);
            return [];
        }
    }

    async createPortofolio(data, imageFile) {
        try {
            let imageUrl = '';
            if (imageFile) {
                const storageRef = storage.ref(`portofolio/${Date.now()}_${imageFile.name}`);
                await storageRef.put(imageFile);
                imageUrl = await storageRef.getDownloadURL();
            }

            const docRef = await collections.portofolios.add({
                ...data,
                image: imageUrl,
                createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });

            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Create portofolio error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== BLOG ==========

    async getBlogs(filters = {}) {
        try {
            let query = collections.blogs.orderBy('createdAt', 'desc');

            if (filters.category) query = query.where('category', '==', filters.category);
            if (filters.status) query = query.where('status', '==', filters.status);
            if (filters.featured) query = query.where('isFeatured', '==', true);

            const snapshot = await query.get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get blogs error:', error);
            return [];
        }
    }

    async createBlog(data, imageFile) {
        try {
            let imageUrl = '';
            if (imageFile) {
                const storageRef = storage.ref(`blog/${Date.now()}_${imageFile.name}`);
                await storageRef.put(imageFile);
                imageUrl = await storageRef.getDownloadURL();
            }

            const docRef = await collections.blogs.add({
                ...data,
                image: imageUrl,
                views: 0,
                createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });

            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Create blog error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== TESTIMONI ==========

    async getTestimonis() {
        try {
            const snapshot = await collections.testimonis
                .where('isActive', '==', true)
                .orderBy('createdAt', 'desc')
                .get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get testimonis error:', error);
            return [];
        }
    }

    async createTestimoni(data) {
        try {
            const docRef = await collections.testimonis.add({
                ...data,
                isActive: false, // Need admin approval
                createdAt: firebase.firestore.FieldValue.serverTimestamp()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Create testimoni error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== FAQ ==========

    async getFaqs() {
        try {
            const snapshot = await collections.faqs
                .where('isActive', '==', true)
                .orderBy('order', 'asc')
                .get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get faqs error:', error);
            return [];
        }
    }

    // ========== KONTAK ==========

    async submitKontak(data) {
        try {
            const docRef = await collections.kontaks.add({
                ...data,
                status: 'unread',
                createdAt: firebase.firestore.FieldValue.serverTimestamp()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Submit kontak error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== SETTINGS ==========

    async getSettings() {
        try {
            const doc = await collections.settings.doc('general').get();
            return doc.exists ? doc.data() : null;
        } catch (error) {
            console.error('Get settings error:', error);
            return null;
        }
    }

    async updateSettings(data) {
        try {
            await collections.settings.doc('general').set({
                ...data,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            }, { merge: true });
            return { success: true };
        } catch (error) {
            console.error('Update settings error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== USERS ==========

    async getUsers() {
        try {
            const snapshot = await collections.users.orderBy('createdAt', 'desc').get();
            return snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
        } catch (error) {
            console.error('Get users error:', error);
            return [];
        }
    }

    async updateUserRole(userId, role) {
        try {
            await collections.users.doc(userId).update({
                role,
                updatedAt: firebase.firestore.FieldValue.serverTimestamp()
            });
            return { success: true };
        } catch (error) {
            console.error('Update user role error:', error);
            return { success: false, error: error.message };
        }
    }

    // ========== UTILITIES ==========

    async generateOrderId() {
        const date = new Date();
        const year = date.getFullYear();
        const count = await collections.pesanans
            .where('createdAt', '>=', new Date(year, 0, 1))
            .get();
        const number = String(count.size + 1).padStart(4, '0');
        return `ORD-${year}-${number}`;
    }

    // Real-time listener
    onPesanansUpdate(callback) {
        return collections.pesanans
            .orderBy('createdAt', 'desc')
            .onSnapshot(snapshot => {
                const data = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
                callback(data);
            });
    }

    onNotificationsUpdate(userId, callback) {
        return collections.pesanans
            .where('userId', '==', userId)
            .where('status', 'in', ['menunggu', 'diproses', 'development'])
            .onSnapshot(snapshot => {
                callback(snapshot.size);
            });
    }
}

// Initialize database service
const dbService = new DatabaseService();