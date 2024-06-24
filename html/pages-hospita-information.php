<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: auth-login-basic.php');
    exit();
}

require_once 'system_crud/connect.php';

// ดึงข้อมูลจากตาราง hospital
$stmt = $conn->prepare("SELECT id, h_name, province, email, phone, created_at FROM hospital ORDER BY created_at DESC");
$stmt->execute();
$hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลจากตาราง users โดยใช้ user_id จาก session
$user_id = $_SESSION['user_id'];
$user = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user->execute();
$users = $user->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
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
    <link rel="icon" type="image/x-icon" href="..\assets\img\icons\brands\logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="../index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src="..\assets\img\icons\brands\logo.png" width="45" height="45" alt="Brand Logo">
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
              <a href="../index.php" class="menu-link">
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
                <li class="menu-item active">
                  <a href="pages-hospita-information.php" class="menu-link">
                    <div data-i18n="Account">Hospital information</div>
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
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
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
                      <a class="dropdown-item" href="logout.php">
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">  </span> Hospital information</h4>

              <div class="row">
                <div class="col-md-12">
                  <!-- เปลี่ยน Form bar -->
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-buildings"></i> Hospital information</a>
                    </li>
                  </ul>
                  <!-- / เปลี่ยน Form bar -->
                  <!-- Content -->            
                  <!-- form-->
                  <div class="card mb-4 accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button
                        type="button"
                        class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#accordionOne"
                        aria-expanded="false"
                        aria-controls="accordionOne"
                      >
                        <h5 class="m-2">เพิ่มข้อมูลโรงพยาบาล</h5>
                      </button>
                    </h2>
                    <div
                      id="accordionOne"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingOne"
                      data-bs-parent="#accordionExample"
                    >
                      <div class="accordion-body">
                        <div class="m-2">
                          <form action="system_crud/save_hospital.php" method="post">
                            <div class="mb-3">
                              <label class="form-label" for="hospital-name" style="font-size: 1.05rem;">โรงพยาบาล</label>
                              <input type="text" class="form-control" id="hospital-name" name="hospital_name" placeholder="กรอกชื่อโรงพยาบาล" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="province" style="font-size: 1.05rem;">จังหวัด</label>
                              <input type="text" class="form-control" id="province" name="province" placeholder="กรอกชื่อจังหวัด" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-email" style="font-size: 0.85rem;">Email</label>
                              <div class="input-group input-group-merge">
                                <input
                                  type="text"
                                  id="basic-default-email"
                                  class="form-control"
                                  name="email"
                                  placeholder="กรอก email@example.com"
                                  aria-label="john.doe"
                                  aria-describedby="basic-default-email2"
                                />
                                <span class="input-group-text" id="basic-default-email2">@example.com</span>
                              </div>
                              <div class="form-text">หากไม่มีอีเมล กรุณาใช้เครื่องหมายขีด ( - )</div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone" style="font-size: 1.05rem;">เบอร์ติดต่อ</label>
                              <input
                                type="text"
                                id="basic-default-phone"
                                class="form-control phone-mask"
                                name="phone"
                                placeholder="0xx-xxx-xxxx"
                              />
                              <div class="form-text">หากไม่มีเบอร์ติดต่อ กรุณาใช้เครื่องหมายขีด ( - )</div>
                            </div>
                            <button type="submit" class="btn btn-primary">ยืนยันการส่ง</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / form-->
                  <!-- Hoverable Table rows -->
                  <div class="card mb-4">
                    <div class="card">
                      <h5 class="card-header">รายการข้อมูลโรงพยาบาล</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Created at</th>
                                        <th>Hospital Name</th>
                                        <th>Province</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php foreach ($hospitals as $hospital): ?>
                                        <tr id="row-<?php echo $hospital['id']; ?>">
                                            <td><?php echo htmlspecialchars($hospital['created_at']); ?></td>
                                            <td><?php echo htmlspecialchars($hospital['h_name']); ?></td>
                                            <td><?php echo htmlspecialchars($hospital['province']); ?></td>
                                            <td><?php echo empty($hospital['email']) ? 'empty' : htmlspecialchars($hospital['email']); ?></td>
                                            <td><?php echo empty($hospital['phone']) ? 'empty' : htmlspecialchars($hospital['phone']); ?></td>
                                            <td><a class="badge rounded-pill bg-primary" href="pages-medical-equipment.php?id=<?php echo $hospital['id']; ?>">&nbsp; Info &nbsp;</a></td>                                            
                                            <td>
                                              <div class="dropdown">
                                                <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                  <!-- <a class="dropdown-item" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                                                  <a class="dropdown-item" href="javascript:void(0);" onclick="deleteRecord(<?php echo $hospital['id']; ?>)"><i class="bx bx-trash me-1"></i> Delete</a>
                                                </div>
                                              </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  <!--/ Hoverable Table rows -->            
                  <!-- / Content -->
                </div>
              </div>
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
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- เรียกใช้ไฟล์ delete.php generate_pdf.php -->
    <script>
    function deleteRecord(id) {
      if (confirm('Are you sure you want to delete this record?')) {
        // Send an AJAX request to delete.php
        fetch('system_crud/delete_hospital.php?id=' + id, {
            method: 'GET'
          })
          .then(response => response.json()) // Expecting a JSON response
          .then(data => {
            if (data.status === 'success') {
              // Remove the row from the table without reloading the page
              let row = document.getElementById('row-' + id);
              if (row) {
                row.remove();
                alert(data.message); // Show success message
              } else {
                alert('Could not find the row to delete.');
              }
            } else {
              alert(data.message); // Show error message
            }
          })
          .catch(error => alert('Error deleting record: ' + error));
      }
    }

    function generatePDF(iddata_web) {
      window.open('system_crud/generate_pdf.php?iddata_web=' + iddata_web, '_blank');
    }
    </script> 
  </body>
</html>
