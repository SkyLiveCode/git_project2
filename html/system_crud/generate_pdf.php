<?php
require_once __DIR__ . '/vendor/autoload.php'; // ตรวจสอบให้แน่ใจว่า path นี้ตรงกับที่ติดตั้ง mPDF
require('connect.php');
require 'compute-excel/vendor/autoload.php';

// +------------------------------------ ดึง DB -----------------------------------+
// รับ iddata_web จาก query string
$iddata_web = $_GET['iddata_web'];

// ตัวอย่างคำสั่ง SQL
$sql = "SELECT `json_data_1`, `json_data_2`, `json_data_3`, `value_1`, `value_2`, `value_3`, DATE_FORMAT(`date`, '%e %M %Y') AS formatted_date FROM `data_web` WHERE iddata_web = :iddata_web";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':iddata_web', $iddata_web, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $value_1 = $row['value_1'];
    $value_2 = $row['value_2'];
    $value_3 = $row['value_3'];
    $date = $row['formatted_date'];

    $data_1 = json_decode($row['json_data_1'], true);
    $data_2 = json_decode($row['json_data_2'], true);
    $data_3 = json_decode($row['json_data_3'], true);

    $systolic_1_r1 = $data_1['systolic_1'];
    $diastolic_1_r1 = $data_1['diastolic_1'];
    $systolic_2_r1 = $data_1['systolic_2'];
    $diastolic_2_r1 = $data_1['diastolic_2'];
    $systolic_3_r1 = $data_1['systolic_3'];
    $diastolic_3_r1 = $data_1['diastolic_3'];

    $systolic_1_r2 = $data_2['systolic_1'];
    $diastolic_1_r2 = $data_2['diastolic_1'];
    $systolic_2_r2 = $data_2['systolic_2'];
    $diastolic_2_r2 = $data_2['diastolic_2'];
    $systolic_3_r2 = $data_2['systolic_3'];
    $diastolic_3_r2 = $data_2['diastolic_3'];

    $systolic_1_r3 = $data_3['systolic_1'];
    $diastolic_1_r3 = $data_3['diastolic_1'];
    $systolic_2_r3 = $data_3['systolic_2'];
    $diastolic_2_r3 = $data_3['diastolic_2'];
    $systolic_3_r3 = $data_3['systolic_3'];
    $diastolic_3_r3 = $data_3['diastolic_3'];
}
// +------------------------------------------------------------------------------+

// +----------------------------------- ดึง Excel ---------------------------------+
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'compute-excel\23ATP10195-BPD-TTM-001-รพ.เปือยน้อย.xlsx'; // ปรับ path ให้ถูกต้อง
$spreadsheet = IOFactory::load($file); // โหลด spreadsheet จากไฟล์
// ตรวจสอบว่ามีเวิร์กชีตชื่อ "ข้อมูลดิบหลัก" หรือไม่
if (!$spreadsheet->sheetNameExists('ข้อมูลดิบหลัก')) {
    echo "ไม่พบเวิร์กชีตชื่อ 'ข้อมูลดิบหลัก'";
    return;
}
$sheet = $spreadsheet->getSheetByName('ข้อมูลดิบหลัก'); // เข้าถึงเวิร์กชีตที่ชื่อว่า "ข้อมูลดิบหลัก"

// +--- ดึงข้อมูลจาก DB <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// เขียนค่าใหม่ลงไปที่เซลล์ 
$sheet->setCellValue('B14', $value_1);
$sheet->setCellValue('D14', $value_2);
$sheet->setCellValue('F14', $value_3);
$sheet->setCellValue('F10', $date);

// เริ่มเขียนข้อมูลจากแถวที่ 2 เป็นต้นไป
$sheet->setCellValue('B16', $systolic_1_r1);
$sheet->setCellValue('C16', $diastolic_1_r1);
$sheet->setCellValue('D16', $systolic_2_r1);
$sheet->setCellValue('E16', $diastolic_2_r1);
$sheet->setCellValue('F16', $systolic_3_r1);
$sheet->setCellValue('G16', $diastolic_3_r1);

