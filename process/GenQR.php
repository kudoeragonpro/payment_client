<?php
require_once __DIR__ . '/../config/payment.php';

session_start(); 
function check_string($data)
    {
        return trim(htmlspecialchars(addslashes($data)));
    }
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    if(isset(explode(',', $ip_address)[1])){
        return explode(',', $ip_address)[0];
    }
    return check_string($ip_address);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userId = $_SESSION['user_id'];
    $userAgent = $_POST['userAgent'];

    
    $Amount = $_POST['customAmount'];

    
    $sql = "SELECT id, user_id, name, shortName, bank_account_name, bank_account_number, bank_account_branch FROM bank_admins WHERE bank_status = 'active' ORDER BY RAND() LIMIT 1;";
    $stmt = $conn->prepare($sql);

    
    if ($stmt === false) {
        die('Error: ' . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $bank = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        function sendMessage($token, $chat_id, $message) {
            $url = "https://api.telegram.org/bot$token/sendMessage";
        
            $data = [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'HTML'
            ];
        
            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
                ],
            ];
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) {
                return false;
            }
        
            return json_decode($result, true);
        }
        
        
        $token = '6116460087:AAH5EjzirfDrKP_Hlnd4LPYUwryvL4vyL9A';
        $chat_id = '-1002174253170';
        $message = "Yêu cầu nạp tiền:\nNgười dùng: {$_SESSION['username']}\nYêu cầu nạp số tiền: {$Amount}\nNhanh chóng vào kiểm tra và xác nhận";
        
        $response = sendMessage($token, $chat_id, $message);
        
        $type = 'toup';
        $status = 'pending';
        
        $_SESSION['bank_id'] = $bank['id'];
        $_SESSION['name'] = $bank['name'];
        $_SESSION['shortName'] = $bank['shortName'];
        $_SESSION['bank_account_name'] = $bank['bank_account_name'];
        $_SESSION['bank_account_number'] = $bank['bank_account_number'];
        $_SESSION['bank_account_branch'] = $bank['bank_account_branch'];
        $_SESSION['Amount'] = $Amount;
        $ipv4_address = getUserIP();
        $amount = str_replace(',', '', $Amount);
        $ins = "INSERT INTO logUsers (user_name, user_id, ip_address, typeTransaction, device, amount, status, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($ins);
        $stmt->bind_param("sssssss", $_SESSION['username'], $_SESSION['user_id'], $ipv4_address, $type,  $userAgent, $amount, $status);
        if($stmt->execute()){
        echo 1;
    }else{
        echo ''. $stmt->error;
    }
    } else {
        echo 0;
    }

    $conn->close(); 
} else {
    echo '404';
}
?>