const db = require('../config/database');
const { sum } = require('../utils/util');

// ฟังก์ชันสำหรับการคำนวณ
const calculateResults = (inputs) => {
    const sumResult = sum(Number(inputs.calinput1), Number(inputs.calinput2));
    const differenceResult = Number(inputs.calinput3) - Number(inputs.calinput4);
    // <<<<<<<<<< เพิ่มรายการ... (result)

    return { sumResult, differenceResult };
};

// ฟังก์ชันแสดงหน้าคำนวณ
exports.showCalculatePage = async (req, res) => {
    try {
        const { equipment_id, id_hospital, id_categories } = req.session;
        const user = req.session.user;

        // ดึงข้อมูล equipment โดยใช้ id_hospital
        const [equipment] = await db.query('SELECT * FROM equipment WHERE id = ?', [equipment_id]);

        // ดึงข้อมูล hospital โดยใช้ id_hospital ที่ได้จาก equipment
        const [hospital] = await db.query('SELECT * FROM hospital WHERE id = ?', [id_hospital]);

        res.render('html/pages-calculates/pages-calculate1', { equipment_id, id_hospital, id_categories, user, equipment, hospital });
    } catch (err) {
        console.error(err);
        res.status(500).send('Server Error');
    }
};

// ฟังก์ชันคำนวณและส่งผลลัพธ์กลับ
exports.calculate = (req, res) => {
    const results = calculateResults(req.body);

    res.json(results);
};

// ฟังก์ชันสำหรับดึงข้อมูล inputs จากฐานข้อมูล
exports.getInputs = async (req, res) => {
    try {
        const equipment_id = req.session.equipment_id; // ใช้ id = equipment_id ที่ถูกส่งมา
        const sql = 'SELECT inputs FROM equipment WHERE id = ?';  
        const [result] = await db.query(sql, [equipment_id]);
        res.json(result[0]); // ส่งข้อมูล inputs กลับไปในรูปแบบ JSON
    } catch (err) {
        console.error(err); // แสดงข้อผิดพลาด
        res.status(500).send('Server Error'); // ส่งข้อความข้อผิดพลาดกลับไปยังไคลเอนต์
    }
};

// ฟังก์ชันสำหรับอัปเดตข้อมูล inputs ในฐานข้อมูล
exports.updateInputs = async (req, res) => {
    try {
        const inputs = req.body.inputs;  // ดึงข้อมูล inputs จาก request body
        const equipment_id = req.session.equipment_id; // ใช้ id = equipment_id ที่ถูกส่งมา
        const sql = 'UPDATE equipment SET inputs = ? WHERE id = ?';  
        await db.query(sql, [JSON.stringify(inputs), equipment_id]);
        res.json({ success: true });  // ส่งข้อมูลตอบกลับว่าอัปเดตสำเร็จ
    } catch (err) {
        console.error(err); // แสดงข้อผิดพลาด
        res.status(500).send('Server Error'); // ส่งข้อความข้อผิดพลาดกลับไปยังไคลเอนต์
    }
};

// ฟังก์ชันสำหรับการเชื่อมต่อ Socket.IO
exports.handleSocketConnection = (io) => {
    io.on('connection', (socket) => {
        console.log('New client connected'); // แสดงข้อความเมื่อมีการเชื่อมต่อใหม่จากไคลเอนต์

        socket.on('calculate', (data) => {
            const results = calculateResults(data);
            socket.emit('calculatedResult', results);
        });

        socket.on('disconnect', () => {
            console.log('Client disconnected'); // แสดงข้อความเมื่อไคลเอนต์ตัดการเชื่อมต่อ
        });
    });
};
