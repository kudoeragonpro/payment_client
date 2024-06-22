<?php
require_once __DIR__ . '/../config/payment.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, balance FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            
            $sqlbank = "SELECT COUNT(*) as count FROM banks_for_users WHERE user_id = ?";
            $stmt = $conn->prepare($sqlbank);
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("s", $user['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $bank = $result->fetch_assoc();

            if ($bank['count'] == 0) {
                echo '3'; 
            } else {
                echo '1'; 
            }
        } else {
            
            echo '0';
        }
    } else {
        
        echo '0';
    }
} else {
    echo '404'; // Phương thức không phải POST
}
?>