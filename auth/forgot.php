<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

if (count($_POST) != 0) {
    $login = $_POST['email'];
    // $pass  = md5($_POST['pass']);

    if ($login == '') {
        $result = array("result" => "error", "message" => "Enter email");
        echo json_encode($result);
        die();
    }
    // $save  = $_POST['save'];

    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    if (!preg_match($pattern, $login)) {
        $result = array("result" => "error", "message" => "Invalid email");
        echo json_encode($result);
        die();
    }

    $getUser = $sql->getAll("SELECT * FROM `accounts` WHERE `email` = ?s", $login);

    if (count($getUser) == 1) {
        $mail = $getUser[0]['email'];

        $sql->query("DELETE FROM `accounts_confirm` WHERE `type` = 'reset' AND `email` = ?s", $mail);

        $secret_confirm = md5($secret . ':' . $mail . ':' . time());
        $insert = array(
            "type"      => 'reset',
            "code"      => $secret_confirm,
            "email"     => $mail
        );
        $sql->query("INSERT INTO `accounts_confirm` SET ?u", $insert);

        // $to = $mail;
        // $link = $server_name . '/auth/confirm.php?secret=' . $secret_confirm;

        $link = $server_name . '/auth/confirm.php?secret=' . $secret_confirm;

        // $subject = "Recover Password";
        $mailto = $mail;

        require $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/resetPassword.php'; // Email Send

        $result = array("result" => "email_send", "message" => $mail);
        echo json_encode($result);
        die();
    } else {
        $result = array("result" => "error", "message" => "Wrong email");
        echo json_encode($result);
    }
}
