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

          $datafrom1 = json_encode([   
              'sign' => $form1_sign,         
              'input1' => $form1_input1,
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

          $datafrom2 = json_encode([
              'sign' => $form2_sign,  
              'input1' => $form2_input1,
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

          $datafrom3 = json_encode([
              'sign' => $form3_sign,  
              'input1' => $form3_input1,
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

// form 2
$form2_sign = $datafrom2['sign'] ?? '';
$form2_input1 = $datafrom2['input1'] ?? '';

// form 3
$form3_sign = $datafrom3['sign'] ?? '';
$form3_input1 = $datafrom3['input1'] ?? '';

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

    <!-- เพิ่ม -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function submitFormOnImageClick(imageId, formId) {
                const imageElement = document.getElementById(imageId);
                const formElement = document.getElementById(formId);

                imageElement.addEventListener('click', function() {
                    const formData = new FormData(formElement);

                    fetch(formElement.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response data
                        console.log(data);
                        // Update the DOM as needed with the data from the response
                    })
                    .catch(error => console.error('Error:', error));
                });
            }

            submitFormOnImageClick('image1', 'form1');
        });
    </script>
  </head>

  <body onload="calculateSum()">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hospital information / Medical equipment /</span> Form </h4>

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
                                <div class="row mb-3">
                                  <label class="col-sm-4" for="basic-default-name" style="font-size: 1.05rem;">Date:</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control date-input" name="form1_input1" value="<?php echo htmlspecialchars($form1_input1); ?>" placeholder="">
                                  </div>
                                </div>
                              </div>                    
                              <!-- / PM form -->
                              <!-- สรุปผล -->
                              <div class="row m-3 black-text">
                                <div class="row mb-3">
                                  <label class="col-sm-2" for="basic-default-name" style="font-size: 1.05rem;">บำรุงรักษาโดย:</label>
                                  <div class="col-sm-3" style="display: flex;">                                  
                                    <div id="signatureHide1" class="signatureHide">
                                      <!-- แสดง form1_sign --><?php echo htmlspecialchars($form1_sign); ?>
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- / เปลี่ยนรายการ -->
          </div>
          <!-- / Content -->
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