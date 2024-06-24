<?php
// เรียกใช้ไฟล์ connect.php
require_once 'system_crud/connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$datafrom1 = null;
$datafrom2 = null;

if ($id) {
    $sql = "SELECT datafrom1, datafrom2 FROM medical_equipment WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $datafrom1 = json_decode($result['datafrom1'], true);
        $datafrom2 = json_decode($result['datafrom2'], true);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['form'])) {
        $form = $_POST['form'];
        if ($form == 'form1') {
            $form1_input1 = $_POST['form1_input1'];
            $form1_input2 = $_POST['form1_input2'];
            $inlineRadio1 = $_POST['inlineRadio1'];
            $inlineRadio2 = $_POST['inlineRadio2'];
            $inlineRadio3 = $_POST['inlineRadio3'];

            $datafrom1 = json_encode([
                'input1' => $form1_input1,
                'input2' => $form1_input2,
                'radio1' => $inlineRadio1,
                'radio2' => $inlineRadio2,
                'radio3' => $inlineRadio3,
            ]);

            $sql = "UPDATE medical_equipment SET datafrom1 = :datafrom1 WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'datafrom1' => $datafrom1,
                'id' => $id
            ]);
        } elseif ($form == 'form2') {
            $form2_input1 = $_POST['form2_input1'];
            $form2_input2 = $_POST['form2_input2'];

            $datafrom2 = json_encode([
                'input1' => $form2_input1,
                'input2' => $form2_input2,
            ]);

            $sql = "UPDATE medical_equipment SET datafrom2 = :datafrom2 WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'datafrom2' => $datafrom2,
                'id' => $id
            ]);
        }

        // Return updated data
        $sql = "SELECT datafrom1, datafrom2 FROM medical_equipment WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $datafrom1 = json_decode($result['datafrom1'], true);
            $datafrom2 = json_decode($result['datafrom2'], true);
        }

        echo json_encode([
            'datafrom1' => $datafrom1,
            'datafrom2' => $datafrom2
        ]);
        exit;
    }
}

$form1_input1 = $datafrom1['input1'] ?? '';
$form1_input2 = $datafrom1['input2'] ?? '';
$form1_radio1 = $datafrom1['radio1'] ?? '';
$form1_radio2 = $datafrom1['radio2'] ?? '';
$form1_radio3 = $datafrom1['radio3'] ?? '';
$form2_input1 = $datafrom2['input1'] ?? '';
$form2_input2 = $datafrom2['input2'] ?? '';

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Equipment Form</title>
    <script>
        function calculateSum() {
            const form1_input1 = parseFloat(document.querySelector('input[name="form1_input1"]').value) || 0;
            const form1_input2 = parseFloat(document.querySelector('input[name="form1_input2"]').value) || 0;
            const form2_input1 = parseFloat(document.querySelector('input[name="form2_input1"]').value) || 0;
            const form2_input2 = parseFloat(document.querySelector('input[name="form2_input2"]').value) || 0;

            document.getElementById('form1_result').innerText = form1_input1 + 0;
            document.getElementById('form2_result').innerText = form2_input1 + form2_input2;
            document.getElementById('cross_result1').innerText = form1_input1 + form2_input1;
            document.getElementById('cross_result2').innerText = form1_input2 + form2_input2;
        }

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
                document.querySelector('input[name="form1_input1"]').value = data.datafrom1.input1;
                document.querySelector('input[name="form1_input2"]').value = data.datafrom1.input2;
                document.querySelector(`input[name="inlineRadio1"][value="${data.datafrom1.radio1}"]`).checked = true;
                document.querySelector(`input[name="inlineRadio2"][value="${data.datafrom1.radio2}"]`).checked = true;
                document.querySelector(`input[name="inlineRadio3"][value="${data.datafrom1.radio3}"]`).checked = true;
                document.querySelector('input[name="form2_input1"]').value = data.datafrom2.input1;
                document.querySelector('input[name="form2_input2"]').value = data.datafrom2.input2;
                calculateSum();
            })
            .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[type="text"]');
            inputs.forEach(input => {
                input.addEventListener('input', calculateSum);
            });
        });
    </script>
</head>
<body onload="calculateSum()">

<form id="form1" onsubmit="event.preventDefault(); submitForm('form1'); calculateSum();">
    <h2>Form 1</h2>
    <input type="text" name="form1_input1" value="<?php echo htmlspecialchars($form1_input1); ?>"><br>
    <input type="text" name="form1_input2" value="<?php echo htmlspecialchars($form1_input2); ?>"><br>
    <table>
        <tr>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio1Option1" value="option1" <?php echo $form1_radio1 == 'option1' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio1Option2" value="option2" <?php echo $form1_radio1 == 'option2' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio1" id="inlineRadio1Option3" value="option3" <?php echo $form1_radio1 == 'option3' ? 'checked' : ''; ?>>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio2Option1" value="option1" <?php echo $form1_radio2 == 'option1' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio2Option2" value="option2" <?php echo $form1_radio2 == 'option2' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio2" id="inlineRadio2Option3" value="option3" <?php echo $form1_radio2 == 'option3' ? 'checked' : ''; ?>>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio3Option1" value="option1" <?php echo $form1_radio3 == 'option1' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio3Option2" value="option2" <?php echo $form1_radio3 == 'option2' ? 'checked' : ''; ?>>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline" style="padding-left: 3rem;">
                    <input class="form-check-input" type="radio" name="inlineRadio3" id="inlineRadio3Option3" value="option3" <?php echo $form1_radio3 == 'option3' ? 'checked' : ''; ?>>
                </div>
            </td>
        </tr>
    </table>
    <h1>Result: <span id="form1_result"></span></h1>
    <button type="submit">Submit Form 1</button>
</form>

<form id="form2" onsubmit="event.preventDefault(); submitForm('form2'); calculateSum();">
    <h2>Form 2</h2>
    <input type="text" name="form2_input1" value="<?php echo htmlspecialchars($form2_input1); ?>"><br>
    <input type="text" name="form2_input2" value="<?php echo htmlspecialchars($form2_input2); ?>"><br>
    <button type="submit">Submit Form 2</button>
</form>

<h1>Form 2 Result: <span id="form2_result"></span></h1>
<h1>Cross Form Result 1: <span id="cross_result1"></span></h1>
<h1>Cross Form Result 2: <span id="cross_result2"></span></h1>

</body>
</html>
