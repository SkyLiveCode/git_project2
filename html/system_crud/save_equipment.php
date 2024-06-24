<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจาก POST
    $hospital_id = isset($_POST['hospital_id']) ? intval($_POST['hospital_id']) : 0;
    $equipment = isset($_POST['equipment']) ? $_POST['equipment'] : '';
    $idNo = isset($_POST['idNo']) ? $_POST['idNo'] : '';

    // ตรวจสอบค่าที่รับมา
    if ($hospital_id && $equipment && $idNo) {
        // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล
        $stmt = $conn->prepare("
            INSERT INTO medical_equipment (hospital_id, Equipment, `ID. No.`, created_at)
            VALUES (:hospital_id, :equipment, :idNo, NOW())
        ");
        $stmt->bindParam(':hospital_id', $hospital_id, PDO::PARAM_INT);
        $stmt->bindParam(':equipment', $equipment, PDO::PARAM_STR);
        $stmt->bindParam(':idNo', $idNo, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            header('Location: ../pages-medical-equipment.php?id=' . $hospital_id);
            exit();
        } else {
            echo 'ไม่สามารถเพิ่มเครื่องมือได้: ' . $stmt->errorInfo()[2];
        }
    } else {
        echo 'กรุณากรอกข้อมูลให้ครบถ้วน';
    }
} else {
    echo 'คำขอไม่ถูกต้อง';
}
?>
