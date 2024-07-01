// ฟังก์ชันสำหรับดึงข้อมูล inputs จากเซิร์ฟเวอร์
function fetchInputs() {
  fetch('/get-inputs1') // เรียกข้อมูลจากเซิร์ฟเวอร์
    .then(response => response.json()) // แปลงข้อมูลที่ได้รับเป็น JSON
    .then(data => {
      if (data.inputs) { // ตรวจสอบว่ามีข้อมูล inputs หรือไม่
        Object.keys(data.inputs).forEach(key => { // วนลูปผ่านทุกคีย์ใน inputs
          if (document.getElementById(key)) { // ถ้ามีองค์ประกอบในหน้า HTML ที่มี ID ตรงกับคีย์
            document.getElementById(key).value = data.inputs[key] || ''; // ตั้งค่าค่าให้กับองค์ประกอบนั้น
          }
        });

        // ตั้งค่าปุ่มเลือกแบบตัวเลือกตามข้อมูลที่ได้รับ
        for (let i = 1; i <= 18; i++) {
          if (data.inputs[`radio${i}`]) {
            document.querySelector(`input[name="radio${i}"][value="${data.inputs[`radio${i}`]}"]`).checked = true;
          }
        }

        // เรียกฟังก์ชันส่งข้อมูลเพื่อแสดงผลลัพธ์เบื้องต้น
        sendInputs(data.inputs);

        // อัพเดทสถานะของ signature1, signature2 และ signature3
        updateSignatureStatus('signature1', 'bg_signatureStatus1');
        updateSignatureStatus('signature2', 'bg_signatureStatus2');
        updateSignatureStatus('signature3', 'bg_signatureStatus3');

        // อัพเดทการแสดงผลของ spans ด้วยค่าเริ่มต้น
        updateDisplaySpans();

        // อัพเดทการแสดงผลของ calculation inputs ด้วยค่าเริ่มต้น
        updateCalInputDisplay('calinput5');
        updateCalInputDisplay('calinput6');
        updateCalInputDisplay('calinput7');
        updateCalInputDisplay('calinput8');
      }
    });
}

// ฟังก์ชันส่งข้อมูล inputs ไปยังเซิร์ฟเวอร์
function sendInputs(inputs) {
  const socket = io(); // สร้างการเชื่อมต่อ Socket.IO
  socket.emit('calculate', inputs); // ส่งข้อมูล inputs ไปยังเซิร์ฟเวอร์เพื่อคำนวณ
  socket.on('calculatedResult', (data) => { // รับผลลัพธ์ที่คำนวณแล้วจากเซิร์ฟเวอร์
    document.getElementById('sumResult').textContent = data.sumResult;
    document.getElementById('differenceResult').textContent = data.differenceResult;
    
    // แสดง/ซ่อนรูปภาพตามลายเซ็นต์ 3
    const signature3 = document.getElementById('signature3').value.toLowerCase();
    const signatureImage = document.getElementById('signatureImage');
    if (signature3 === 'sky') {
      signatureImage.src = '../../assets/img/signature/path_to_sky_image.jpg';
      signatureImage.style.display = 'block';
    } else if (signature3 === 'นายพงศ์สกาย รุ่งรพีพรพงษ์') {
      signatureImage.src = "../../assets/img/signature/signature3.png";
      signatureImage.style.display = 'block';
    } else {
      signatureImage.style.display = 'none';
    }

    // อัพเดทสถานะของ signature1, signature2 และ signature3
    updateSignatureStatus('signature1', 'bg_signatureStatus1');
    updateSignatureStatus('signature2', 'bg_signatureStatus2');
    updateSignatureStatus('signature3', 'bg_signatureStatus3');
    
    // อัพเดทการแสดงผลของ spans ด้วยค่าที่ได้รับ
    updateDisplaySpans();
  });
}

// ฟังก์ชันสำหรับอัพเดทสถานะของ signature
function updateSignatureStatus(inputId, statusId) {
  const inputElement = document.getElementById(inputId);
  const statusElement = document.getElementById(statusId);

  if (inputElement.value) {
    statusElement.className = "mt-2 badge rounded-pill bg-success";
    statusElement.textContent = "Completed";
  } else {
    statusElement.className = "mt-2 badge rounded-pill bg-warning";
    statusElement.textContent = "Pending";
  }
}

// ฟังก์ชันสำหรับดึงข้อมูล inputs จากฟอร์ม
function getInputs() {
  const inputs = {};
  document.querySelectorAll('#calcForm input, #calcForm textarea').forEach(input => {
      if (input.type === 'radio') {
          if (input.checked) {
              inputs[input.name] = input.value;
          }
      } else {
          inputs[input.name] = input.value;
      }
  });
  return inputs;
}

