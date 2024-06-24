<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: auth-login-basic.php');
    exit();
}

require_once 'system_crud/connect.php';

// Get the id from the URL parameter
$hospital_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the hospital name using the hospital_id
$hospitalStmt = $conn->prepare("SELECT h_name FROM hospital WHERE id = :hospital_id");
$hospitalStmt->bindParam(':hospital_id', $hospital_id, PDO::PARAM_INT);
$hospitalStmt->execute();
$hospital = $hospitalStmt->fetch(PDO::FETCH_ASSOC);
$hospital_name = $hospital ? $hospital['h_name'] : 'Unknown Hospital';

// ดึงข้อมูลจากฐานข้อมูล
$sql = $conn->prepare("
    SELECT me.*, c.id AS idcategories
    FROM medical_equipment me
    INNER JOIN categories c ON me.Equipment COLLATE utf8mb4_unicode_ci = c.name COLLATE utf8mb4_unicode_ci
    WHERE me.hospital_id = :hospital_id
    ORDER BY me.created_at DESC
");
$sql->bindParam(':hospital_id', $hospital_id, PDO::PARAM_INT);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลจากตาราง categories
$categoriesStmt = $conn->prepare("SELECT id, name, sname FROM categories");
$categoriesStmt->execute();
$categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลจากตาราง users โดยใช้ user_id จาก session
$user_id = $_SESSION['user_id'];
$user = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$user->execute();
$users = $user->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>AT PREVENT</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="..\assets\img\icons\brands\logo.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
  </head>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
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
            <li class="menu-item">
              <a href="../index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
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
                  <a href="pages-hospita-information.php" class="menu-link">
                    <div data-i18n="Account">Hospital information</div>
                  </a>
                </li>
                <li class="menu-item active">
                  <a href="pages-medical-equipment.php" class="menu-link">
                    <div data-i18n="Notifications">Medical equipment</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a href="https://www.facebook.com/profile.php?id=100029998816317" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
          </ul>
        </aside>
        <div class="layout-page">
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                </div>
              </div>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item lh-1 me-3">
                  <a><?php echo $users['accounts']; ?> Account</a>
                </li>
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
              </ul>
            </div>
          </nav>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hospital information /</span> Medical equipment </h4>
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="pages-hospita-information.php"><i class="bx bx-buildings"></i> Hospital information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bxs-vial" style="position: relative; top: -1px;"></i> Medical equipment</a>
                    </li>
                  </ul>
                  
                  <!-- เพิ่มเครื่องมือ -->
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
                        <h5 class="m-2">เพิ่มข้อมูลเครื่องมือ<?php echo htmlspecialchars($hospital_name); ?></h5>
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
                          <form action="system_crud/save_equipment.php" method="post">
                            <input type="hidden" name="hospital_id" value="<?php echo $hospital_id; ?>">
                            <div class="row gx-3 gy-2 align-items-center">
                              <div class="col-md-4">
                                <label class="form-label" for="selectTypeOpt">EQUIPMENT</label>
                                <select id="selectTypeOpt" class="form-select color-dropdown" name="equipment" required>
                                  <option value="" disabled selected>กรุณาเลือกรายการ</option>
                                  <?php foreach ($categories as $category): ?>
                                      <option value="<?php echo $category['name']; ?>"><?php echo $category['id'] . ". " . $category['name'] . " (" . $category['sname'] . ")"; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="col-md-4">
                                <label class="form-label" for="basic-default-fullname">ID. NO.</label>
                                <input type="text" class="form-control" id="basic-default-fullname" name="idNo" placeholder="ID" required>
                              </div>
                              <div class="col-md-3">
                                <label class="form-label" for="showToastPlacement">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">เพิ่มเครื่องมือ</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- / เพิ่มเครื่องมือ -->
                  
                  <div class="row">
                    <div class="col-12 mb-4">
                      <div class="card">
                        <h5 class="card-header">รายการข้อมูลเครื่องมือ<?php echo htmlspecialchars($hospital_name); ?></h5>
                        <div class="table-responsive text-nowrap">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Department</th>
                                <th>Equipment</th>
                                <th>ID. No.</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                              <?php if (count($result) > 0) : ?>
                              <?php foreach ($result as $row) : ?>
                              <tr id="row-<?php echo $row['id']; ?>">
                                <td class="fab fa-angular fa-lg me-3"><strong><?php echo $row['id']; ?></strong></td>
                                <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
                                <td><?php echo $hospital_name; ?></td>
                                <td><?php echo $row['Equipment']; ?></td>
                                <td><?php echo $row['ID. No.']; ?></td>
                                <td>
                                  <div class="d-flex align-items-center gap-2">
                                    <!-- <span class="badge bg-label-success me-1">Completed</span> -->
                                    <span class="badge bg-label-warning me-1">Pending</span>
                                    <!-- <button onclick="generatePDF(<?php echo $row['id']; ?>)" class="btn btn-primary">Report</button> -->
                                  </div>
                                </td>
                                <td><a class="badge rounded-pill bg-primary" href="pages-form_php/pages-form_<?php echo $row['idcategories']; ?>.php?id=<?php echo $row['id']; ?>&hospital_id=<?php echo $hospital_id; ?>">&nbsp; Info &nbsp;</a></td>
                                <td>
                                  <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <!-- <a class="dropdown-item" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="deleteRecord(<?php echo $row['id']; ?>)"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <tr>
                                <td colspan="7" class="text-center">No data found</td>
                              </tr>
                              <?php endif; ?>                                               
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>                                 
                </div>
              </div>
            </div>
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
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
    function deleteRecord(id) {
      if (confirm('Are you sure you want to delete this record?')) {
        fetch('system_crud/delete_equipment.php?id=' + id, { method: 'GET' })
          .then(response => response.text())
          .then(data => {
            let row = document.getElementById('row-' + id);
            if (row) {
              row.remove();
              alert('Record deleted successfully');
            } else {
              alert('Could not find the row to delete.');
            }
          })
          .catch(error => alert('Error deleting record: ' + error));
      }
    }

    function generatePDF(id) { //ต้องแก้ id ให้ถูกต้อง เนื่องจากเปลี่ยนแปลง code โครงสร้าง
      window.open('system_crud/generate_pdf.php?id=' + id, '_blank');
    }
    </script> 
  </body>
</html>
