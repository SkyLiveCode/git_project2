<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
  header('Location: auth-login-basic.php');
  exit();
}

require_once '../system_crud/connect.php';

// Get the iddata_web and hospital_id from the URL parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$hospital_id = isset($_GET['hospital_id']) ? intval($_GET['hospital_id']) : 0;

// เกี่ยวกับ input
$hospital_name = '';
$hospital_province = '';

if ($hospital_id) {
    $sql = "SELECT h_name, province FROM hospital WHERE id = :hospital_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['hospital_id' => $hospital_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hospital_name = $result['h_name'];
        $hospital_province = $result['province'];
    }
}

// +--- 1. ดึงค่า sql อัพเดต form โหลดหน้าเว็บครั้งแรก ---+
$datafrom1 = null;
$datafrom2 = null;
$datafrom3 = null;
if ($id) {
    $sql = "SELECT datafrom1, datafrom2, datafrom3, Equipment, `ID. No.` FROM medical_equipment WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $IDNo = $result['ID. No.'];
        $Equipment = $result['Equipment'];
        $datafrom1 = json_decode($result['datafrom1'], true);
        $datafrom2 = json_decode($result['datafrom2'], true);
        $datafrom3 = json_decode($result['datafrom3'], true);
    }
}

// +--- 2. รับค่าจากการส่ง form เพื่ออัพเดต sql ---+
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['form'])) {
      $form = $_POST['form'];
      if ($form == 'form1') { // form 1            
          $form1_sign = $_POST['form1_sign'];
          $form1_input1 = $_POST['form1_input1'];
          $form1_input2 = $_POST['form1_input2'];
          $form1_input3 = $_POST['form1_input3'];
          $form1_input4 = $_POST['form1_input4'];
          $form1_input5 = $_POST['form1_input5'];
          $form1_input6 = $_POST['form1_input6'];
          $form1_input7 = $_POST['form1_input7'];          
          $inlineRadio1 = $_POST['inlineRadio1'];
          $inlineRadio2 = $_POST['inlineRadio2'];
          $inlineRadio3 = $_POST['inlineRadio3'];
          $inlineRadio4 = $_POST['inlineRadio4'];
          $inlineRadio5 = $_POST['inlineRadio5'];
          $inlineRadio6 = $_POST['inlineRadio6'];
          $inlineRadio7 = $_POST['inlineRadio7'];
          $inlineRadio8 = $_POST['inlineRadio8'];
          $inlineRadio9 = $_POST['inlineRadio9'];
          $inlineRadio10 = $_POST['inlineRadio10'];
          $inlineRadio11 = $_POST['inlineRadio11'];
          $inlineRadio12 = $_POST['inlineRadio12'];
          $inlineRadio13 = $_POST['inlineRadio13'];
          $inlineRadio14 = $_POST['inlineRadio14'];
          $inlineRadio15 = $_POST['inlineRadio15'];
          $inlineRadio16 = $_POST['inlineRadio16'];
          $inlineRadio17 = $_POST['inlineRadio17'];
          $inlineRadio18 = $_POST['inlineRadio18'];
          $textarea1 = $_POST['textarea1'];
          $textarea2 = $_POST['textarea2'];
          $textarea3 = $_POST['textarea3'];
          $textarea4 = $_POST['textarea4'];
          $textarea5 = $_POST['textarea5'];
          $textarea6 = $_POST['textarea6'];
          $textarea7 = $_POST['textarea7'];
          $textarea8 = $_POST['textarea8'];
          $textarea9 = $_POST['textarea9'];
          $textarea10 = $_POST['textarea10'];
          $textarea11 = $_POST['textarea11'];
          $textarea12 = $_POST['textarea12'];
          $textarea13 = $_POST['textarea13'];
          $textarea14 = $_POST['textarea14'];
          $textarea15 = $_POST['textarea15'];
          $textarea16 = $_POST['textarea16'];
          $textarea17 = $_POST['textarea17'];      

          $datafrom1 = json_encode([   
              'sign' => $form1_sign,         
              'input1' => $form1_input1,
              'input2' => $form1_input2,
              'input3' => $form1_input3,
              'input4' => $form1_input4,
              'input5' => $form1_input5,
              'input6' => $form1_input6,
              'input7' => $form1_input7,
              'radio1' => $inlineRadio1,
              'radio2' => $inlineRadio2,
              'radio3' => $inlineRadio3,
              'radio4' => $inlineRadio4,
              'radio5' => $inlineRadio5,
              'radio6' => $inlineRadio6,
              'radio7' => $inlineRadio7,
              'radio8' => $inlineRadio8,
              'radio9' => $inlineRadio9,
              'radio10' => $inlineRadio10,
              'radio11' => $inlineRadio11,
              'radio12' => $inlineRadio12,
              'radio13' => $inlineRadio13,
              'radio14' => $inlineRadio14,
              'radio15' => $inlineRadio15,
              'radio16' => $inlineRadio16,
              'radio17' => $inlineRadio17,
              'radio18' => $inlineRadio18,
              'textarea1' => $textarea1,
              'textarea2' => $textarea2,
              'textarea3' => $textarea3,
              'textarea4' => $textarea4,
              'textarea5' => $textarea5,
              'textarea6' => $textarea6,
              'textarea7' => $textarea7,
              'textarea8' => $textarea8,
              'textarea9' => $textarea9,
              'textarea10' => $textarea10,
              'textarea11' => $textarea11,
              'textarea12' => $textarea12,
              'textarea13' => $textarea13,
              'textarea14' => $textarea14,
              'textarea15' => $textarea15,
              'textarea16' => $textarea16,
              'textarea17' => $textarea17,
          ]);

          $sql = "UPDATE medical_equipment SET datafrom1 = :datafrom1 WHERE id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([
              'datafrom1' => $datafrom1,
              'id' => $id
          ]);
      } elseif ($form == 'form2') { // form 2
          $form2_sign = $_POST['form2_sign'];
          $form2_input1 = $_POST['form2_input1'];
          $form2_input2 = $_POST['form2_input2'];
          $form2_input3 = $_POST['form2_input3'];
          $form2_input4 = $_POST['form2_input4'];
          $form2_input5 = $_POST['form2_input5'];
          $form2_input6 = $_POST['form2_input6'];
          $form2_input7 = $_POST['form2_input7'];
          $form2_input8 = $_POST['form2_input8'];
          $form2_input9 = $_POST['form2_input9'];
          $form2_input10 = $_POST['form2_input10'];
          $form2_input11 = $_POST['form2_input11'];
          $form2_input12 = $_POST['form2_input12'];
          $form2_input13 = $_POST['form2_input13'];
          $form2_input14 = $_POST['form2_input14'];
          $form2_input15 = $_POST['form2_input15'];
          $form2_input16 = $_POST['form2_input16'];
          $form2_input17 = $_POST['form2_input17'];
          $form2_input18 = $_POST['form2_input18'];
          $form2_input19 = $_POST['form2_input19'];
          $form2_input20 = $_POST['form2_input20'];
          $form2_input21 = $_POST['form2_input21'];
          $form2_input22 = $_POST['form2_input22'];
          $form2_input23 = $_POST['form2_input23'];
          $form2_input24 = $_POST['form2_input24'];
          $form2_input25 = $_POST['form2_input25'];
          $form2_input26 = $_POST['form2_input26'];
          $form2_input27 = $_POST['form2_input27'];
          $form2_input28 = $_POST['form2_input28'];
          $form2_input29 = $_POST['form2_input29'];
          $form2_input30 = $_POST['form2_input30'];
          $form2_input31 = $_POST['form2_input31'];
          $form2_input32 = $_POST['form2_input32'];
          $form2_input33 = $_POST['form2_input33'];
          $form2_input34 = $_POST['form2_input34'];
          $form2_input35 = $_POST['form2_input35'];
          $form2_input36 = $_POST['form2_input36'];
          $form2_input37 = $_POST['form2_input37'];

          $datafrom2 = json_encode([
              'sign' => $form2_sign,  
              'input1' => $form2_input1,
              'input2' => $form2_input2,
              'input3' => $form2_input3,
              'input4' => $form2_input4,
              'input5' => $form2_input5,
              'input6' => $form2_input6,
              'input7' => $form2_input7,
              'input8' => $form2_input8,
              'input9' => $form2_input9,
              'input10' => $form2_input10,
              'input11' => $form2_input11,
              'input12' => $form2_input12,
              'input13' => $form2_input13,
              'input14' => $form2_input14,
              'input15' => $form2_input15,
              'input16' => $form2_input16,
              'input17' => $form2_input17,
              'input18' => $form2_input18,
              'input19' => $form2_input19,
              'input20' => $form2_input20,
              'input21' => $form2_input21,
              'input22' => $form2_input22,
              'input23' => $form2_input23,
              'input24' => $form2_input24,
              'input25' => $form2_input25,
              'input26' => $form2_input26,
              'input27' => $form2_input27,
              'input28' => $form2_input28,
              'input29' => $form2_input29,
              'input30' => $form2_input30,
              'input31' => $form2_input31,
              'input32' => $form2_input32,
              'input33' => $form2_input33,
              'input34' => $form2_input34,
              'input35' => $form2_input35,
              'input36' => $form2_input36,
              'input37' => $form2_input37,
          ]);

          $sql = "UPDATE medical_equipment SET datafrom2 = :datafrom2 WHERE id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([
              'datafrom2' => $datafrom2,
              'id' => $id
          ]);
      } elseif ($form == 'form3') { // form 3
          $form3_sign = $_POST['form3_sign'];
          $form3_input1 = $_POST['form3_input1'];
          $form3_input2 = $_POST['form3_input2'];
          $form3_input3 = $_POST['form3_input3'];
          $form3_input4 = $_POST['form3_input4'];
          $form3_input5 = $_POST['form3_input5'];
          $form3_input6 = $_POST['form3_input6'];
          $form3_input7 = $_POST['form3_input7'];
          $form3_input8 = $_POST['form3_input8'];
          $form3_input9 = $_POST['form3_input9'];
          $form3_input10 = $_POST['form3_input10'];
          $form3_input11 = $_POST['form3_input11'];
          $form3_input12 = $_POST['form3_input12'];
          $form3_input13 = $_POST['form3_input13'];
          $form3_input14 = $_POST['form3_input14'];
          $form3_input15 = $_POST['form3_input15'];
          $form3_input16 = $_POST['form3_input16'];
          $form3_input17 = $_POST['form3_input17'];

          $datafrom3 = json_encode([
              'sign' => $form3_sign,  
              'input1' => $form3_input1,
              'input2' => $form3_input2,
              'input3' => $form3_input3,
              'input4' => $form3_input4,
              'input5' => $form3_input5,
              'input6' => $form3_input6,
              'input7' => $form3_input7,
              'input8' => $form3_input8,
              'input9' => $form3_input9,
              'input10' => $form3_input10,
              'input11' => $form3_input11,
              'input12' => $form3_input12,
              'input13' => $form3_input13,
              'input14' => $form3_input14,
              'input15' => $form3_input15,
              'input16' => $form3_input16,
              'input17' => $form3_input17,
          ]);

          $sql = "UPDATE medical_equipment SET datafrom3 = :datafrom3 WHERE id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([
              'datafrom3' => $datafrom3,
              'id' => $id
          ]);
      }

      // Return updated data
      $sql = "SELECT datafrom1, datafrom2, datafrom3 FROM medical_equipment WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
          $datafrom1 = json_decode($result['datafrom1'], true);
          $datafrom2 = json_decode($result['datafrom2'], true);
          $datafrom3 = json_decode($result['datafrom3'], true);
      }

      echo json_encode([
          'datafrom1' => $datafrom1,
          'datafrom2' => $datafrom2,
          'datafrom3' => $datafrom3
      ]);
      exit;
  }
}

