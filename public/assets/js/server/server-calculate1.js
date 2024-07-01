// เชื่อมต่อกับเซิร์ฟเวอร์ Socket.IO
const socket = io();

// ฟังก์ชันจัดการการส่งข้อมูลของฟอร์ม
function calculate(event) {
  event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ
  
  const form = document.getElementById('calcForm'); // ดึงฟอร์มที่มี id เป็น 'calcForm'
  const formData = new FormData(form); // สร้าง FormData object จากฟอร์ม

  const data = {}; // สร้างออบเจ็กต์สำหรับเก็บข้อมูลฟอร์ม
  formData.forEach((value, key) => {
    data[key] = value; // ใส่ข้อมูลฟอร์มลงในออบเจ็กต์ data
  });

  fetch('/calculate1', {
    method: 'POST', // ใช้เมธอด POST
    headers: {
      'Content-Type': 'application/json', // กำหนดหัวข้อ Content-Type เป็น JSON
    },
    body: JSON.stringify(data), // แปลงออบเจ็กต์ data เป็น JSON และส่งไป
  })
  .then(response => response.json()) // แปลงการตอบกลับเป็น JSON
  .then(data => {
    document.getElementById('sumResult').innerText = data.sumResult; // แสดงผลลัพธ์การคำนวณผลรวม
    document.getElementById('differenceResult').innerText = data.differenceResult; // แสดงผลลัพธ์การคำนวณผลต่าง
    // <<<<<<<<<< เพิ่มรายการ... (result)

    // ตั้งค่าปุ่มเลือกแบบตัวเลือก
    document.getElementById('radio1Option1').checked = data.radio1 === 'option1';
    document.getElementById('radio1Option2').checked = data.radio1 === 'option2';
    document.getElementById('radio1Option3').checked = data.radio1 === 'option3';
    document.getElementById('radio2Option1').checked = data.radio2 === 'option1';
    document.getElementById('radio2Option2').checked = data.radio2 === 'option2';
    document.getElementById('radio2Option3').checked = data.radio2 === 'option3';
    document.getElementById('radio3Option1').checked = data.radio3 === 'option1';
    document.getElementById('radio3Option2').checked = data.radio3 === 'option2';
    document.getElementById('radio3Option3').checked = data.radio3 === 'option3';
    document.getElementById('radio4Option1').checked = data.radio4 === 'option1';
    document.getElementById('radio4Option2').checked = data.radio4 === 'option2';
    document.getElementById('radio4Option3').checked = data.radio4 === 'option3';
    document.getElementById('radio5Option1').checked = data.radio5 === 'option1';
    document.getElementById('radio5Option2').checked = data.radio5 === 'option2';
    document.getElementById('radio5Option3').checked = data.radio5 === 'option3';
    document.getElementById('radio6Option1').checked = data.radio6 === 'option1';
    document.getElementById('radio6Option2').checked = data.radio6 === 'option2';
    document.getElementById('radio6Option3').checked = data.radio6 === 'option3';
    document.getElementById('radio7Option1').checked = data.radio7 === 'option1';
    document.getElementById('radio7Option2').checked = data.radio7 === 'option2';
    document.getElementById('radio7Option3').checked = data.radio7 === 'option3';
    document.getElementById('radio8Option1').checked = data.radio8 === 'option1';
    document.getElementById('radio8Option2').checked = data.radio8 === 'option2';
    document.getElementById('radio8Option3').checked = data.radio8 === 'option3';
    document.getElementById('radio9Option1').checked = data.radio9 === 'option1';
    document.getElementById('radio9Option2').checked = data.radio9 === 'option2';
    document.getElementById('radio9Option3').checked = data.radio9 === 'option3';
    document.getElementById('radio10Option1').checked = data.radio10 === 'option1';
    document.getElementById('radio10Option2').checked = data.radio10 === 'option2';
    document.getElementById('radio10Option3').checked = data.radio10 === 'option3';
    document.getElementById('radio11Option1').checked = data.radio11 === 'option1';
    document.getElementById('radio11Option2').checked = data.radio11 === 'option2';
    document.getElementById('radio11Option3').checked = data.radio11 === 'option3';
    document.getElementById('radio12Option1').checked = data.radio12 === 'option1';
    document.getElementById('radio12Option2').checked = data.radio12 === 'option2';
    document.getElementById('radio12Option3').checked = data.radio12 === 'option3';
    document.getElementById('radio13Option1').checked = data.radio13 === 'option1';
    document.getElementById('radio13Option2').checked = data.radio13 === 'option2';
    document.getElementById('radio13Option3').checked = data.radio13 === 'option3';
    document.getElementById('radio14Option1').checked = data.radio14 === 'option1';
    document.getElementById('radio14Option2').checked = data.radio14 === 'option2';
    document.getElementById('radio14Option3').checked = data.radio14 === 'option3';
    document.getElementById('radio15Option1').checked = data.radio15 === 'option1';
    document.getElementById('radio15Option2').checked = data.radio15 === 'option2';
    document.getElementById('radio15Option3').checked = data.radio15 === 'option3';
    document.getElementById('radio16Option1').checked = data.radio16 === 'option1';
    document.getElementById('radio16Option2').checked = data.radio16 === 'option2';
    document.getElementById('radio16Option3').checked = data.radio16 === 'option3';
    document.getElementById('radio17Option1').checked = data.radio17 === 'option1';
    document.getElementById('radio17Option2').checked = data.radio17 === 'option2';
    document.getElementById('radio17Option3').checked = data.radio17 === 'option3';
    document.getElementById('radio18Option1').checked = data.radio18 === 'option1';
    document.getElementById('radio18Option2').checked = data.radio18 === 'option2';
    document.getElementById('radio18Option3').checked = data.radio18 === 'option3';

    // ตั้งค่าข้อมูลในช่องใส่ข้อมูลตามข้อมูลที่ได้รับ
    document.getElementById('infoinput1').value = data.infoinput1 || '';
    document.getElementById('infoinput2').value = data.infoinput2 || '';
    document.getElementById('infoinput3').value = data.infoinput3 || '';
    document.getElementById('infoinput4').value = data.infoinput4 || '';
    document.getElementById('infoinput5').value = data.infoinput5 || '';
    document.getElementById('infoinput6').value = data.infoinput6 || '';
    document.getElementById('infoinput7').value = data.infoinput7 || '';
    document.getElementById('infoinput8').value = data.infoinput8 || '';
    document.getElementById('infoinput9').value = data.infoinput9 || '';
    document.getElementById('infoinput10').value = data.infoinput10 || '';
    document.getElementById('infoinput11').value = data.infoinput11 || '';
    document.getElementById('infoinput12').value = data.infoinput12 || '';
    document.getElementById('infoinput13').value = data.infoinput13 || '';
    document.getElementById('infoinput14').value = data.infoinput14 || '';
    document.getElementById('infoinput15').value = data.infoinput15 || '';
    document.getElementById('infoinput16').value = data.infoinput16 || '';
    document.getElementById('infoinput17').value = data.infoinput17 || '';
    document.getElementById('infoinput18').value = data.infoinput18 || '';
    document.getElementById('infoinput19').value = data.infoinput19 || '';
    // <<<<<<<<<< เพิ่มรายการ... (input)
  });
}

