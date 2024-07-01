// นำเข้าโมดูลที่จำเป็น
const db = require('../config/database'); // นำเข้าโมดูลการเชื่อมต่อฐานข้อมูล
const bcrypt = require('bcrypt'); // นำเข้าโมดูล bcrypt สำหรับการเข้ารหัสรหัสผ่าน

// ฟังก์ชัน getUsers สำหรับดึงข้อมูลผู้ใช้ทั้งหมด
exports.getUsers = async () => {
  try {
    const query = 'SELECT name, picture_sign FROM users'; // คำสั่ง SQL สำหรับดึงข้อมูลผู้ใช้
    const [results] = await db.query(query); // รันคำสั่ง SQL
    return results; // ส่งผลลัพธ์ผู้ใช้ที่พบ
  } catch (err) {
    console.error('Error in getUsers:', err);
    throw err;
  }
};

// ฟังก์ชัน findUser สำหรับค้นหาผู้ใช้ในฐานข้อมูล
exports.findUser = async (email, password) => {
  try {
    const query = 'SELECT * FROM users WHERE email = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยอีเมล
    const [results] = await db.query(query, [email]); // รันคำสั่ง SQL
    if (results.length === 0) return null; // ถ้าไม่พบผู้ใช้ ส่ง null กลับไป

    const user = results[0]; // เก็บผลลัพธ์ผู้ใช้ที่พบ
    const isMatch = await bcrypt.compare(password, user.password); // เปรียบเทียบรหัสผ่านที่กรอกกับรหัสผ่านที่เข้ารหัสในฐานข้อมูล
    if (!isMatch) return null; // ถ้ารหัสผ่านไม่ตรงกัน ส่ง null กลับไป
    return user; // ถ้ารหัสผ่านตรงกัน ส่งข้อมูลผู้ใช้กลับไป
  } catch (err) {
    console.error('Error in findUser:', err);
    throw err;
  }
};

// ฟังก์ชัน findUserByEmail สำหรับค้นหาผู้ใช้โดยอีเมล
exports.findUserByEmail = async (email) => {
  try {
    const query = 'SELECT * FROM users WHERE email = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยอีเมล
    const [results] = await db.query(query, [email]); // รันคำสั่ง SQL
    return results[0]; // ส่งผลลัพธ์ผู้ใช้ที่พบ (หรือ undefined ถ้าไม่พบผู้ใช้)
  } catch (err) {
    console.error('Error in findUserByEmail:', err);
    throw err;
  }
};

// ฟังก์ชัน findUserByName สำหรับค้นหาผู้ใช้โดยชื่อ
exports.findUserByName = async (name) => {
  try {
    const query = 'SELECT * FROM users WHERE name = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยชื่อ
    const [results] = await db.query(query, [name]); // รันคำสั่ง SQL
    return results[0]; // ส่งผลลัพธ์ผู้ใช้ที่พบ (หรือ undefined ถ้าไม่พบผู้ใช้)
  } catch (err) {
    console.error('Error in findUserByName:', err);
    throw err;
  }
};

// ฟังก์ชัน createUser สำหรับสร้างผู้ใช้ใหม่ในฐานข้อมูล
exports.createUser = async (userData) => {
  try {
    const hash = await bcrypt.hash(userData.password, 10); // เข้ารหัสรหัสผ่านของผู้ใช้
    const query = 'INSERT INTO users (name, email, password, picture, picture_sign) VALUES (?, ?, ?, ?, ?)'; // คำสั่ง SQL สำหรับเพิ่มผู้ใช้ใหม่
    const [results] = await db.query(query, [userData.name, userData.email, hash, '1.png', 'signature3.png']); // รันคำสั่ง SQL พร้อมตั้งค่า picture และ picture_sign เป็นค่าเริ่มต้น
    return results.insertId; // ถ้าเพิ่มผู้ใช้สำเร็จ ส่ง ID ของผู้ใช้ใหม่กลับไป
  } catch (err) {
    console.error('Error in createUser:', err);
    throw err;
  }
};