// +--- 3. ดึงค่า sql อัพเดต form โหลดหน้าเว็บครั้งแรก และจากการรับฟอร์ม ---+
// form 1
$form1_sign = $datafrom1['sign'] ?? '';
$form1_input1 = $datafrom1['input1'] ?? '';
$form1_input2 = $datafrom1['input2'] ?? '';
$form1_input3 = $datafrom1['input3'] ?? '';
$form1_input4 = $datafrom1['input4'] ?? '';
$form1_input5 = $datafrom1['input5'] ?? '';
$form1_input6 = $datafrom1['input6'] ?? '';
$form1_input7 = $datafrom1['input7'] ?? '';
$form1_radio1 = $datafrom1['radio1'] ?? '';
$form1_radio2 = $datafrom1['radio2'] ?? '';
$form1_radio3 = $datafrom1['radio3'] ?? '';
$form1_radio4 = $datafrom1['radio4'] ?? '';
$form1_radio5 = $datafrom1['radio5'] ?? '';
$form1_radio6 = $datafrom1['radio6'] ?? '';
$form1_radio7 = $datafrom1['radio7'] ?? '';
$form1_radio8 = $datafrom1['radio8'] ?? '';
$form1_radio9 = $datafrom1['radio9'] ?? '';
$form1_radio10 = $datafrom1['radio10'] ?? '';
$form1_radio11 = $datafrom1['radio11'] ?? '';
$form1_radio12 = $datafrom1['radio12'] ?? '';
$form1_radio13 = $datafrom1['radio13'] ?? '';
$form1_radio14 = $datafrom1['radio14'] ?? '';
$form1_radio15 = $datafrom1['radio15'] ?? '';
$form1_radio16 = $datafrom1['radio16'] ?? '';
$form1_radio17 = $datafrom1['radio17'] ?? '';
$form1_radio18 = $datafrom1['radio18'] ?? '';
$form1_textarea1 = $datafrom1['textarea1'] ?? '';
$form1_textarea2 = $datafrom1['textarea2'] ?? '';
$form1_textarea3 = $datafrom1['textarea3'] ?? '';
$form1_textarea4 = $datafrom1['textarea4'] ?? '';
$form1_textarea5 = $datafrom1['textarea5'] ?? '';
$form1_textarea6 = $datafrom1['textarea6'] ?? '';
$form1_textarea7 = $datafrom1['textarea7'] ?? '';
$form1_textarea8 = $datafrom1['textarea8'] ?? '';
$form1_textarea9 = $datafrom1['textarea9'] ?? '';
$form1_textarea10 = $datafrom1['textarea10'] ?? '';
$form1_textarea11 = $datafrom1['textarea11'] ?? '';
$form1_textarea12 = $datafrom1['textarea12'] ?? '';
$form1_textarea13 = $datafrom1['textarea13'] ?? '';
$form1_textarea14 = $datafrom1['textarea14'] ?? '';
$form1_textarea15 = $datafrom1['textarea15'] ?? '';
$form1_textarea16 = $datafrom1['textarea16'] ?? '';
$form1_textarea17 = $datafrom1['textarea17'] ?? '';

