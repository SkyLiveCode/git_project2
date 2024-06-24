<?php
session_start();
session_unset();
session_destroy();

// ลบคุกกี้ remember me ถ้ามี
if (isset($_COOKIE['remember_me'])) {
    unset($_COOKIE['remember_me']);
    setcookie('remember_me', '', time() - 3600, '/'); // หมดอายุคุกกี้
}

header('Location: auth-login-basic.php');
exit();
?>
