<?php
require_once __DIR__ . '/../config/payment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $username = $_POST['username'];
    $sdt = $_POST['sdt'];
    $password = $_POST['password-regis'];
    $repassword = $_POST['re-password'];
    $referral_code = $_POST['referral_code'];

    if ($password !== $repassword) {
        $registerError = "Mật khẩu nhập lại không khớp.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $num_results = $result->num_rows;
        if ($num_results > 0) {    
            echo '0';
        } else {  
            $sql = "INSERT INTO users (username, phone, password, ref, createdAt, updatedAt) VALUES (?, ?, ?, ?,NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $sdt, $hashed_password, $referral_code);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = mysqli_insert_id($conn);
                echo '1';
                exit();
            } else {
                $registerError = "Đăng ký không thành công. Vui lòng thử lại sau.";
            }
        }
    }
}
$conn->close();
?>