// form 2
$form2_sign = $datafrom2['sign'] ?? '';
$form2_input1 = $datafrom2['input1'] ?? '';
$form2_input2 = $datafrom2['input2'] ?? '';
$form2_input3 = $datafrom2['input3'] ?? '';
$form2_input4 = $datafrom2['input4'] ?? '';
$form2_input5 = $datafrom2['input5'] ?? '';
$form2_input6 = $datafrom2['input6'] ?? '';
$form2_input7 = $datafrom2['input7'] ?? '';
$form2_input8 = $datafrom2['input8'] ?? '';
$form2_input9 = $datafrom2['input9'] ?? '';
$form2_input10 = $datafrom2['input10'] ?? '';
$form2_input11 = $datafrom2['input11'] ?? '';
$form2_input12 = $datafrom2['input12'] ?? '';
$form2_input13 = $datafrom2['input13'] ?? '';
$form2_input14 = $datafrom2['input14'] ?? '';
$form2_input15 = $datafrom2['input15'] ?? '';
$form2_input16 = $datafrom2['input16'] ?? '';
$form2_input17 = $datafrom2['input17'] ?? '';
$form2_input18 = $datafrom2['input18'] ?? '';
$form2_input19 = $datafrom2['input19'] ?? '';
$form2_input20 = $datafrom2['input20'] ?? '';
$form2_input21 = $datafrom2['input21'] ?? '';
$form2_input22 = $datafrom2['input22'] ?? '';
$form2_input23 = $datafrom2['input23'] ?? '';
$form2_input24 = $datafrom2['input24'] ?? '';
$form2_input25 = $datafrom2['input25'] ?? '';
$form2_input26 = $datafrom2['input26'] ?? '';
$form2_input27 = $datafrom2['input27'] ?? '';
$form2_input28 = $datafrom2['input28'] ?? '';
$form2_input29 = $datafrom2['input29'] ?? '';
$form2_input30 = $datafrom2['input30'] ?? '';
$form2_input31 = $datafrom2['input31'] ?? '';
$form2_input32 = $datafrom2['input32'] ?? '';
$form2_input33 = $datafrom2['input33'] ?? '';
$form2_input34 = $datafrom2['input34'] ?? '';
$form2_input35 = $datafrom2['input35'] ?? '';
$form2_input36 = $datafrom2['input36'] ?? '';
$form2_input37 = $datafrom2['input37'] ?? '';

// form 3
$form3_sign = $datafrom3['sign'] ?? '';
$form3_input1 = $datafrom3['input1'] ?? '';
$form3_input2 = $datafrom3['input2'] ?? '';
$form3_input3 = $datafrom3['input3'] ?? '';
$form3_input4 = $datafrom3['input4'] ?? '';
$form3_input5 = $datafrom3['input5'] ?? '';
$form3_input6 = $datafrom3['input6'] ?? '';
$form3_input7 = $datafrom3['input7'] ?? '';
$form3_input8 = $datafrom3['input8'] ?? '';
$form3_input9 = $datafrom3['input9'] ?? '';
$form3_input10 = $datafrom3['input10'] ?? '';
$form3_input11 = $datafrom3['input11'] ?? '';
$form3_input12 = $datafrom3['input12'] ?? '';
$form3_input13 = $datafrom3['input13'] ?? '';
$form3_input14 = $datafrom3['input14'] ?? '';
$form3_input15 = $datafrom3['input15'] ?? '';
$form3_input16 = $datafrom3['input16'] ?? '';
$form3_input17 = $datafrom3['input17'] ?? '';

// ดึงข้อมูลจากตาราง users โดยใช้ user_id จาก session
$user_id = $_SESSION['user_id'];
$user = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user->execute();
$users = $user->fetch(PDO::FETCH_ASSOC);

