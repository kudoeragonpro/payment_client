<?php
require_once __DIR__ . '/../config/payment.php';

$sql = "SELECT id, username, password, balance FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>