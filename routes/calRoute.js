// นำเข้าโมดูล express
const express = require('express');
// สร้าง router object จาก express
const router = express.Router();
// นำเข้า controller สำหรับการจัดการหน้าคำนวณ
const calController1 = require('../controllers/calController1');
const calController2 = require('../controllers/calController2');
// นำเข้าโมดูล middleware
const { checkAuthenticated } = require('../middleware/authMiddleware'); 

// กำหนดเส้นทาง GET สำหรับการแสดงหน้าคำนวณ และเรียกใช้ฟังก์ชัน showCalculatePage จาก calController1 และ calController2
router.get('/cal1', checkAuthenticated, calController1.showCalculatePage);
router.get('/cal2', checkAuthenticated, calController2.showCalculatePage);

// เส้นทางสำหรับดึงข้อมูล inputs จากฐานข้อมูล
router.get('/get-inputs1', calController1.getInputs);
router.get('/get-inputs2', calController2.getInputs);

// เส้นทางสำหรับอัปเดตข้อมูล inputs ในฐานข้อมูล
router.post('/update-inputs1', calController1.updateInputs);
router.post('/update-inputs2', calController2.updateInputs);

// ส่งออกโมดูล router เพื่อให้สามารถใช้งานในไฟล์อื่นได้
module.exports = router;