$sheet->setCellValue('B17', $systolic_1_r2);
$sheet->setCellValue('C17', $diastolic_1_r2);
$sheet->setCellValue('D17', $systolic_2_r2);
$sheet->setCellValue('E17', $diastolic_2_r2);
$sheet->setCellValue('F17', $systolic_3_r2);
$sheet->setCellValue('G17', $diastolic_3_r2);

$sheet->setCellValue('B18', $systolic_1_r3);
$sheet->setCellValue('C18', $diastolic_1_r3);
$sheet->setCellValue('D18', $systolic_2_r3);
$sheet->setCellValue('E18', $diastolic_2_r3);
$sheet->setCellValue('F18', $systolic_3_r3);
$sheet->setCellValue('G18', $diastolic_3_r3);

// สร้าง writer เพื่อบันทึกไฟล์
$writer = new Xlsx($spreadsheet);
$writer->save($file); // บันทึกการเปลี่ยนแปลงลงไปในไฟล์เดิม

// อ่าน
// โหลด spreadsheet จากไฟล์
$spreadsheet = IOFactory::load($file);
$sheet = $spreadsheet->getSheetByName('Cer Rusult'); // เข้าถึงเวิร์กชีตที่ชื่อว่า "ข้อมูลดิบหลัก"
// รับค่า
$result_F7  = strval($sheet->getCell('F7')->getCalculatedValue()); //Cert. No. : 23ATP10195
$result_A9  = strval($sheet->getCell('A9')->getCalculatedValue()); //Equipment : Digital Blood Pressure
$result_A10 = strval($sheet->getCell('A10')->getCalculatedValue()); //Manufacture : Union Technology
$result_A11 = strval($sheet->getCell('A11')->getCalculatedValue()); //Model :U82 RH
$result_A12 = strval($sheet->getCell('A12')->getCalculatedValue()); //Serial No : -
$result_A13 = strval($sheet->getCell('A13')->getCalculatedValue()); //ID. No : BPD-TTM-001
$result_A14 = strval($sheet->getCell('A14')->getCalculatedValue()); //Test Date :  10 July 2023
$result_E9  = strval($sheet->getCell('E9')->getCalculatedValue()); //Department :โรงพยาบาลเปือยน้อย
$result_E10 = strval($sheet->getCell('E10')->getCalculatedValue()); //Addresse :ขอนแก่น
$result_E11 = strval($sheet->getCell('E11')->getCalculatedValue()); //Section : แพทย์แผนไทย
$result_E12 = strval($sheet->getCell('E12')->getCalculatedValue()); //Temparature : 25.4 °C
$result_E13 = strval($sheet->getCell('E13')->getCalculatedValue()); //Humidity : 65%
$result_E14 = strval($sheet->getCell('E14')->getCalculatedValue()); //Approve Date : 18 August 2023
$result_C20 = strval($sheet->getCell('C20')->getCalculatedValue()); //table 1
$result_C21 = strval($sheet->getCell('C21')->getCalculatedValue()); //table 1
$result_C22 = strval($sheet->getCell('C22')->getCalculatedValue()); //table 1
$result_D20 = strval($sheet->getCell('D20')->getCalculatedValue()); //table 1
$result_D21 = strval($sheet->getCell('D21')->getCalculatedValue()); //table 1
$result_D22 = strval($sheet->getCell('D22')->getCalculatedValue()); //table 1
$result_E20 = strval($sheet->getCell('E20')->getCalculatedValue()); //table 1
$result_E21 = strval($sheet->getCell('E21')->getCalculatedValue()); //table 1
$result_E22 = strval($sheet->getCell('E22')->getCalculatedValue()); //table 1
$result_C28 = strval($sheet->getCell('C28')->getCalculatedValue()); //table 2
$result_C29 = strval($sheet->getCell('C29')->getCalculatedValue()); //table 2
$result_C30 = strval($sheet->getCell('C30')->getCalculatedValue()); //table 2
$result_D28 = strval($sheet->getCell('D28')->getCalculatedValue()); //table 2
$result_D29 = strval($sheet->getCell('D29')->getCalculatedValue()); //table 2
$result_D30 = strval($sheet->getCell('D30')->getCalculatedValue()); //table 2
$result_E28 = strval($sheet->getCell('E28')->getCalculatedValue()); //table 2
$result_E29 = strval($sheet->getCell('E29')->getCalculatedValue()); //table 2
$result_E30 = strval($sheet->getCell('E30')->getCalculatedValue()); //table 2
$result_F49 = strval($sheet->getCell('F49')->getCalculatedValue()); //Cert. No. : 23ATP10195
// สร้าง writer เพื่อบันทึกไฟล์
//$writer = new Xlsx($spreadsheet);
//$writer->save($file); // บันทึกการเปลี่ยนแปลงลงไปในไฟล์เดิม
// +------------------------------------------------------------------------------+

