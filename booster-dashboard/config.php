<?php
// ini_set('display_errors', 1); 
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/config.php');

$isBooster = false;

if (!empty(htmlspecialchars($_COOKIE["neraboost_board"]))) {
    // exit(htmlspecialchars($_COOKIE["neraboost_board"]));
    $boosterCookieSession = htmlspecialchars($_COOKIE["neraboost_board"]);
    $boosterSession = $sql->getAll("SELECT * FROM `booster_accounts` WHERE `session` = '$boosterCookieSession'");
    
    if($boosterSession[0]['id'] > 0) {
        // echo $boosterSession[0]['id']; exit;
        $isBooster = true;

        $boosterId = $boosterSession[0]['id'];
        $boosterEmail = $boosterSession[0]['email'];
        $boosterUsername = $boosterSession[0]['username'];
        $boosterBalance = $boosterSession[0]['balance'];
    }else{
        require_once($_SERVER['DOCUMENT_ROOT'] . '/booster-dashboard/login.php');
        exit;
        // setcookie("neraboost_board", "", time() - 1, "/");
    }
}else{
    require_once($_SERVER['DOCUMENT_ROOT'] . '/booster-dashboard/login.php');
    // header("Location: /booster-dashboard?login");
    exit;
}