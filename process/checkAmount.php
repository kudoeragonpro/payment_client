<?php
session_start(); 
include_once 'ReloadAmount.php';
if(floatval(str_replace(',', '', $user['balance']))>=500000.00){
    echo '1';
}else{
    echo '0';
}
?>