$conn = null;
?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>AT PREVENT</title>

    <meta name="description" content="" />

    <!-- logo -->
    <link rel="icon" type="image/x-icon" href="..\..\assets\img\icons\brands\logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Bootstrap DatePicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>   
    
    <!-- คำนวณ | เชื่อมโยงกับไฟล์ form-functions.js -->
    <script src="../pages-form_js/form_11-functions.js"></script>

    <style>
        /* กำหนดสีดำให้กับข้อความภายใน div ที่มีคลาส black-text */
        .black-text * {
            color: #202020 !important;
        }
    </style>

    <!-- ปุ่มรายเซ็นต์ -->
    <script>
      function toggleSignature(inputId, signatureIds) {
        const inputField = document.getElementById(inputId);
        const idsArray = signatureIds.split(',');

        idsArray.forEach(signatureId => {
          const signatureDiv = document.getElementById(signatureId);
          if (inputField.value.trim() === "") {
            signatureDiv.style.display = 'none';
          } else {
            signatureDiv.style.display = 'block';
          }
        });
      }

      function toggleInputValue(imageId, inputId, name) {
        const inputField = document.getElementById(inputId);

        if (inputField.value.trim() !== "") {
          return;
        }

        inputField.value = name;
        toggleSignature(inputId, inputField.dataset.signatureId);
      }

      document.addEventListener("DOMContentLoaded", function() {
        const inputFields = document.querySelectorAll('.signature-input');
        inputFields.forEach(input => {
          // Check the initial value and set the display state
          toggleSignature(input.id, input.dataset.signatureId);

          input.addEventListener('input', function() {
            toggleSignature(this.id, this.dataset.signatureId);
          });
        });

        const images = document.querySelectorAll('.timestamp__image');
        images.forEach(image => {
          image.addEventListener('click', function() {
            toggleInputValue(image.id, image.dataset.inputId, image.dataset.name);
          });
        });
      });
    </script>
  </head>

  <body onload="calculateSum()">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="../../index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src="..\..\assets\img\icons\brands\logo.png" width="45" height="45" alt="Brand Logo">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">AT PREVENT</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="../../index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Form -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Forms</span>
            </li>
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Account Settings">Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="../pages-hospita-information.php" class="menu-link">
                    <div data-i18n="Account">Hospital information</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="../pages-medical-equipment.php?id=<?php echo $hospital_id; ?>" class="menu-link">
                    <div data-i18n="Notifications">Medical equipment</div>
                  </a>
                </li>
                <li class="menu-item active">
                  <a href="javascript:void(0);" class="menu-link">
                    <div data-i18n="Connections">Form</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a
                href="https://www.facebook.com/profile.php?id=100029998816317"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a><?php echo $users['accounts']; ?> Account</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $users['name']; ?></span>
                            <small class="text-muted"><?php echo $users['accounts']; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hospital information / Medical equipment /</span> Form </h4>

              <!-- เปลี่ยน Form bar -->
              <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                  <a class="nav-link" href="../pages-hospita-information.php"><i class="bx bx-buildings"></i> Hospital information</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../pages-medical-equipment.php?id=<?php echo $hospital_id; ?>"><i class="bx bxs-vial" style="position: relative; top: -1px;"></i> Medical equipment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-task" style="position: relative; top: -2px;"></i> Form</a>
                </li>
              </ul>
              <!-- / เปลี่ยน Form bar -->

              <!-- เปลี่ยนรายการ -->
              <div class="my-form">
                <!-- ฟอร์มหลายขั้นตอน -->
                <div class="my-form-multisteps-form">
                  <div class="row">
                    <div class="col-12 col-lg-8 ml-auto m-auto mb-4 mt-4">
                      <!-- Progress bar ของฟอร์มหลายขั้นตอน -->
                      <div class="my-form-multisteps-form__progress">
                        <button class="my-form-multisteps-form__progress-btn js-active" type="button" title="Preventive Maintenance Report">
                          Preventive Maintenance Report<br>
                          <span class="mt-2 badge rounded-pill bg-warning">Pending</span>
                          <!-- <span class="mt-2 badge rounded-pill bg-success">Completed</span> -->
                        </button>
                        <button class="my-form-multisteps-form__progress-btn" type="button" title="Calibration Report">
                          Data of Calibration Report<br>
                          <span class="mt-2 badge rounded-pill bg-warning">Pending</span>
                          <!-- <span class="mt-2 badge rounded-pill bg-success">Completed</span> -->
                        </button>
                        <button class="my-form-multisteps-form__progress-btn" type="button" title="Success">
                          Report of Measurement Result<br>
                          <span class="mt-2 badge rounded-pill bg-warning">Pending</span>
                          <!-- <span class="mt-2 badge rounded-pill bg-success">Completed</span> -->
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="m-auto">
                      <!-- ฟอร์มหลักของฟอร์มหลายขั้นตอน -->
                      <div class="my-form-multisteps-form__form">
                        <!-- แผง Preventive Maintenance Report -->
                        <div class="my-form-multisteps-form__panel card mb-4 p-4 js-active" data-animation="fadeIn">                          
                          <div class="">
                            <form id="form1" onsubmit="event.preventDefault(); submitBothForms('form1'); calculateSum();">
                              <!-- PM form -->
                              <div>
                                <div class="card-header d-flex align-items-center justify-content-center black-text">
                                  <img src="..\..\assets\img\icons\brands\logo.png" width="100" height="100" alt="Brand Logo">
                                  <h3 class="mb-0" style="text-align: center; padding-left: 1.5rem; line-height: 1.5;">AT PREVENT & CALIBRATION LIMITED PARTNERSHIP<br>276  Moo 21,  Sila, Amphoe  Mueang,<br>Khon Kaen  40000  Tel.0-4334-7362</h3>
                                </div><br>
                                <div class="black-text" style="border: 1px solid black; text-align: center; vertical-align: middle; padding-top: 1rem; width: 80%; margin: 0 auto;">
                                  <h3>ใบรายงานผลการบำรุงรักษา</h3>
                                </div>
                                <div class="row gy-3 pt-3">
                                  <!-- PM form ซ้าย -->
                                  <div class="col-xl-6">
                                    <div class="card-body">
                                      <div class="black-text">
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Department:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($hospital_name); ?>" placeholder="" style="background-color: white;" readonly/>                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Date:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control date-input" name="form1_input1" value="<?php echo htmlspecialchars($form1_input1); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Equipment:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($Equipment); ?>" placeholder="" style="background-color: white;" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Serial No. :</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form1_input2" value="<?php echo htmlspecialchars($form1_input2); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">เลขครุภัณฑ์:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form1_input3" value="<?php echo htmlspecialchars($form1_input3); ?>" placeholder="">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- / PM form ซ้าย -->
                                  <!-- PM form ขวา -->
                                  <div class="col-xl-6">
                                  <div class="card-body">
                                    <div class="black-text">
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Province:</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($hospital_province); ?>" placeholder="" style="background-color: white;" readonly/>
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Section:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form1_input4" value="<?php echo htmlspecialchars($form1_input4); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Manufacture:</label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" name="form1_input5" value="<?php echo htmlspecialchars($form1_input5); ?>" placeholder="">
                                        </div>
                                        <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">&nbsp;&nbsp;Model:</label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" name="form1_input6" value="<?php echo htmlspecialchars($form1_input6); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">ID. No. :</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" value="<?php echo htmlspecialchars($IDNo); ?>" placeholder="" style="background-color: white;" readonly/>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- / PM form ขวา -->
                                </div>
                              </div>                    
                              <!-- / PM form -->
                              <!-- ตาราง -->
                              <div class="card mb-4 mx-3 black-text">
                                <table class="table">
                                  <thead style="text-align: center; vertical-align: middle; background-color: white; font-weight: bold;">
                                    <tr>
                                      <th rowspan="2" style="font-size: 0.9rem;">รายละเอียดการตรวจเช็ค</th>
                                      <th colspan="3" style="font-size: 0.9rem;">ผลการตรวจเช็ค</th>
                                      <th rowspan="2" style="font-size: 0.9rem;">หมายเหตุ</th>
                                    </tr>
                                    <tr>
                                      <th style="width: 12%; font-size: 0.9rem;">ผ่าน</th>
                                      <th style="width: 12%; font-size: 0.9rem;">แก้ไข</th>
                                      <th style="width: 12%; font-size: 0.9rem;">ไม่มี/ไม่ทำ</th>
                                    </tr>
                                  </thead>
                                  <tbody style="text-align: center; vertical-align: middle;">
                                    <!-- รายการที่ 1 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>1. โครงสร้าง / ตัวถังของเครื่อง</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio1" value="option1" <?php echo $form1_radio1 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio1" value="option2" <?php echo $form1_radio1 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio1" value="option3" <?php echo $form1_radio1 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea1" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea1); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 2 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>2. ความมั่นคง / แข็งแรงของที่ติดตั้ง</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio2" value="option1" <?php echo $form1_radio2 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio2" value="option2" <?php echo $form1_radio2 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio2" value="option3" <?php echo $form1_radio2 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea2" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea2); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 3 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>3. สภาพของผ้าพันแขน (CUFF)</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio3" value="option1" <?php echo $form1_radio3 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio3" value="option2" <?php echo $form1_radio3 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio3" value="option3" <?php echo $form1_radio3 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea3" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea3); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 4 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>4. อะแดปเตอร์</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio4" value="option1" <?php echo $form1_radio4 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio4" value="option2" <?php echo $form1_radio4 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio4" value="option3" <?php echo $form1_radio4 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea4" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea4); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 5 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>5. แบตเตอรี่</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio5" value="option1" <?php echo $form1_radio5 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio5" value="option2" <?php echo $form1_radio5 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio5" value="option3" <?php echo $form1_radio5 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea5" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea5); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 6 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>6.สภาพของลูกยางบีบ</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio6" value="option1" <?php echo $form1_radio6 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio6" value="option2" <?php echo $form1_radio6 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio6" value="option3" <?php echo $form1_radio6 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea6" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea6); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 7 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>7. หน้าจอแสดงผล (Display Panel)</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio7" value="option1" <?php echo $form1_radio7 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio7" value="option2" <?php echo $form1_radio7 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio7" value="option3" <?php echo $form1_radio7 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea7" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea7); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 8 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>8. สวิทซ์ เปิด/ปิด (Power ON/OFF)</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio8" value="option1" <?php echo $form1_radio8 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio8" value="option2" <?php echo $form1_radio8 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio8" value="option3" <?php echo $form1_radio8 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea8" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea8); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 9 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>9. ปุ่มกด/แผงปุ่มกด (Key Switch)</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio9" value="option1" <?php echo $form1_radio9 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio9" value="option2" <?php echo $form1_radio9 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio9" value="option3" <?php echo $form1_radio9 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea9" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea9); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 10 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>10. ฝาปิด/ฝาครอบ/แผ่นครอบ</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio10" value="option1" <?php echo $form1_radio10 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio10" value="option2" <?php echo $form1_radio10 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio10" value="option3" <?php echo $form1_radio10 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea10" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea10); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 11 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>11. ป้ายแสดงรายละเอียดต่างๆ</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio11" value="option1" <?php echo $form1_radio11 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio11" value="option2" <?php echo $form1_radio11 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio11" value="option3" <?php echo $form1_radio11 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea11" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea11); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 12 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>12. ปั๊มลม</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio12" value="option1" <?php echo $form1_radio12 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio12" value="option2" <?php echo $form1_radio12 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio12" value="option3" <?php echo $form1_radio12 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea12" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea12); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 13 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>13. การตรวจสอบระบบของเครื่องก่อนการใช้งาน</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio13" value="option1" <?php echo $form1_radio13 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio13" value="option2" <?php echo $form1_radio13 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio13" value="option3" <?php echo $form1_radio13 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea13" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea13); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 14 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>14. การรั่วไหลของลมจากเครื่อง</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio14" value="option1" <?php echo $form1_radio14 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio14" value="option2" <?php echo $form1_radio14 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio14" value="option3" <?php echo $form1_radio14 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea14" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea14); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 15 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>15. อัตราการเต้นของหัวใจ</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio15" value="option1" <?php echo $form1_radio15 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio15" value="option2" <?php echo $form1_radio15 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio15" value="option3" <?php echo $form1_radio15 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea15" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea15); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 16 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>16. ทดสอบความแม่นยำของแรงดัน</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio16" value="option1" <?php echo $form1_radio16 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio16" value="option2" <?php echo $form1_radio16 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio16" value="option3" <?php echo $form1_radio16 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea16" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea16); ?></textarea>
                                      </td>
                                    </tr>
                                    <!-- รายการที่ 17 -->
                                    <tr>
                                      <td style="text-align: left;"><strong>17. ความแม่นยำของการวัด (60-240 mmHg)</strong></td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio17" value="option1" <?php echo $form1_radio17 == 'option1' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio17" value="option2" <?php echo $form1_radio17 == 'option2' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-check form-check-inline" style="padding-left: 3rem;">
                                          <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio17" value="option3" <?php echo $form1_radio17 == 'option3' ? 'checked' : ''; ?>>
                                        </div>
                                      </td>
                                      <td class="col-md-3">
                                        <textarea class="form-control" name="textarea17" rows="3" style="height: 17px;"><?php echo htmlspecialchars($form1_textarea17); ?></textarea>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- / ตาราง -->
                              <!-- สรุปผล -->
                              <div class="row m-3 black-text">
                                <div class="col-md pb-3 pt-4">
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">สรุปผลการดูแลรักษา:</label>
                                    <div class="form-check form-check-inline">
                                      <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio18" value="option1" <?php echo $form1_radio18 == 'option1' ? 'checked' : ''; ?>>
                                      <label class="form-check-label" for="inlineRadio1">ผ่าน</label>
                                    </div>
                                  <div class="form-check form-check-inline">
                                    <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio18" value="option2" <?php echo $form1_radio18 == 'option2' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="inlineRadio2">ต้องแก้ไข</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input style="border: 1px solid #233446;" class="form-check-input" type="radio" name="inlineRadio18" value="option3" <?php echo $form1_radio18 == 'option3' ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="inlineRadio3">หยุดใช้งานเครื่อง</label>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">สถานะของเครื่อง:</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" name="form1_input7" value="<?php echo htmlspecialchars($form1_input7); ?>" placeholder="">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">บำรุงรักษาโดย:</label>
                                  <div class="col-sm-3" style="display: flex;">                                  
                                    <div id="signatureHide1" class="signatureHide">
                                      <!-- แสดง form1_sign --><h4>completed!</h4>
                                    </div>
                                    <img src="../../assets/img/signature/signature-icon1.png" style="margin-top: -4px;" id="image1" class="timestamp__image" data-input-id="signatureInput1" data-name="<?php echo $users['name']; ?>" alt="Signature Stamp 1">
                                    <input type="hidden" id="signatureInput1" class="signature-input" data-signature-id="signatureHide1" name="form1_sign" value="<?php echo htmlspecialchars($form1_sign); ?>" placeholder="">
                                  </div>
                                </div>
                              </div>
                              <!-- / สรุปผล -->
                              <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                              </div>
                            </form>
                            <div class="d-flex justify-content-center mx-auto gap-3 pt-4">
                              <div style="flex-basis: 73px;"></div>
                              <button class="btn btn-dark ml-auto js-btn-next" type="button" title="Next">Next</button>
                            </div>
                          </div>
                        </div>
                        <!-- แผง Calibration Report -->
                        <div class="my-form-multisteps-form__panel card mb-4 p-4" data-animation="fadeIn">
                          <div class="">
                          <form id="form2" onsubmit="event.preventDefault(); submitBothForms('form2'); calculateSum();">
                              <!-- header -->
                              <div>
                                <div class="card-header d-flex align-items-center justify-content-center black-text">
                                  <img src="..\..\assets\img\icons\brands\logo.png" width="100" height="100" alt="Brand Logo">
                                  <h3 class="mb-0" style="text-align: center; padding-left: 1.5rem; line-height: 1.5;">AT PREVENT & CALIBRATION LIMITED PARTNERSHIP<br>276  Moo 21,  Sila, Amphoe  Mueang,<br>Khon Kaen  40000  Tel.0-4334-7362</h3>
                                </div><br>
                                <div class="black-text" style="border: 1px solid black; text-align: center; vertical-align: middle; padding-top: 1rem; width: 80%; margin: 0 auto;">
                                  <h3>Data of Calibration</h3>
                                </div>
                                <div class="row gy-3 pt-3">
                                  <!-- header ซ้าย -->
                                  <div class="col-xl-6">
                                    <div class="card-body">
                                      <div class="black-text" >
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Department:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($hospital_name); ?>" placeholder="" style="background-color: white;" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Addresse:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($hospital_province); ?>" placeholder="" style="background-color: white;" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Equipment:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($Equipment); ?>" placeholder="" style="background-color: white;" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Manufacture:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form2_input1" value="<?php echo htmlspecialchars($form2_input1); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Model:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form2_input2" value="<?php echo htmlspecialchars($form2_input2); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Humidity:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form2_input3" value="<?php echo htmlspecialchars($form2_input3); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Temparature:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form2_input4" value="<?php echo htmlspecialchars($form2_input4); ?>" placeholder="">
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Warm up time:</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" name="form2_input5" value="<?php echo htmlspecialchars($form2_input5); ?>" placeholder="">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- / header ซ้าย -->
                                  <!-- header ขวา -->
                                  <div class="col-xl-6">
                                  <div class="card-body">
                                    <div class="black-text" >
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Section:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input6" value="<?php echo htmlspecialchars($form2_input6); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Finish:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input7" value="<?php echo htmlspecialchars($form2_input7); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Cert. No. :</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input8" value="<?php echo htmlspecialchars($form2_input8); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">ID. No. :</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input9" value="<?php echo htmlspecialchars($form2_input9); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Serial No. :</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input10" value="<?php echo htmlspecialchars($form2_input10); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Test Date:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control date-input" name="form2_input11" value="<?php echo htmlspecialchars($form2_input11); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Resolution:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="form2_input12" value="<?php echo htmlspecialchars($form2_input12); ?>" placeholder="">
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Approve Date:</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control date-input" name="form2_input13" value="<?php echo htmlspecialchars($form2_input13); ?>" placeholder="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- / header ขวา -->
                                </div>
                              </div>                    
                              <!-- / header -->
                              <div class="m-3 mb-4 black-text">
                                <h4 style="display: inline; text-decoration: underline; font-weight: bold;">NIBP</h4>
                                <span style="text-decoration: none; font-weight: normal; font-size: 1.2rem;">&nbsp;&nbsp;&nbsp;BC</span>
                              </div>
                              <!-- ตาราง -->
                              <div class="card mb-4 mx-3 p-4 black-text">
                                <table style="width: 100%; border-collapse: collapse;">
                                  <tbody>
                                    <tr>
                                      <td rowspan="2">&nbsp;&nbsp;Value&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input14" value="<?php echo htmlspecialchars($form2_input14); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input15" value="<?php echo htmlspecialchars($form2_input15); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input16" value="<?php echo htmlspecialchars($form2_input16); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input17" value="<?php echo htmlspecialchars($form2_input17); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input18" value="<?php echo htmlspecialchars($form2_input18); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td colspan="1" style="padding: 8px; text-align: center;"><input type="text" name="form2_input19" value="<?php echo htmlspecialchars($form2_input19); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <th style="padding: 8px; text-align: center;">Systolic</th>
                                      <th style="padding: 8px; text-align: center;">Diastolic</th>
                                      <th style="padding: 8px; text-align: center;">Systolic</th>
                                      <th style="padding: 8px; text-align: center;">Diastolic</th>
                                      <th style="padding: 8px; text-align: center;">Systolic</th>
                                      <th style="padding: 8px; text-align: center;">Diastolic</th>
                                    </tr>
                                    <tr>
                                      <td style="padding: 8px; text-align: center;">1</td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input20" value="<?php echo htmlspecialchars($form2_input20); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input21" value="<?php echo htmlspecialchars($form2_input21); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input22" value="<?php echo htmlspecialchars($form2_input22); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input23" value="<?php echo htmlspecialchars($form2_input23); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input24" value="<?php echo htmlspecialchars($form2_input24); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input25" value="<?php echo htmlspecialchars($form2_input25); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td style="padding: 8px; text-align: center;">2</td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input26" value="<?php echo htmlspecialchars($form2_input26); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input27" value="<?php echo htmlspecialchars($form2_input27); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input28" value="<?php echo htmlspecialchars($form2_input28); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input29" value="<?php echo htmlspecialchars($form2_input29); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input30" value="<?php echo htmlspecialchars($form2_input30); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input31" value="<?php echo htmlspecialchars($form2_input31); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                    </tr>
                                    <tr>
                                      <td style="padding: 8px; text-align: center;">3</td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input32" value="<?php echo htmlspecialchars($form2_input32); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input33" value="<?php echo htmlspecialchars($form2_input33); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input34" value="<?php echo htmlspecialchars($form2_input34); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input35" value="<?php echo htmlspecialchars($form2_input35); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input36" value="<?php echo htmlspecialchars($form2_input36); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                      <td style="padding: 8px; text-align: center;"><input type="text" name="form2_input37" value="<?php echo htmlspecialchars($form2_input37); ?>" style="width: 100%; box-sizing: border-box; text-align: center; height: 28px;" class="form-control"></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- / ตาราง -->
                              <!-- สรุปผล -->
                              <div class="row m-3 black-text">
                                <div class="card">
                                  <div class="row m-3 pt-4"><h4 style="display: inline; font-weight: bold;">Result</h4></div>
                                  <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                      <table class="table table-bordered" style="text-align: center; border: 1px solid black;">
                                        <tbody>
                                          <tr>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">UUC Systolic<br>Reading<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Average<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">SD<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Uncertainty.br<br>Type A<br>(±mmHg)</td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result1"></span></td>
                                            <td><span id="form2_result7"></span></td>
                                            <td><span id="form2_result13"></span></td>
                                            <td><span id="form2_result19"></span></td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result2"></span></td>
                                            <td><span id="form2_result8"></span></td>
                                            <td><span id="form2_result14"></span></td>
                                            <td><span id="form2_result20"></span></td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result3"></span></td>
                                            <td><span id="form2_result9"></span></td>
                                            <td><span id="form2_result15"></span></td>
                                            <td><span id="form2_result21"></span></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                      <table class="table table-bordered" style="text-align: center; border: 1px solid black;">
                                        <tbody>
                                          <tr>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">UUC Diastolic<br>Reading<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Average<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">SD<br>(mmHg)</td>
                                            <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Uncertainty.br<br>Type A<br>(±mmHg)</td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result4"></span></td>
                                            <td><span id="form2_result10"></span></td>
                                            <td><span id="form2_result16"></span></td>
                                            <td><span id="form2_result22"></span></td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result5"></span></td>
                                            <td><span id="form2_result11"></span></td>
                                            <td><span id="form2_result17"></span></td>
                                            <td><span id="form2_result23"></span></td>
                                          </tr>
                                          <tr>
                                            <td><span id="form2_result6"></span></td>
                                            <td><span id="form2_result12"></span></td>
                                            <td><span id="form2_result18"></span></td>
                                            <td><span id="form2_result24"></span></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>   
                                </div>                             
                              </div>
                              <!-- / สรุปผล -->
                              <div class="row m-3 mt-5 black-text">
                                <div class="row mb-3">
                                  <label class="col-sm-1" for="basic-default-name" style="font-size: 1.05rem;">Test by :</label>
                                  <div class="col-sm-3" style="display: flex;">                                  
                                    <div id="signatureHide2" class="signatureHide">
                                      <!-- แสดง form2_sign --><h4>completed!</h4>
                                    </div>
                                    <img src="../../assets/img/signature/signature-icon1.png" style="margin-top: -4px;" id="image2" class="timestamp__image" data-input-id="signatureInput2" data-name="<?php echo $users['name']; ?>" alt="Signature Stamp 2">
                                    <input type="hidden" id="signatureInput2" class="signature-input" data-signature-id="signatureHide2" name="form2_sign" value="<?php echo htmlspecialchars($form2_sign); ?>" placeholder="">
                                  </div>
                                </div>
                              </div>
                              <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                              </div>
                            </form>
                            <div class="row">
                              <div class="d-flex justify-content-center mx-auto gap-3 pt-4">
                                <button class="btn btn-dark js-btn-prev" type="button" title="Prev">Prev</button>
                                <button class="btn btn-dark ml-auto js-btn-next" type="button" title="Next">Next</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Report of Measurement Result -->
                        <div class="my-form-multisteps-form__panel card mb-4 p-4" data-animation="fadeIn">                          
                          <div class="">
                            <form id="form3" onsubmit="event.preventDefault(); submitBothForms('form3'); calculateSum();">                              
                              <!-- header -->
                              <div>
                                <div class="card-header d-flex align-items-center justify-content-center black-text">
                                  <img src="..\..\assets\img\icons\brands\logo.png" width="100" height="100" alt="Brand Logo">
                                  <h3 class="mb-0" style="text-align: center; padding-left: 1.5rem; line-height: 1.5;">AT PREVENT & CALIBRATION LIMITED PARTNERSHIP<br>276  Moo 21,  Sila, Amphoe  Mueang,<br>Khon Kaen  40000  Tel.0-4334-7362</h3>
                                </div><br>
                                <div class="black-text"  style="border: 1px solid black; text-align: center; vertical-align: middle; padding-top: 1rem; width: 80%; margin: 0 auto;">
                                  <h3>Report of Measurement Result</h3>
                                </div>
                                <div class="row gy-3 black-text" style="text-align: right; vertical-align: middle; padding-top: 1rem; padding-right: 1rem; margin: 0 auto;">
                                  <h5 style="line-height: 1.7;">Cert. No. : 23ATP10195<br><strong>Page</strong> 1 of 2</h5>
                                </div>
                                <div class="row gy-3 pt-1 black-text">
                                    <!-- header ซ้าย -->
                                    <div class="col-xl-6" style="padding-left: 7rem;">
                                      <div class="card-body">
                                        <div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Equipment : Digital Blood Pressure</label>
                                          </div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Manufacture : Union Technology</label>
                                          </div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Model :U82 RH</label>
                                          </div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Serial No : -</label>
                                          </div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">ID. No : BPD-TTM-001</label>
                                          </div>
                                          <div class="row">
                                            <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Test Date : 10 July 2023</label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- / header ซ้าย -->
                                    <!-- header ขวา -->
                                    <div class="col-xl-6" style="padding-left: 4rem;">
                                    <div class="card-body">
                                      <div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Department : โรงพยาบาลเปือยน้อย</label>
                                        </div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Addresse : ขอนแก่น</label>
                                        </div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Section : แพทย์แผนไทย</label>
                                        </div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Temparature : 25.4 °C</label>
                                        </div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Humidity : 65%</label>
                                        </div>
                                        <div class="row">
                                          <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem;">Approve Date : 18 August 2023</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- / header ขวา -->
                                </div>
                              </div>                    
                              <!-- / PM form -->
                              <div class="m-3 mb-4 black-text">
                                <h4 style="text-decoration: underline; font-weight: bold;">Measurement Result</h4>
                                <h5 style="font-weight: bold;">NIBP</h5>
                              </div>
                              <!-- ตาราง -->
                              <div class="card mb-4 mx-3 black-text">
                                <table class="table table-bordered" style="text-align: center; border: 1px solid black;">
                                  <tbody>
                                    <tr>
                                        <th style="font-weight: bold;">Nominal Value</th>
                                        <th style="font-weight: bold;">STD Reading</th>
                                        <th style="font-weight: bold;">UUT Reading</th>
                                        <th style="font-weight: bold;">Error</th>
                                        <th style="font-weight: bold;" rowspan="2">Uncertainty</th>
                                        <th style="font-weight: bold;" rowspan="3">Result</th>
                                    </tr>
                                    <tr>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                    </tr>
                                    <tr>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(±mmHg)</th>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result1"></span></td>
                                        <td><span id="form3_result1copy"></span></td>
                                        <td>round($result_C20)</td>
                                        <td>round($result_D20)</td>
                                        <td>0.7 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result2"></span></td>
                                        <td><span id="form3_result2copy"></span></td>
                                        <td>round($result_C21)</td>
                                        <td>round($result_D21)</td>
                                        <td>0.7 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result3"></span></td>
                                        <td><span id="form3_result3copy"></span></td>
                                        <td>round($result_C22)</td>
                                        <td>round($result_D22)</td>
                                        <td>0.7 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- / ตาราง --> 
                              <div class="m-3 mb-4 black-text">
                                <h4 style="display: inline; font-weight: bold; font-size: 1.1rem;">Maximum Permissible Error (MPE) :</h4>
                                <span style="text-decoration: none; font-weight: normal; font-size: 1.1rem;">&nbsp;&nbsp;±8 (mmHg)</span>
                              </div>
                              <!-- ตาราง -->
                              <div class="card mb-4 mx-3 black-text">
                                <table class="table table-bordered" style="text-align: center; border: 1px solid black;">
                                  <tbody>
                                    <tr>
                                        <th style="font-weight: bold;">Nominal Value</th>
                                        <th style="font-weight: bold;">STD Reading</th>
                                        <th style="font-weight: bold;">UUT Reading</th>
                                        <th style="font-weight: bold;">Error</th>
                                        <th style="font-weight: bold;" rowspan="2">Uncertainty</th>
                                        <th style="font-weight: bold;" rowspan="3">Result</th>
                                    </tr>
                                    <tr>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                        <th style="font-weight: bold;">Systolic</th>
                                    </tr>
                                    <tr>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(mmHg)</th>
                                        <th style="font-weight: bold;">(±mmHg)</th>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result4"></span></td>
                                        <td><span id="form3_result4copy"></span></td>
                                        <td>round($result_C20)</td>
                                        <td>round($result_D20)</td>
                                        <td>0.7 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result5"></span></td>
                                        <td><span id="form3_result5copy"></span></td>
                                        <td>round($result_C21)</td>
                                        <td>round($result_D21)</td>
                                        <td>0.6 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                    <tr>
                                        <td><span id="form3_result6"></span></td>
                                        <td><span id="form3_result6copy"></span></td>
                                        <td>round($result_C22)</td>
                                        <td>round($result_D22)</td>
                                        <td>0.7 มีหน้าเพิ่ม</td>
                                        <td>PASS</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- / ตาราง -->
                              <div class="m-3 mb-0 black-text">
                                <h4 style="display: inline; font-weight: bold; font-size: 1.1rem;">Maximum Permissible Error (MPE) :</h4>
                                <span style="text-decoration: none; font-weight: normal; font-size: 1.1rem;">&nbsp;&nbsp;±8 (mmHg)</span>
                              </div>
                              <div class="m-3 mb-0 black-text">
                                <h4 style="display: inline; font-weight: bold; font-size: 1.1rem;">Procedure of Test :</h4>
                                <span style="text-decoration: none; font-weight: normal; font-size: 1.1rem;">&nbsp;&nbsp;Test were conducted using in-house test procedure AT-03.</span>
                              </div>
                              <div class="m-3 mb-0 black-text">
                                <h4 style="font-weight: bold; font-size: 1.1rem;">Uncertainty of Measurement</h4>
                                <span style="text-decoration: none; font-weight: normal; font-size: 1.1rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The reported uncertainty is base on a standard uncertainty mutiplied by a converage factor k=2, providing a level of confidence of approximately 95%</span>
                              </div>

                              <div class="row gy-3 black-text" style="text-align: right; vertical-align: middle; padding-top: 1rem; padding-right: 1rem; margin: 0 auto;">
                                <h5 style="line-height: 1.7;">Cert. No. : 23ATP10195<br><strong>Page</strong> 2 of 2</h5>
                              </div>

                              <div class="m-3 mb-4 black-text">
                                <h4 style="font-weight: bold; font-size: 1.1rem;">Test Standard Used</h4>
                              </div>
                              <!-- ตาราง -->
                              <div class="card mb-4 mx-3 black-text">
                                <table class="table table-bordered" style="text-align: center; border: 1px solid black; border-collapse: collapse;">
                                  <tbody>
                                    <tr>
                                      <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Manufacture</td> 
                                      <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Model</td>
                                      <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">S/N</td>
                                      <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Cal. Date</td>
                                      <td style="vertical-align: top; font-size: 0.9rem; font-weight: bold;">Cert. No.</td>
                                    </tr>
                                    <tr>
                                      <td>BC Biomedical</td>
                                      <td>NIBP-1030</td>
                                      <td>735AE1524Q</td>
                                      <td>17 February 2023</td>
                                      <td>MP23-1204</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- / ตาราง -->
                              <div class="m-3 mb-4 black-text">
                                <h4 style="font-size: 1rem;">
                                1. This result of test was found accurate as shown on date and place of test only.<br>
                                2. This result of test was made on requested at the point specified by customer.<br>
                                3. This test is traceabla to the International System of Units, through :- <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- National Institute of Metrology (Thailand).<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- National Institute of Metrology (Thailand), through Technology Promotion Association (Thailand-Japan).<br>
                                4. This certification were carried out using equipment whose measured values are traceable to National Standards, where<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;these exist.
                                </h4>
                              </div>
                              <!-- สรุปผล -->
                              <div class="row m-3 black-text">
                                <div class="row mb-3">
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">Test by :  ( ✓ ) <!-- แสดง form2_signCopy --><h4>completed!</h4> </span></label>
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approved by : </label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="">
                                  </div>
                                </div>
                                <label class="col-sm-12" for="basic-default-name" style="font-size: 1.05rem; padding-left: 42rem;">Mr.Kiartikhun Intha</label>
                              </div>
                              <!-- / สรุปผล -->
                              <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                              </div>
                            </form>
                            <div class="row">                              
                              <div class="d-flex justify-content-center mx-auto gap-3 pt-4">
                                <button class="btn btn-dark js-btn-prev" type="button" title="Prev">Prev</button>
                                <button class="btn btn-success ml-auto" type="button" title="Send">Send</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- / เปลี่ยนรายการ -->
          </div>
          <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , developed with
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Phongsky R. Guy</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- script_raw -->
    <script src="system_crud/script_raw.js"></script> <!-- เรียกใช้ไฟล์ script.js จากระบบเก่า -->

    <!-- progress step bar -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const stepsBtns = document.querySelectorAll('.my-form-multisteps-form__progress-btn');
        const stepsBar = document.querySelector('.my-form-multisteps-form__progress');
        const stepsForm = document.querySelector('.my-form-multisteps-form__form');
        const stepFormPanels = document.querySelectorAll('.my-form-multisteps-form__panel');
        const stepPrevBtnClass = 'js-btn-prev';
        const stepNextBtnClass = 'js-btn-next';

        /* ฟังก์ชั่นสำหรับลบคลาส */
        const removeClasses = (elemSet, className) => {
          elemSet.forEach(elem => {
            elem.classList.remove(className);
          });
        };

        /* ฟังก์ชั่นสำหรับหา parent element */
        const findParent = (elem, parentClass) => {
          let currentNode = elem;
          while (!currentNode.classList.contains(parentClass)) {
            currentNode = currentNode.parentNode;
          }
          return currentNode;
        };

        /* ฟังก์ชั่นสำหรับหา step ที่กำลังใช้งาน */
        const getActiveStep = elem => Array.from(stepsBtns).indexOf(elem);

        /* ฟังก์ชั่นสำหรับตั้งค่า step ที่กำลังใช้งาน */
        const setActiveStep = activeStepNum => {
          removeClasses(stepsBtns, 'js-active');
          stepsBtns.forEach((elem, index) => {
            if (index <= activeStepNum) {
              elem.classList.add('js-active');
            }
          });
        };

        /* ฟังก์ชั่นสำหรับหา panel ที่กำลังใช้งาน */
        const getActivePanel = () => {
          let activePanel;
          stepFormPanels.forEach(elem => {
            if (elem.classList.contains('js-active')) {
              activePanel = elem;
            }
          });
          return activePanel;
        };

        /* ฟังก์ชั่นสำหรับตั้งค่า panel ที่กำลังใช้งาน */
        const setActivePanel = activePanelNum => {
          removeClasses(stepFormPanels, 'js-active');
          stepFormPanels.forEach((elem, index) => {
            if (index === activePanelNum) {
              elem.classList.add('js-active');
              setFormHeight(elem);
            }
          });
        };

        /* ฟังก์ชั่นสำหรับตั้งค่าความสูงของฟอร์ม */
        const formHeight = activePanel => {
          const activePanelHeight = activePanel.offsetHeight;
          stepsForm.style.height = `${activePanelHeight}px`;
        };

        const setFormHeight = () => {
          const activePanel = getActivePanel();
          formHeight(activePanel);
        };

        stepsBar.addEventListener('click', e => {
          const eventTarget = e.target;
          if (!eventTarget.classList.contains('my-form-multisteps-form__progress-btn')) {
            return;
          }
          const activeStep = getActiveStep(eventTarget);
          setActiveStep(activeStep);
          setActivePanel(activeStep);
        });

        stepsForm.addEventListener('click', e => {
          const eventTarget = e.target;
          if (!((eventTarget.classList.contains(stepPrevBtnClass)) || (eventTarget.classList.contains(stepNextBtnClass)))) {
            return;
          }
          const activePanel = findParent(eventTarget, 'my-form-multisteps-form__panel');
          let activePanelNum = Array.from(stepFormPanels).indexOf(activePanel);
          if (eventTarget.classList.contains(stepPrevBtnClass)) {
            activePanelNum--;
          } else {
            activePanelNum++;
          }
          setActiveStep(activePanelNum);
          setActivePanel(activePanelNum);
        });

        window.addEventListener('load', setFormHeight, false);
        window.addEventListener('resize', setFormHeight, false);
      });
    </script>
    
    <!-- ตารางวันที่ -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap DatePicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- DatePicker configuration -->
    <script>
        $(document).ready(function(){
            $('.date-input').datepicker({
                format: "dd MM yyyy", // รูปแบบวันที่ที่ต้องการ
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
  </body>
</html>