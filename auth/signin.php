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

if (count($_POST) != 0) {
    $login = $_POST['login'];
    $pass  = md5($_POST['password']);
    // $save  = $_POST['save'];
    $save  = true;

    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if (!preg_match($pattern, $login)) {
        $result = array("result" => "error", "message" => "Wrong username or password");
        echo json_encode($result);
        die();
    }

    $getUser = $sql->getAll("SELECT * FROM `accounts` WHERE `email` = ?s AND `password` = ?s", $login, $pass);

    // var_dump($getUser);

    if (count($getUser) == 1) {
        $hash = md5($getUser[0]['username'] . ":" . $getUser[0]['email'] . ":" . $getUser[0]['password'] . ":" . $secret);

        $sql->query("UPDATE `accounts` SET `session` = ?s WHERE `id` = ?i", $hash, $getUser[0]['id']);

        if ($save) {
            setcookie("nerahash", $hash, time() + 3600 * 24 * 31, "/");
        } else {
            setcookie("nerahash", $hash, time() + 3600, "/");
        }

        // $_SESSION['uid']  = $getUser[0]['id'];
        // $_SESSION['user'] = $getUser[0]['username'];

        $result = array("result" => "success", "url" => "/profile");
        echo json_encode($result);
    } else {
        $result = array("result" => "error", "message" => "Wrong email or password");
        echo json_encode($result);
    }
}
