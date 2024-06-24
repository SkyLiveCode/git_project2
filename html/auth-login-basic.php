<?php
session_start();
require_once 'system_crud/connect.php';

// ฟังก์ชันสำหรับสร้างคุกกี้ remember me
function rememberUser($userId) {
    $token = bin2hex(random_bytes(16));
    setcookie('remember_me', $token, time() + (86400 * 7), "/"); // คุกกี้มีอายุ 7 วัน
    // เก็บ token ในฐานข้อมูล
    global $conn;
    $stmt = $conn->prepare("INSERT INTO remember_me_tokens (user_id, token) VALUES (:user_id, :token) ON DUPLICATE KEY UPDATE token = :token");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
}

// ฟังก์ชันสำหรับตรวจสอบคุกกี้ remember me
function checkRememberMe() {
    if (isset($_COOKIE['remember_me'])) {
        global $conn;
        $stmt = $conn->prepare("SELECT user_id FROM remember_me_tokens WHERE token = :token");
        $stmt->bindParam(':token', $_COOKIE['remember_me']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['user_id'];
            header('Location: ../index.php');
            exit();
        }
    }
}

// เรียกใช้ฟังก์ชัน checkRememberMe() เมื่อผู้ใช้เข้ามาในระบบ
checkRememberMe();

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember-me']);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password, verify FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user['verify'] == 1 && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                if ($rememberMe) {
                    rememberUser($user['id']);
                }
                header('Location: ../index.php');
                exit();
            } else {
                $error_message = "Invalid credentials or account not verified.";
            }
        } else {
            $error_message = "Invalid credentials.";
        }
    } else {
        $error_message = "Please fill in both fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />

    <!-- logo -->
    <link rel="icon" type="image/x-icon" href="../assets/img/icons/brands/logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <script src="../assets/js/config.js"></script>
</head>
<body>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="../index.php" class="app-brand-link">
                  <span class="app-brand-logo demo">
                    <img src="../assets/img/icons/brands/logo.png" width="45" height="45" alt="Brand Logo">
                  </span>
                  <span class="app-brand-text demo menu-text fw-bolder ms-2">AT PREVENT</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Professional with Quality Service</h4>
              <p class="mb-4">Please sign-in to your account</p>

              <?php if ($error_message): ?>
              <div id="login-error" class="form-text text-danger"><?php echo $error_message; ?></div>
              <?php endif; ?>

              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.php">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div id="login-error" class="form-text text-danger" style="display: none;">Invalid credentials or account not verified.</div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.php">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
