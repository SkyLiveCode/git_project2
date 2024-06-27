const db = require('../config/database');

// ฟังก์ชันเพื่อแสดงหน้า medical equipment information
exports.renderMedicalEquipmentInformation = async (req, res) => {
    try {
        const id_hospital = req.session.id_hospital; // ดึง id_hospital จาก session
        const [medicalEquipments] = await db.query('SELECT * FROM equipment WHERE id_hospital = ?', [id_hospital]);
        const [categories] = await db.query('SELECT id, categorie_name, short_name FROM categories'); // ดึงข้อมูล categories
        res.render('html/pages-medical_equipment', { medicalEquipments, id_hospital, categories });
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
};

// ฟังก์ชันเพื่อเพิ่ม medical equipment ใหม่
exports.addMedicalEquipment = async (req, res) => {
    try {
        const { id_no, id_hospital, id_category } = req.body;
        const [category] = await db.query('SELECT categorie_name FROM categories WHERE id = ?', [id_category]);
        const equipment_name = category[0].categorie_name;
        await db.query('INSERT INTO equipment (equipment_name, `ID. No.`, id_hospital, id_categories) VALUES (?, ?, ?, ?)', [equipment_name, id_no, id_hospital, id_category]);
        res.redirect(`/html/pages-medical_equipment?id=${id_hospital}`);
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
};

// ฟังก์ชันเพื่อลบ medical equipment
exports.deleteMedicalEquipment = async (req, res) => {
    try {
        const { id, id_hospital } = req.body;
        await db.query('DELETE FROM equipment WHERE id = ?', [id]);
        res.redirect(`/html/pages-medical_equipment?id=${id_hospital}`);
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
};

// ฟังก์ชันเพื่ออัปเดต medical equipment
exports.updateMedicalEquipment = async (req, res) => {
    try {
        const { id, equipment_name, id_no, id_hospital } = req.body;
        await db.query('UPDATE equipment SET equipment_name = ?, `ID. No.` = ? WHERE id = ?', [equipment_name, id_no, id]);
        res.redirect(`/html/pages-medical_equipment?id=${id_hospital}`);
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
};