// สร้างเอกสาร PDF ใหม่
// $mpdf = new \Mpdf\Mpdf(); // default
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

// ตั้งค่าเนื้อหา
$content = '';
// คอลัมน์สำหรับ table
$content .= '<table width="100%">';
$content .= '<tr>';
// คอลัมน์สำหรับรูปภาพ
$content .= '<td width="100px" style="padding-left: 10px;"><img src="compute-excel\รูปภาพ1.png" width="100px" style="display: block; margin-left: 15px;" /></td>';
// คอลัมน์สำหรับข้อความที่จัดกึ่งกลาง
$content .= '<td style="text-align: center;">';
$content .= '<h1>AT PREVENT & CALIBRATION LIMITED PARTNERSHIP</h1>';
$content .= '<h1>276 Moo 21, Sila, Amphoe Mueang,</h1>';
$content .= '<h1>Khon Kaen 40000 Tel.0-4334-7362</h1>';
$content .= '</td>';
$content .= '</tr>';
$content .= '</table>';
$content .= '<h1 style="text-align: center; border: 1px solid black; padding: 3px;">Report of Measurement Result</h1>';
// ข้อความชิดขวา
$content .= '<div style="text-align: right;"><span style="font-size: 16px;">' . $result_F7 . '</span></div>';
$content .= '<div style="text-align: right;"><span style="font-size: 16px;"><span style="font-weight: bold;">Page</span> 1 of 2</span></div>';

// คอลัมน์สำหรับ table
$content .= '<table width="100%">';
$content .= '<tr>';
// คอลัมน์ ซ้าย
$content .= '<td width="60%" style="vertical-align: top;">';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A9 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A10 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A11 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A12 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A13 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_A14 . '</span></div>';
$content .= '</td>';
// คอลัมน์ ขวา
$content .= '<td width="40%" style="vertical-align: top;">';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E9 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E10 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E11 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E12 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E13 . '</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">' . $result_E14 . '</span></div>';
$content .= '</td>';
$content .= '</tr>';
$content .= '</table>';
// ขึ้นบรรทัดใหม่
$content .= '<div><span style="font-size: 16px; font-weight: bold; text-decoration: underline;">Measurement Result</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">NIBP</span></div>';

//ตาราง
$content .= '
<table width="100%" cellpadding="2" border="1" style="border-collapse: collapse; text-align: center;">
    <tr>
        <th >Nominal Value</th>
        <th>STD Reading</th>
        <th>UUT Reading</th>
        <th>Error</th>
        <th rowspan="2">Uncertainty</th>
        <th rowspan="3">Result</th>
    </tr>
    <tr>
        <th>Systolic</th>
        <th>Systolic</th>
        <th>Systolic</th>
        <th>Systolic</th>
    </tr>
    <tr>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(±mmHg)</th>
    </tr>
    <tr>
        <td>80</td>
        <td>80</td>
        <td>' . round($result_C20) . '</td>
        <td>' . round($result_D20) . '</td>
        <td>' . number_format($result_E20, 1) . '</td>
        <td>PASS</td>
    </tr>
    <tr>
        <td>120</td>
        <td>120</td>
        <td>' . round($result_C21) . '</td>
        <td>' . round($result_D21) . '</td>
        <td>' . number_format($result_E21, 1) . '</td>
        <td>PASS</td>
    </tr>
    <tr>
        <td>190</td>
        <td>190</td>
        <td>' . round($result_C22) . '</td>
        <td>' . round($result_D22) . '</td>
        <td>' . number_format($result_E22, 1) . '</td>
        <td>PASS</td>
    </tr>
