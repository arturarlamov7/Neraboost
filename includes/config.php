<?php
session_start();
header("Content-type:text/html; charset=utf8");

$site = array(
    'user'    => 'u287128997_main',
    'pass'    => 'OGm0ux@7G',
    'db'      => 'u287128997_main',
    'charset' => 'utf8mb4'
);

$secret = 'CNX8NA94JB6X832'; //secret for session

define("INDEX", true);
define("ROOT", $_SERVER['DOCUMENT_ROOT']);

$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
$server_name = $protocol . '' . $_SERVER['SERVER_NAME'];

require_once(ROOT . "/includes/connector.php");

try {
    $sql  = new SafeMySQL($site);
} catch (Exception $e) {
    include(ROOT . "/includes/exception.php");
    getError($e);
}

$auth = false;
$restore_password = false;

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_COOKIE['nerahash'])) $session_cookie = $_COOKIE['nerahash'];

// echo $session_cookie;

if (isset($session_cookie)) {
    $userInfo = $sql->getRow("SELECT * FROM `accounts` WHERE `session` = '$session_cookie'");

    if ($userInfo != null) {
        $auth = true;

        $user_id = $userInfo['id'];
        $login = $userInfo['username'];
        // $balance = $userInfo['balance'];
        $user_email = $userInfo['email'];

        if ($userInfo['password'] == 'unset') {
            $unset_password = true;
        }
        // echo $userInfo['password'];
        // if ($userInfo['password'] == 'restore') {
        //     $restore_password = true;
        // }
    } else {
        setcookie("nerahash", "", time() - 1, "/");
    }
}
