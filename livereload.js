const livereload = require('livereload');
const path = require('path');

// สร้างเซิร์ฟเวอร์ livereload
const server = livereload.createServer({
    exts: ['html', 'css', 'js', 'ejs'], // ระบุส่วนขยายของไฟล์ที่ต้องการดูการเปลี่ยนแปลง
    debug: true
});

// เพิ่มโฟลเดอร์ที่ต้องการตรวจสอบ
server.watch(path.join(__dirname, 'public'));
server.watch(path.join(__dirname, 'views'));

server.server.once("connection", () => {
    setTimeout(() => {
        server.refresh("/");
    }, 100);
});
