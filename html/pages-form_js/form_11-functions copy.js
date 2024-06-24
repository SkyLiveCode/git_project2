// +--- 4. คำนวณ ---+
function calculateSum() {
    const form1_sign = document.querySelector('input[name="form1_sign"]').value || 0;
    const form2_sign = document.querySelector('input[name="form2_sign"]').value || 0;
    const form3_sign = document.querySelector('input[name="form3_sign"]').value || 0;
    const form2_input1 = parseFloat(document.querySelector('input[name="form2_input1"]').value) || 0;
    const form2_input2 = parseFloat(document.querySelector('input[name="form2_input2"]').value) || 0;
    const form2_input3 = parseFloat(document.querySelector('input[name="form2_input3"]').value) || 0;
    const form2_input4 = parseFloat(document.querySelector('input[name="form2_input4"]').value) || 0;
    const form2_input5 = parseFloat(document.querySelector('input[name="form2_input5"]').value) || 0;
    const form2_input6 = parseFloat(document.querySelector('input[name="form2_input6"]').value) || 0;
    const form2_input7 = parseFloat(document.querySelector('input[name="form2_input7"]').value) || 0;
    const form2_input8 = parseFloat(document.querySelector('input[name="form2_input8"]').value) || 0;
    const form2_input9 = parseFloat(document.querySelector('input[name="form2_input9"]').value) || 0;
    const form2_input10 = parseFloat(document.querySelector('input[name="form2_input10"]').value) || 0;
    const form2_input11 = parseFloat(document.querySelector('input[name="form2_input11"]').value) || 0;
    const form2_input12 = parseFloat(document.querySelector('input[name="form2_input12"]').value) || 0;
    const form2_input13 = parseFloat(document.querySelector('input[name="form2_input13"]').value) || 0;
    const form2_input14 = parseFloat(document.querySelector('input[name="form2_input14"]').value) || 0;
    const form2_input15 = parseFloat(document.querySelector('input[name="form2_input15"]').value) || 0;
    const form2_input16 = parseFloat(document.querySelector('input[name="form2_input16"]').value) || 0;
    const form2_input17 = parseFloat(document.querySelector('input[name="form2_input17"]').value) || 0;
    const form2_input18 = parseFloat(document.querySelector('input[name="form2_input18"]').value) || 0;
    const form2_input19 = parseFloat(document.querySelector('input[name="form2_input19"]').value) || 0;
    const form2_input20 = parseFloat(document.querySelector('input[name="form2_input20"]').value) || 0;
    const form2_input21 = parseFloat(document.querySelector('input[name="form2_input21"]').value) || 0;
    const form2_input22 = parseFloat(document.querySelector('input[name="form2_input22"]').value) || 0;
    const form2_input23 = parseFloat(document.querySelector('input[name="form2_input23"]').value) || 0;
    const form2_input24 = parseFloat(document.querySelector('input[name="form2_input24"]').value) || 0;
    const form2_input25 = parseFloat(document.querySelector('input[name="form2_input25"]').value) || 0;
    const form2_input26 = parseFloat(document.querySelector('input[name="form2_input26"]').value) || 0;
    const form2_input27 = parseFloat(document.querySelector('input[name="form2_input27"]').value) || 0;
    const form2_input28 = parseFloat(document.querySelector('input[name="form2_input28"]').value) || 0;
    const form2_input29 = parseFloat(document.querySelector('input[name="form2_input29"]').value) || 0;
    const form2_input30 = parseFloat(document.querySelector('input[name="form2_input30"]').value) || 0;
    const form2_input31 = parseFloat(document.querySelector('input[name="form2_input31"]').value) || 0;
    const form2_input32 = parseFloat(document.querySelector('input[name="form2_input32"]').value) || 0;
    const form2_input33 = parseFloat(document.querySelector('input[name="form2_input33"]').value) || 0;
    const form2_input34 = parseFloat(document.querySelector('input[name="form2_input34"]').value) || 0;
    const form2_input35 = parseFloat(document.querySelector('input[name="form2_input35"]').value) || 0;
    const form2_input36 = parseFloat(document.querySelector('input[name="form2_input36"]').value) || 0;
    const form2_input37 = parseFloat(document.querySelector('input[name="form2_input37"]').value) || 0;

    const data_20_26_32 = [form2_input20, form2_input26, form2_input32];
    const data_22_28_34 = [form2_input22, form2_input28, form2_input34];
    const data_24_30_36 = [form2_input24, form2_input30, form2_input36];
    const data_21_27_33 = [form2_input21, form2_input27, form2_input33];
    const data_23_29_35 = [form2_input23, form2_input29, form2_input35];
    const data_25_31_37 = [form2_input25, form2_input31, form2_input37];

    const stdDev1 = Math.sqrt(data_20_26_32.map(x => Math.pow(x - data_20_26_32.reduce((a, b) => a + b, 0) / data_20_26_32.length, 2)).reduce((a, b) => a + b) / (data_20_26_32.length - 1));
    const stdDev2 = Math.sqrt(data_22_28_34.map(x => Math.pow(x - data_22_28_34.reduce((a, b) => a + b, 0) / data_22_28_34.length, 2)).reduce((a, b) => a + b) / (data_22_28_34.length - 1));
    const stdDev3 = Math.sqrt(data_24_30_36.map(x => Math.pow(x - data_24_30_36.reduce((a, b) => a + b, 0) / data_24_30_36.length, 2)).reduce((a, b) => a + b) / (data_24_30_36.length - 1));
    const stdDev4 = Math.sqrt(data_21_27_33.map(x => Math.pow(x - data_21_27_33.reduce((a, b) => a + b, 0) / data_21_27_33.length, 2)).reduce((a, b) => a + b) / (data_21_27_33.length - 1));
    const stdDev5 = Math.sqrt(data_23_29_35.map(x => Math.pow(x - data_23_29_35.reduce((a, b) => a + b, 0) / data_23_29_35.length, 2)).reduce((a, b) => a + b) / (data_23_29_35.length - 1));
    const stdDev6 = Math.sqrt(data_25_31_37.map(x => Math.pow(x - data_25_31_37.reduce((a, b) => a + b, 0) / data_25_31_37.length, 2)).reduce((a, b) => a + b) / (data_25_31_37.length - 1));

    document.getElementById('form1_sign').innerText = form1_sign;    
    document.getElementById('form2_result1').innerText = form2_input14;
    document.getElementById('form2_result2').innerText = form2_input16;
    document.getElementById('form2_result3').innerText = form2_input18;
    document.getElementById('form2_result4').innerText = form2_input15;
    document.getElementById('form2_result5').innerText = form2_input17;
    document.getElementById('form2_result6').innerText = form2_input19;
    document.getElementById('form2_result7').innerText = (form2_input20 + form2_input26 + form2_input32) / 3;
    document.getElementById('form2_result8').innerText = (form2_input22 + form2_input28 + form2_input34) / 3;
    document.getElementById('form2_result9').innerText = (form2_input24 + form2_input30 + form2_input36) / 3;
    document.getElementById('form2_result10').innerText = (form2_input21 + form2_input27 + form2_input33) / 3;
    document.getElementById('form2_result11').innerText = (form2_input23 + form2_input29 + form2_input35) / 3;
    document.getElementById('form2_result12').innerText = (form2_input25 + form2_input31 + form2_input37) / 3;
    document.getElementById('form2_result13').innerText = stdDev1;                    //  STDEV 20 26 32
    document.getElementById('form2_result14').innerText = stdDev2;                    //  STDEV 22 28 34
    document.getElementById('form2_result15').innerText = stdDev3;                    //  STDEV 24 30 36
    document.getElementById('form2_result16').innerText = stdDev4;                    //  STDEV 21 27 33
    document.getElementById('form2_result17').innerText = stdDev5;                    //  STDEV 23 29 35
    document.getElementById('form2_result18').innerText = stdDev6;                    //  STDEV 25 31 37
    document.getElementById('form2_result19').innerText = (stdDev1) / (Math.sqrt(10));  //  form2_result13 / SQRT(10)
    document.getElementById('form2_result20').innerText = (stdDev2) / (Math.sqrt(10));  //  form2_result14 / SQRT(10)
    document.getElementById('form2_result21').innerText = (stdDev3) / (Math.sqrt(10));  //  form2_result15 / SQRT(10)
    document.getElementById('form2_result22').innerText = (stdDev4) / (Math.sqrt(10));  //  form2_result16 / SQRT(10)
    document.getElementById('form2_result23').innerText = (stdDev5) / (Math.sqrt(10));  //  form2_result17 / SQRT(10)
    document.getElementById('form2_result24').innerText = (stdDev6) / (Math.sqrt(10));  //  form2_result18 / SQRT(10)

    document.getElementById('form2_sign').innerText = form2_sign;
    document.getElementById('form2_signCopy').innerText = form2_sign;
    
    document.getElementById('form3_sign').innerText = form3_sign;
    document.getElementById('form3_result1').innerText = form2_input14;
    document.getElementById('form3_result1copy').innerText = form2_input14;
    document.getElementById('form3_result2').innerText = form2_input16;
    document.getElementById('form3_result2copy').innerText = form2_input16;
    document.getElementById('form3_result3').innerText = form2_input18;
    document.getElementById('form3_result3copy').innerText = form2_input18;
    document.getElementById('form3_result4').innerText = form2_input15;
    document.getElementById('form3_result4copy').innerText = form2_input15;
    document.getElementById('form3_result5').innerText = form2_input17;
    document.getElementById('form3_result5copy').innerText = form2_input17;
    document.getElementById('form3_result6').innerText = form2_input19;
    document.getElementById('form3_result6copy').innerText = form2_input19;
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
            document.querySelector('input[name="form1_input2"]').value = data.datafrom1.input2;
            document.querySelector('input[name="form1_input3"]').value = data.datafrom1.input3;
            document.querySelector('input[name="form1_input4"]').value = data.datafrom1.input4;
            document.querySelector('input[name="form1_input5"]').value = data.datafrom1.input5;
            document.querySelector('input[name="form1_input6"]').value = data.datafrom1.input6;
            document.querySelector('input[name="form1_input7"]').value = data.datafrom1.input7;
            document.querySelector(`input[name="inlineRadio1"][value="${data.datafrom1.radio1}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio2"][value="${data.datafrom1.radio2}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio3"][value="${data.datafrom1.radio3}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio4"][value="${data.datafrom1.radio4}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio5"][value="${data.datafrom1.radio5}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio6"][value="${data.datafrom1.radio6}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio7"][value="${data.datafrom1.radio7}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio8"][value="${data.datafrom1.radio8}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio9"][value="${data.datafrom1.radio9}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio10"][value="${data.datafrom1.radio10}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio11"][value="${data.datafrom1.radio11}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio12"][value="${data.datafrom1.radio12}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio13"][value="${data.datafrom1.radio13}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio14"][value="${data.datafrom1.radio14}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio15"][value="${data.datafrom1.radio15}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio16"][value="${data.datafrom1.radio16}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio17"][value="${data.datafrom1.radio17}"]`).checked = true;
            document.querySelector(`input[name="inlineRadio18"][value="${data.datafrom1.radio18}"]`).checked = true;
            document.querySelector('textarea[name="textarea1"]').value = data.datafrom1.textarea1;
            document.querySelector('textarea[name="textarea2"]').value = data.datafrom1.textarea2;
            document.querySelector('textarea[name="textarea3"]').value = data.datafrom1.textarea3;
            document.querySelector('textarea[name="textarea4"]').value = data.datafrom1.textarea4;
            document.querySelector('textarea[name="textarea5"]').value = data.datafrom1.textarea5;
            document.querySelector('textarea[name="textarea6"]').value = data.datafrom1.textarea6;
            document.querySelector('textarea[name="textarea7"]').value = data.datafrom1.textarea7;
            document.querySelector('textarea[name="textarea8"]').value = data.datafrom1.textarea8;
            document.querySelector('textarea[name="textarea9"]').value = data.datafrom1.textarea9;
            document.querySelector('textarea[name="textarea10"]').value = data.datafrom1.textarea10;
            document.querySelector('textarea[name="textarea11"]').value = data.datafrom1.textarea11;
            document.querySelector('textarea[name="textarea12"]').value = data.datafrom1.textarea12;
            document.querySelector('textarea[name="textarea13"]').value = data.datafrom1.textarea13;
            document.querySelector('textarea[name="textarea14"]').value = data.datafrom1.textarea14;
            document.querySelector('textarea[name="textarea15"]').value = data.datafrom1.textarea15;
            document.querySelector('textarea[name="textarea16"]').value = data.datafrom1.textarea16;
            document.querySelector('textarea[name="textarea17"]').value = data.datafrom1.textarea17;

            // form 2
            document.querySelector('input[name="form2_sign"]').value = data.datafrom2.sign;
            document.querySelector('input[name="form2_input1"]').value = data.datafrom2.input1;
            document.querySelector('input[name="form2_input2"]').value = data.datafrom2.input2;
            document.querySelector('input[name="form2_input3"]').value = data.datafrom2.input3;
            document.querySelector('input[name="form2_input4"]').value = data.datafrom2.input4;
            document.querySelector('input[name="form2_input5"]').value = data.datafrom2.input5;
            document.querySelector('input[name="form2_input6"]').value = data.datafrom2.input6;
            document.querySelector('input[name="form2_input7"]').value = data.datafrom2.input7;
            document.querySelector('input[name="form2_input8"]').value = data.datafrom2.input8;
            document.querySelector('input[name="form2_input9"]').value = data.datafrom2.input9;
            document.querySelector('input[name="form2_input10"]').value = data.datafrom2.input10;
            document.querySelector('input[name="form2_input11"]').value = data.datafrom2.input11;
            document.querySelector('input[name="form2_input12"]').value = data.datafrom2.input12;
            document.querySelector('input[name="form2_input13"]').value = data.datafrom2.input13;
            document.querySelector('input[name="form2_input14"]').value = data.datafrom2.input14;
            document.querySelector('input[name="form2_input15"]').value = data.datafrom2.input15;
            document.querySelector('input[name="form2_input16"]').value = data.datafrom2.input16;
            document.querySelector('input[name="form2_input17"]').value = data.datafrom2.input17;
            document.querySelector('input[name="form2_input18"]').value = data.datafrom2.input18;
            document.querySelector('input[name="form2_input19"]').value = data.datafrom2.input19;
            document.querySelector('input[name="form2_input20"]').value = data.datafrom2.input20;
            document.querySelector('input[name="form2_input21"]').value = data.datafrom2.input21;
            document.querySelector('input[name="form2_input22"]').value = data.datafrom2.input22;
            document.querySelector('input[name="form2_input23"]').value = data.datafrom2.input23;
            document.querySelector('input[name="form2_input24"]').value = data.datafrom2.input24;
            document.querySelector('input[name="form2_input25"]').value = data.datafrom2.input25;
            document.querySelector('input[name="form2_input26"]').value = data.datafrom2.input26;
            document.querySelector('input[name="form2_input27"]').value = data.datafrom2.input27;
            document.querySelector('input[name="form2_input28"]').value = data.datafrom2.input28;
            document.querySelector('input[name="form2_input29"]').value = data.datafrom2.input29;
            document.querySelector('input[name="form2_input30"]').value = data.datafrom2.input30;
            document.querySelector('input[name="form2_input31"]').value = data.datafrom2.input31;
            document.querySelector('input[name="form2_input32"]').value = data.datafrom2.input32;
            document.querySelector('input[name="form2_input33"]').value = data.datafrom2.input33;
            document.querySelector('input[name="form2_input34"]').value = data.datafrom2.input34;
            document.querySelector('input[name="form2_input35"]').value = data.datafrom2.input35;
            document.querySelector('input[name="form2_input36"]').value = data.datafrom2.input36;
            document.querySelector('input[name="form2_input37"]').value = data.datafrom2.input37;

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
