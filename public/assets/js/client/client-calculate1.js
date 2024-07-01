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
        if (data.inputs.radio1) {
          document.querySelector(`input[name="radio1"][value="${data.inputs.radio1}"]`).checked = true;
        }
        if (data.inputs.radio2) {
          document.querySelector(`input[name="radio2"][value="${data.inputs.radio2}"]`).checked = true;
        }
        if (data.inputs.radio3) {
          document.querySelector(`input[name="radio3"][value="${data.inputs.radio3}"]`).checked = true;
        }
        if (data.inputs.radio4) {
          document.querySelector(`input[name="radio4"][value="${data.inputs.radio4}"]`).checked = true;
        }
        if (data.inputs.radio5) {
          document.querySelector(`input[name="radio5"][value="${data.inputs.radio5}"]`).checked = true;
        }
        if (data.inputs.radio6) {
          document.querySelector(`input[name="radio6"][value="${data.inputs.radio6}"]`).checked = true;
        }
        if (data.inputs.radio7) {
          document.querySelector(`input[name="radio7"][value="${data.inputs.radio7}"]`).checked = true;
        }
        if (data.inputs.radio8) {
          document.querySelector(`input[name="radio8"][value="${data.inputs.radio8}"]`).checked = true;
        }
        if (data.inputs.radio9) {
          document.querySelector(`input[name="radio9"][value="${data.inputs.radio9}"]`).checked = true;
        }
        if (data.inputs.radio10) {
          document.querySelector(`input[name="radio10"][value="${data.inputs.radio10}"]`).checked = true;
        }
        if (data.inputs.radio11) {
          document.querySelector(`input[name="radio11"][value="${data.inputs.radio11}"]`).checked = true;
        }
        if (data.inputs.radio12) {
          document.querySelector(`input[name="radio12"][value="${data.inputs.radio12}"]`).checked = true;
        }
        if (data.inputs.radio13) {
          document.querySelector(`input[name="radio13"][value="${data.inputs.radio13}"]`).checked = true;
        }
        if (data.inputs.radio14) {
          document.querySelector(`input[name="radio14"][value="${data.inputs.radio14}"]`).checked = true;
        }
        if (data.inputs.radio15) {
          document.querySelector(`input[name="radio15"][value="${data.inputs.radio15}"]`).checked = true;
        }
        if (data.inputs.radio16) {
          document.querySelector(`input[name="radio16"][value="${data.inputs.radio16}"]`).checked = true;
        }
        if (data.inputs.radio17) {
          document.querySelector(`input[name="radio17"][value="${data.inputs.radio17}"]`).checked = true;
        }
        if (data.inputs.radio18) {
          document.querySelector(`input[name="radio18"][value="${data.inputs.radio18}"]`).checked = true;
        }

        // เรียกฟังก์ชันส่งข้อมูลเพื่อแสดงผลลัพธ์เบื้องต้น
        sendInputs(data.inputs);

        // อัพเดทสถานะของ signature1, signature2 และ signature3
        updateSignatureStatus('signature1', 'bg_signatureStatus1');
        updateSignatureStatus('signature2', 'bg_signatureStatus2');
        updateSignatureStatus('signature3', 'bg_signatureStatus3');

        // Update display spans with initial values
        updateDisplaySpans();
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
    
    // อัพเดทสถานะของ signature1, signature2 และ signature3
    updateSignatureStatus('signature1', 'bg_signatureStatus1');
    updateSignatureStatus('signature2', 'bg_signatureStatus2');
    updateSignatureStatus('signature3', 'bg_signatureStatus3');
    
    // Update display spans with received values
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

// เรียกฟังก์ชัน fetchInputs เมื่อโหลดหน้าเว็บ
document.addEventListener('DOMContentLoaded', fetchInputs); // ดึงข้อมูล inputs เมื่อโหลดหน้าเว็บ

// เพิ่ม event listener สำหรับการส่งฟอร์ม
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

// Event listeners for buttons to fill signatures and update displays
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

// Add input event listeners to update the display spans in real-time
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
});

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

// ตรวจสอบลายเซ็นต์ 3 แบบเรียลไทม์
document.getElementById('signature3').addEventListener('input', function() {
  const signature3 = document.getElementById('signature3').value.toLowerCase();
  const signatureImage = document.getElementById('signatureImage');
  if (signature3 === 'sky') {
    signatureImage.src = '../../assets/img/signature/path_to_sky_image.jpg';
    signatureImage.style.display = 'block';
  } else if (signature3 === 'นายพงศ์สกาย รุ่งรพีพรพงษ์') {
    signatureImage.src = '../../assets/img/signature/signature3.png';
    signatureImage.style.display = 'block';
  } else {
    signatureImage.style.display = 'none';
  }
  updateSignatureStatus('signature3', 'bg_signatureStatus3'); // อัพเดทสถานะของ signature3
});

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

// เพิ่ม event listener สำหรับตรวจสอบการเปลี่ยนแปลงของ signature1, signature2 และ signature3
document.getElementById('signature1').addEventListener('input', function() {
  updateSignatureStatus('signature1', 'bg_signatureStatus1');
});

document.getElementById('signature2').addEventListener('input', function() {
  updateSignatureStatus('signature2', 'bg_signatureStatus2');
});

document.getElementById('signature3').addEventListener('input', function() {
  updateSignatureStatus('signature3', 'bg_signatureStatus3');
});
