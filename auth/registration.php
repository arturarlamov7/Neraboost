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

// echo 'OK';
// die();

// if (!$_POST["g-recaptcha-response"]) {
//     $result = array("result" => "captcha", "message" => "Please complete the captcha to continue");
//     echo json_encode($result);
//     die();
// } else {
//     $url = "https://www.google.com/recaptcha/api/siteverify";

//     $key = ""; // Ключ для сервера

//     $query = array(
//         "secret" => $key,
//         "response" => $_POST["g-recaptcha-response"],
//         "remoteip" => $_SERVER['REMOTE_ADDR'] 
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
//     $data = json_decode(curl_exec($ch), $assoc = true);
//     curl_close($ch);

//     if (!$data['success']) {
//         $result = array("result" => "error", "message" => "Invalid captcha result. try it again");
//         echo json_encode($result);
//         die();
//     }
// }

require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

$mail  = $_REQUEST['mail'];
$date  = date("Y/m/d H:i");
$ip    = $_SERVER['REMOTE_ADDR'];

if (count($_REQUEST) != 0) {

    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if (!preg_match($pattern, $mail)) {
        $result = array("result" => "error", "message" => "Something is wrong with the email. Check out the format!");
        echo json_encode($result);
        die();
    }

    $check = $sql->getAll("SELECT * FROM `accounts` WHERE `email` = ?s", $mail);
    if (count($check) != 0) {
        $result = array("result" => "error", "message" => "The entered mail is already taken by someone");
        echo json_encode($result);
        die();
    }

    $sql->query("DELETE FROM `accounts_confirm` WHERE `type` = 'registration' AND `email` = ?s", $mail);

    $sercret_confirm = md5($sercret . ':' . $mail . ':' . time());
    $insert = array(
        "type"      => 'registration',
        "code"      => $sercret_confirm,
        // "username"  => $login,
        "email"     => $mail,
        // "password"  => md5($pass)
    );
    $sql->query("INSERT INTO `accounts_confirm` SET ?u", $insert);

    // $to = $mail;
    $link = $server_name . '/auth/confirm.php?secret=' . $sercret_confirm;

    $subject = "Complete registration at";
    $mailto = $mail;

    require $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/verifyEmail.php'; // Email Send

    // mail($to, $subject, $message, $headers);

    $result = array("result" => "email_send", "message" => $mail);
    echo json_encode($result);
    die();
} else {
    $result = array("result" => "empty", "message" => "System error: no data received");

    echo json_encode($result);
    die();
}