</table>';
$content .= '<div style="font-size: 16px; margin-top: 10px; margin-bottom: 10px;"><span style="font-weight: bold;">Maximum Permissible Error (MPE) :</span> ±8 (mmHg)</div>';
//ตาราง
$content .= '
<table width="100%" cellpadding="2" border="1" style="border-collapse: collapse; text-align: center;">
    <tr>
        <th >Nominal Value</th>
        <th>STD Reading</th>
        <th>UUT Reading</th>
        <th>Error</th>
        <th rowspan="2">Uncertainty</th>
        <th rowspan="3">Result</th>
    </tr>
    <tr>
        <th>Systolic</th>
        <th>Systolic</th>
        <th>Systolic</th>
        <th>Systolic</th>
    </tr>
    <tr>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(mmHg)</th>
        <th>(±mmHg)</th>
    /tr>
    <tr>
        <td>80</td>
        <td>80</td>
        <td>' . round($result_C28) . '</td>
        <td>' . round($result_D28) . '</td>
        <td>' . number_format($result_E28, 1) . '</td>
        <td>PASS</td>
    </tr>
    <tr>
        <td>120</td>
        <td>120</td>
        <td>' . round($result_C29) . '</td>
        <td>' . round($result_D29) . '</td>
        <td>' . number_format($result_E29, 1) . '</td>
        <td>PASS</td>
    </tr>
    <tr>
        <td>190</td>
        <td>190</td>
        <td>' . round($result_C30) . '</td>
        <td>' . round($result_D30) . '</td>
        <td>' . number_format($result_E30, 1) . '</td>
        <td>PASS</td>
    </tr>
</table>';
$content .= '<div style="font-size: 16px; margin-top: 10px; margin-bottom: 5px;"><span style="font-weight: bold;">Maximum Permissible Error (MPE) :</span> ±8 (mmHg)</div>';
$content .= '<div><span style="font-size: 16px;"><span style="font-weight: bold;">Procedure of Test :</span> Test were conducted using in-house test procedure AT-03.</span></div>';
$content .= '<div><span style="font-size: 16px; font-weight: bold;">Uncertainty of  Measurement</span></div>';
$content .= '<div><span style="font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The reported uncertainty is base on a standard uncertainty mutiplied by a converage factor k=2, providing a level of confidence of approximately 95%</span></div>';


// บอกให้ขึ้นหน้าใหม่
$content .= '<pagebreak>';
// ข้อความชิดขวา
$content .= '<div style="text-align: right;"><span style="font-size: 16px;">' . $result_F49 . '</span></div>';
$content .= '<div style="text-align: right;"><span style="font-size: 16px;"><span style="font-weight: bold;">Page</span> 2 of 2</span></div>';
// ข้อความชิดซ้าย
$content .= '<div style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Test Standard Used</div>';
//ตาราง
$content .= '
<table width="100%" cellpadding="2" border="1" style="border-collapse: collapse; text-align: center;">
    <tr>
        <th>Manufacture</th>
        <th>Model</th>
        <th>S/N</th>
        <th>Cal. Date</th>
        <th>Cert. No.</th>
    </tr>
    <tr>
        <td>BC Biomedical</td>
        <td>NIBP-1030</td>
        <td>735AE1524Q</td>
        <td>17 February 2023</td>
        <td>MP23-1204</td>
    </tr>
</table>';
$content .= '<div style="font-size: 16px; margin-top: 10px;">
1. This result of test was found accurate as shown on date and place of test only.<br>
2. This result of test was made on requested at the point specified by customer.<br>
3. This test is traceabla to the International System of Units, through :<br>
&nbsp;&nbsp;- National Institute of Metrology (Thailand).<br>
&nbsp;&nbsp;- National Institute of Metrology (Thailand), through Technology Promotion Association (Thailand-Japan).<br>
4. This certification were carried out using equipment whose measured values are traceable to National Standards, where these exist.
</div>';

$mpdf->WriteHTML($content);

// ส่งออกเอกสาร PDF
$mpdf->Output('report.pdf', 'I');

$conn = null;
?>