// ฟังก์ชันเพื่ออัพเดทการแสดงผลของ spans
function updateDisplaySpans() {
  document.getElementById('displaySignature1').textContent = document.getElementById('signature1').value;
  document.getElementById('displaySignature2').textContent = document.getElementById('signature2').value;
  document.getElementById('displaySignature3').textContent = document.getElementById('signature3').value;
}

// ฟังก์ชันเพื่ออัพเดทการแสดงผลของ calculation inputs
function updateCalInputDisplay(inputId) {
  const inputValue = document.getElementById(inputId).value;
  const displayElement = document.getElementById(`display${inputId}`);
  if (displayElement) {
      displayElement.textContent = inputValue;
  }
}

// เรียกฟังก์ชัน fetchInputs เมื่อโหลดหน้าเว็บ
document.addEventListener('DOMContentLoaded', fetchInputs); // ดึงข้อมูล inputs เมื่อโหลดหน้าเว็บ

// Event listeners สำหรับปุ่ม fill signatures และอัพเดทการแสดงผล
document.getElementById('fillSignature1').addEventListener('click', function() {
  const signature1Input = document.getElementById('signature1');
  if (!signature1Input.value) {
    signature1Input.value = userName;
    sendInputs(getInputs());
  }
  document.getElementById('displaySignature1').textContent = signature1Input.value;
  updateSignatureStatus('signature1', 'bg_signatureStatus1'); // อัพเดทสถานะของ signature1
});

document.getElementById('fillSignature2').addEventListener('click', function() {
  const signature2Input = document.getElementById('signature2');
  if (!signature2Input.value) {
    signature2Input.value = userName;
    sendInputs(getInputs());
  }
  document.getElementById('displaySignature2').textContent = signature2Input.value;
  updateSignatureStatus('signature2', 'bg_signatureStatus2'); // อัพเดทสถานะของ signature2
});

document.getElementById('fillSignature3').addEventListener('click', function() {
  const signature3Input = document.getElementById('signature3');
  if (!signature3Input.value) {
    signature3Input.value = userName;
    sendInputs(getInputs());
  }
  document.getElementById('displaySignature3').textContent = signature3Input.value;
  updateSignatureStatus('signature3', 'bg_signatureStatus3'); // อัพเดทสถานะของ signature3
});

// Event listeners เพื่ออัพเดทการแสดงผลของ spans แบบเรียลไทม์และสถานะของ signatures
document.getElementById('signature1').addEventListener('input', function() {
  document.getElementById('displaySignature1').textContent = this.value;
  updateSignatureStatus('signature1', 'bg_signatureStatus1');
});

document.getElementById('signature2').addEventListener('input', function() {
  document.getElementById('displaySignature2').textContent = this.value;
  updateSignatureStatus('signature2', 'bg_signatureStatus2');
});

document.getElementById('signature3').addEventListener('input', function() {
  document.getElementById('displaySignature3').textContent = this.value;
  updateSignatureStatus('signature3', 'bg_signatureStatus3');
  fetchUsers(); // ดึงข้อมูลผู้ใช้ใหม่เมื่อมีการเปลี่ยนแปลงลายเซ็นต์ 3
});

// ส่งข้อมูลเมื่อฟอร์มถูก submit
document.getElementById('calcForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const inputs = getInputs();

  fetch('/update-inputs1', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ inputs: inputs }),
  }).then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Inputs updated successfully');
        sendInputs(inputs);
      }
    });
});

// ฟังก์ชันสำหรับดึงข้อมูลผู้ใช้จากเซิร์ฟเวอร์
async function fetchUsers() {
  try {
    const response = await fetch('/api/users'); // เรียก API เพื่อดึงข้อมูลผู้ใช้
    const data = await response.json();

    if (data.users) {
      updateSignatureImage(data.users); // อัพเดทรูปภาพตามข้อมูลที่ได้รับ
    }
  } catch (error) {
    console.error('Error fetching users:', error);
  }
}

// ฟังก์ชันสำหรับอัพเดทรูปภาพตามข้อมูลผู้ใช้
function updateSignatureImage(users) {
  const signature3 = document.getElementById('signature3').value.toLowerCase();
  const signatureImage = document.getElementById('signatureImage');
  const user = users.find(user => user.name.toLowerCase() === signature3);

  if (user) {
    signatureImage.src = `../../assets/img/signature/${user.picture_sign}`;
    signatureImage.style.display = 'block';
  } else {
    signatureImage.style.display = 'none';
  }
}

// เรียกฟังก์ชัน fetchUsers เมื่อโหลดหน้าเว็บ
document.addEventListener('DOMContentLoaded', fetchUsers);
