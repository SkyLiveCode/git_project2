<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_name = $_POST['hospital_name'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO hospital (h_name, province, email, phone) VALUES (:hospital_name, :province, :email, :phone)");
    $stmt->bindValue(':hospital_name', $hospital_name);
    $stmt->bindValue(':province', $province);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);

    if ($stmt->execute()) {
        header('Location: ../pages-hospita-information.php');
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!-- ajax -->
<!--
require_once 'connect.php';

header('Content-Type: application/json');

$response = array('status' => 'error', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_name = $_POST['hospital_name'];
    $province = $_POST['province'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO hospital (h_name, province, email, phone) VALUES (:hospital_name, :province, :email, :phone)");
    $stmt->bindValue(':hospital_name', $hospital_name);
    $stmt->bindValue(':province', $province);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Hospital data saved successfully';
    } else {
        $response['message'] = $stmt->errorInfo()[2];
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
-->


