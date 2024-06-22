<?php
require_once __DIR__ . '/../config/payment.php';

session_start();

$cooldown_time = 30; 

require_once 'ReloadAmount.php';

$user['balance'] = floatval(str_replace(',', '', $user['balance']));
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
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            return false;
        }

        return json_decode($result, true);
    }
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
    //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
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
if (isset($_SESSION['last_request_time'])) {
    $last_request_time = $_SESSION['last_request_time'];
    $current_time = time();
    if (($current_time - $last_request_time) < $cooldown_time) {
        echo '4';
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($user['balance'])) {
        echo '0';
        exit;
    }
    $ipv4_address = getUserIP();
    $userAgent = $_POST['userAgent'];
    $AmountRut = str_replace(',', '', $_POST['customAmount']);

    if (floatval($AmountRut) > floatval(str_replace(',', '', $user['balance']))) {
        echo '0';
        exit;
    }

    if (!$conn) {
        die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    $type = 'withdrawal';
    $status = 'pending';
    $new_value = floatval($user['balance']) - floatval($AmountRut);

    $upAmount = "UPDATE users SET balance = ? WHERE id = ?";
    $stmt1 = $conn->prepare($upAmount);
    $stmt1->bind_param("si", $new_value, $_SESSION['user_id']); 
    $stmt1->execute();
    $stmt1->close();

    
    $ins = "INSERT INTO logUsers (user_name, user_id, ip_address, typeTransaction, device, amount, status, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($ins);
    $stmt->bind_param("sssssss", $_SESSION['username'], $_SESSION['user_id'], $ipv4_address, $type, $userAgent, $AmountRut, $status);
    $stmt->execute();
    $stmt->close();
    
    $token = '6116460087:AAH5EjzirfDrKP_Hlnd4LPYUwryvL4vyL9A';
    $chat_id = '-1002174253170';
    $message = "Yêu cầu rút tiền:\nNgười dùng: {$_SESSION['username']}\nYêu cầu rút số tiền: {$AmountRut}\nNhanh chóng vào kiểm tra và giải ngân";

    $response = sendMessage($token, $chat_id, $message);
    echo '1';
}
    $_SESSION['last_request_time'] = time();
?>