<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json');

$headers = apache_request_headers();
if (isset($headers['csrftoken'])) {
    if ($headers['csrftoken'] !== $_SESSION['csrf_token']) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
} else {
    exit(json_encode(['error' => 'No CSRF token.']));
}

require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
// var_dump($_POST);
if (count($_POST) != 0) {
    $pass = $_POST['password_1'];
    $rpass = $_POST['password_2'];

    $getUser = $sql->getRow("SELECT * FROM `accounts` WHERE `id` = ?s", $user_id);

    // if ($getUser['password'] != 'restore') {
    //     $cpass = md5($_POST['pass_0']);

    //     $getUserz = $sql->getAll("SELECT * FROM `users` WHERE `username` = ?s AND `password` = ?s", $login, $cpass);

    //     if (count($getUserz) == 1) {
    //         // OK
    //     } else {
    //         $result = array("result" => "error_cpass", "message" => "Wrong password");
    //         echo json_encode($result);
    //         die();
    //     }
    // }

    $errors = array();

    if (strlen($pass) < 8) {
        $errors[] = "Password must contain at least <b>8</b> characters";
    }

    if (!preg_match("#[0-9]+#", $pass)) {
        $errors[] = "Password must include at least one number";
    }

    if (!preg_match("#[a-zA-Z]+#", $pass)) {
        $errors[] = "Password must include at least one letter";
    }

    if (!preg_match("#[A-Z]+#", $pass)) {
        $errors[] = "Password must contain at least one capital letter";
    }

    if ($pass != $rpass) {
        $errors[] = "Password mismatch";
    }

    if (count($errors) > 0) {
        $result = array("result" => "error", "message" => "Password not strong enough", "errors" => $errors);
        echo json_encode($result);
        die();
    }

    $newpass = md5($pass);

    $sql->query("UPDATE `accounts` SET `password` = ?s WHERE `id` = ?s", $newpass, $user_id);

    $hash = md5($getUser['email'] . ":" . $newpass . ":" . $secret);
    setcookie("nerahash", $hash, time() + 3600 * 24 * 31, "/");

    $sql->query("UPDATE `accounts` SET `session` = ?s WHERE `id` = ?s", $hash, $user_id);

    $result = array("result" => "success", "message" => "OK");
    echo json_encode($result);
    die();
}
