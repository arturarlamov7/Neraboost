<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');

$boosterEmail = $_POST['email'];
$boosterPassword = $_POST['password'];

function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


if(isset($boosterEmail)){
    if(!isValidEmail($boosterEmail)){
        // echo 'Invalid email';
        header("Location: /booster-dashboard/?error=true");
        exit;
    }

    $getBooster = $sql->getAll("SELECT * FROM `booster_accounts` WHERE `email` = ?s AND `password` = ?s", $boosterEmail, md5($boosterPassword));

    if(!empty($getBooster)){
        
        
        $hash = md5(time().'-'.$getBooster[0]['email'].'-'.$getBooster[0]['password']);
        // exit($hash);
        setcookie("neraboost_board", $hash, time() + 3600 * 24 * 31, "/");
        
        $sql->query("UPDATE `booster_accounts` SET `session` = ?s WHERE `id` = ?s", $hash, $getBooster[0]['id']);
        
        header("Location: /booster-dashboard");
        // echo 'Login successful';
        exit;
    }else{
        header("Location: /booster-dashboard/?error=true");
        // echo 'Login failed';
        exit;
    }
}

echo json_encode(array('error' => 'null'));
// echo 'null';