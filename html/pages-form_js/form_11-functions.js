// +--- 4. คำนวณ ---+
function calculateSum() {
    const form1_sign = document.querySelector('input[name="form1_sign"]').value || 0;
    const form2_sign = document.querySelector('input[name="form2_sign"]').value || 0;
    const form3_sign = document.querySelector('input[name="form3_sign"]').value || 0;
    document.getElementById('form1_sign').innerText = form1_sign;    

    document.getElementById('form2_sign').innerText = form2_sign;
    document.getElementById('form2_signCopy').innerText = form2_sign;

    document.getElementById('form3_sign').innerText = form3_sign;
}

// +--- 5. ส่งฟอร์มแล้วอัพเดตแบบไม่รีหน้า ---+
function submitForm(formId) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);
    formData.append('form', formId);

    fetch('', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            // form 1        
            document.querySelector('input[name="form1_sign"]').value = data.datafrom1.sign;
            document.querySelector('input[name="form1_input1"]').value = data.datafrom1.input1;

            // form 2
            document.querySelector('input[name="form2_sign"]').value = data.datafrom2.sign;
            document.querySelector('input[name="form2_input1"]').value = data.datafrom2.input1;

            // form 3
            document.querySelector('input[name="form3_sign"]').value = data.datafrom3.sign;

            // คำนวณ
            calculateSum();
        })
        .catch(error => console.error('Error:', error));
}

function submitBothForms(formId) {
    const forms = ['form1', 'form2', 'form3'];
    forms.forEach(id => submitForm(id)); // วนลูปส่งฟอร์มทั้งหมด
}

document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(input => {
        input.addEventListener('input', calculateSum);
    });
});
