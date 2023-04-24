<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

$secret = $_GET['secret'];
// $date  = date("Y/m/d H:i");
$date  = time();
$ip    = $_SERVER['REMOTE_ADDR'];

$getConfirm = $sql->getRow("SELECT * FROM `accounts_confirm` WHERE `code` = ?s", $secret);

if ($getConfirm['type'] == 'registration') { // Подтверждение регистрации

    // $hash = md5($getConfirm['username'] . ":" . $getConfirm['email'] . ":" . $getConfirm['password'] . ":" . $sercret);
    $hash = md5($getConfirm['email'] . ":" . $secret);

    $json_information = [
        'ip' => $ip,
        'date_registration' => $date,
    ];

    $insert = array(
        "username"  => '',
        "email"     => $getConfirm['email'],
        "password"  => 'unset',
        "username"  => stristr($getConfirm['email'], '@', true),
        "session"   => $hash,
        "info"      => serialize($json_information),
    );

    // $hash = md5($login . ":" . $mail . ":" . md5($pass) . ":" . $sercret);

    $sql->query("INSERT INTO `accounts` SET ?u", $insert);
    // $id = $sql->insertId();

    // $_SESSION['uid']  = $id;
    // $_SESSION['user'] = $getConfirm['username'];

    $sql->query("DELETE FROM `accounts_confirm` WHERE `code` = ?s", $secret);

    setcookie("nerahash", $hash, time() + 3600 * 24 * 31, "/");

    header('Location: ' . $server_name . '/profile');
    die();
} else if ($getConfirm['type'] == 'reset') {
    $mail = $getConfirm['email'];

    $sql->query("UPDATE `accounts` SET `password` = 'unset' WHERE `email` = ?s", $mail);
    $getUser = $sql->getRow("SELECT * FROM `accounts` WHERE `email` = ?s", $mail);

    $hash = md5($getUser['username'] . ":" . $getUser['email'] . ":" . $getUser['password'] . ":" . $sercret . ":" . time());
    setcookie("nerahash", $hash, time() + 3600 * 24 * 31, "/");

    $sql->query("UPDATE `accounts` SET `session` = ?s WHERE `email` = ?s", $hash, $mail);

    // $_SESSION['uid']  = $getUser['id'];
    // $_SESSION['user'] = $getUser['username'];

    $sql->query("DELETE FROM `accounts_confirm` WHERE `code` = ?s", $secret);

    header('Location: ' . $server_name . '/profile');
    die();
}

header('Location: ' . $server_name . '');
die();
