<?php
require('connect.php');

$id = $_GET['id']; // รับ id จาก query string

try {
    // Prepare the SQL DELETE statement
    $stmt = $conn->prepare("DELETE FROM `hospital` WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        $response = [
            'status' => 'success',
            'message' => 'Record deleted successfully',
            'id' => $id
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error deleting record'
        ];
    }
} catch (PDOException $e) {
    $response = [
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ];
}

// Send the response back as JSON
echo json_encode($response);
?>