// เพิ่ม event listener สำหรับการส่งฟอร์ม
document.getElementById('calcForm').addEventListener('submit', calculate); // ฟังก์ชัน calculate จะถูกเรียกเมื่อฟอร์มถูกส่ง

// เพิ่มการตรวจสอบแบบเรียลไทม์สำหรับการคำนวณ
document.getElementById('calcForm').addEventListener('input', () => {
  const formData = new FormData(document.getElementById('calcForm')); // สร้าง FormData object จากฟอร์ม
  const data = {}; // สร้างออบเจ็กต์สำหรับเก็บข้อมูลฟอร์ม
  formData.forEach((value, key) => {
    data[key] = value; // ใส่ข้อมูลฟอร์มลงในออบเจ็กต์ data
  });
  socket.emit('calculate', data); // ส่งข้อมูลไปยังเซิร์ฟเวอร์ผ่าน Socket.IO
});

socket.on('calculatedResult', (data) => { // รับผลลัพธ์ที่คำนวณแล้วจากเซิร์ฟเวอร์
  document.getElementById('sumResult').innerText = data.sumResult; // แสดงผลลัพธ์การคำนวณผลรวม
  document.getElementById('differenceResult').innerText = data.differenceResult; // แสดงผลลัพธ์การคำนวณผลต่าง
  // <<<<<<<<<< เพิ่มรายการ... (result)

  // ตั้งค่าปุ่มเลือกแบบตัวเลือก
  document.getElementById('radio1Option1').checked = data.radio1 === 'option1';
  document.getElementById('radio1Option2').checked = data.radio1 === 'option2';
  document.getElementById('radio1Option3').checked = data.radio1 === 'option3';
  document.getElementById('radio2Option1').checked = data.radio2 === 'option1';
  document.getElementById('radio2Option2').checked = data.radio2 === 'option2';
  document.getElementById('radio2Option3').checked = data.radio2 === 'option3';
  document.getElementById('radio3Option1').checked = data.radio3 === 'option1';
  document.getElementById('radio3Option2').checked = data.radio3 === 'option2';
  document.getElementById('radio3Option3').checked = data.radio3 === 'option3';
  document.getElementById('radio4Option1').checked = data.radio4 === 'option1';
  document.getElementById('radio4Option2').checked = data.radio4 === 'option2';
  document.getElementById('radio4Option3').checked = data.radio4 === 'option3';
  document.getElementById('radio5Option1').checked = data.radio5 === 'option1';
  document.getElementById('radio5Option2').checked = data.radio5 === 'option2';
  document.getElementById('radio5Option3').checked = data.radio5 === 'option3';
  document.getElementById('radio6Option1').checked = data.radio6 === 'option1';
  document.getElementById('radio6Option2').checked = data.radio6 === 'option2';
  document.getElementById('radio6Option3').checked = data.radio6 === 'option3';
  document.getElementById('radio7Option1').checked = data.radio7 === 'option1';
  document.getElementById('radio7Option2').checked = data.radio7 === 'option2';
  document.getElementById('radio7Option3').checked = data.radio7 === 'option3';
  document.getElementById('radio8Option1').checked = data.radio8 === 'option1';
  document.getElementById('radio8Option2').checked = data.radio8 === 'option2';
  document.getElementById('radio8Option3').checked = data.radio8 === 'option3';
  document.getElementById('radio9Option1').checked = data.radio9 === 'option1';
  document.getElementById('radio9Option2').checked = data.radio9 === 'option2';
  document.getElementById('radio9Option3').checked = data.radio9 === 'option3';
  document.getElementById('radio10Option1').checked = data.radio10 === 'option1';
  document.getElementById('radio10Option2').checked = data.radio10 === 'option2';
  document.getElementById('radio10Option3').checked = data.radio10 === 'option3';
  document.getElementById('radio11Option1').checked = data.radio11 === 'option1';
  document.getElementById('radio11Option2').checked = data.radio11 === 'option2';
  document.getElementById('radio11Option3').checked = data.radio11 === 'option3';
  document.getElementById('radio12Option1').checked = data.radio12 === 'option1';
  document.getElementById('radio12Option2').checked = data.radio12 === 'option2';
  document.getElementById('radio12Option3').checked = data.radio12 === 'option3';
  document.getElementById('radio13Option1').checked = data.radio13 === 'option1';
  document.getElementById('radio13Option2').checked = data.radio13 === 'option2';
  document.getElementById('radio13Option3').checked = data.radio13 === 'option3';
  document.getElementById('radio14Option1').checked = data.radio14 === 'option1';
  document.getElementById('radio14Option2').checked = data.radio14 === 'option2';
  document.getElementById('radio14Option3').checked = data.radio14 === 'option3';
  document.getElementById('radio15Option1').checked = data.radio15 === 'option1';
  document.getElementById('radio15Option2').checked = data.radio15 === 'option2';
  document.getElementById('radio15Option3').checked = data.radio15 === 'option3';
  document.getElementById('radio16Option1').checked = data.radio16 === 'option1';
  document.getElementById('radio16Option2').checked = data.radio16 === 'option2';
  document.getElementById('radio16Option3').checked = data.radio16 === 'option3';
  document.getElementById('radio17Option1').checked = data.radio17 === 'option1';
  document.getElementById('radio17Option2').checked = data.radio17 === 'option2';
  document.getElementById('radio17Option3').checked = data.radio17 === 'option3';
  document.getElementById('radio18Option1').checked = data.radio18 === 'option1';
  document.getElementById('radio18Option2').checked = data.radio18 === 'option2';
  document.getElementById('radio18Option3').checked = data.radio18 === 'option3';

  // <<<<<<<<<< เพิ่มรายการ... (input)
});
