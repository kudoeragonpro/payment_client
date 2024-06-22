<?php
require_once __DIR__ . '/../config/payment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bankName = $_POST['bankName'];
    $accNumber = $_POST['accNumber'];
    $accName = $_POST['accName'];
    $branchName = $_POST['branchName'];
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO banks_for_users (numberCard, bankName, nameUser, branchName, user_id, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $accNumber, $bankName, $accName, $branchName, $user_id);
            if ($stmt->execute()) {
                header("Location: ../index.php");
            } else {
                $registerError = "Đăng ký không thành công. Vui lòng thử lại sau.".$stmt->error;
            }
} else {
    echo '404';
}
$conn->close();
?>