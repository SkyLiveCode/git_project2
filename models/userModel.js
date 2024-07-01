// นำเข้าโมดูลที่จำเป็น
const db = require('../config/database'); // นำเข้าโมดูลการเชื่อมต่อฐานข้อมูล
const bcrypt = require('bcrypt'); // นำเข้าโมดูล bcrypt สำหรับการเข้ารหัสรหัสผ่าน

// ฟังก์ชัน getUsers สำหรับดึงข้อมูลผู้ใช้ทั้งหมด (ไม่รวม password)
exports.getUsers = async () => {
  try {
    const query = 'SELECT id, name, email, picture, picture_sign, verify, accounts, created_at FROM users'; // คำสั่ง SQL สำหรับดึงข้อมูลผู้ใช้ (ไม่รวม password)
    const [results] = await db.query(query); // รันคำสั่ง SQL
    return results; // ส่งผลลัพธ์ผู้ใช้ที่พบ
  } catch (err) {
    console.error('Error in getUsers:', err);
    throw err;
  }
};

// ฟังก์ชัน findUser สำหรับค้นหาผู้ใช้ในฐานข้อมูลโดยอีเมลและรหัสผ่าน
exports.findUser = async (email, password) => {
  try {
    const user = await this.findUserByEmailWithPassword(email);
    if (!user) return null;

    const isMatch = await bcrypt.compare(password, user.password); // เปรียบเทียบรหัสผ่าน
    if (!isMatch) return null; // ถ้ารหัสผ่านไม่ตรงกัน ส่ง null กลับไป

    delete user.password; // ลบรหัสผ่านออกจาก object ก่อนส่งกลับ
    return user; // ถ้ารหัสผ่านตรงกัน ส่งข้อมูลผู้ใช้กลับไป
  } catch (err) {
    console.error('Error in findUser:', err);
    throw err;
  }
};

// ฟังก์ชัน findUserByEmail สำหรับค้นหาผู้ใช้โดยอีเมล (ไม่รวม password)
exports.findUserByEmail = async (email) => {
  try {
    const query = 'SELECT id, name, email, picture, picture_sign, verify, accounts, created_at FROM users WHERE email = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยอีเมล (ไม่รวม password)
    const [results] = await db.query(query, [email]); // รันคำสั่ง SQL
    return results[0]; // ส่งผลลัพธ์ผู้ใช้ที่พบ (หรือ undefined ถ้าไม่พบผู้ใช้)
  } catch (err) {
    console.error('Error in findUserByEmail:', err);
    throw err;
  }
};

// ฟังก์ชัน findUserByEmailWithPassword สำหรับค้นหาผู้ใช้โดยอีเมล (รวม password)
exports.findUserByEmailWithPassword = async (email) => {
  try {
    const query = 'SELECT * FROM users WHERE email = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยอีเมล (รวม password)
    const [results] = await db.query(query, [email]); // รันคำสั่ง SQL
    return results[0]; // ส่งผลลัพธ์ผู้ใช้ที่พบ (หรือ undefined ถ้าไม่พบผู้ใช้)
  } catch (err) {
    console.error('Error in findUserByEmailWithPassword:', err);
    throw err;
  }
};

// ฟังก์ชัน findUserByName สำหรับค้นหาผู้ใช้โดยชื่อ (ไม่รวม password)
exports.findUserByName = async (name) => {
  try {
    const query = 'SELECT id, name, email, picture, picture_sign, verify, accounts, created_at FROM users WHERE name = ?'; // คำสั่ง SQL สำหรับค้นหาผู้ใช้โดยชื่อ (ไม่รวม password)
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
