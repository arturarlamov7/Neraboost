<?php
// require_once '../config.php';

// $limit_more = count($predictions) - $i;

$title = 'Recover Password';
$email_template = $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/reset-password.html';

$body = file_get_contents($email_template);
$body = str_replace('%link%', $link, $body);

// $body = str_replace('%predictions_html%', $predictions_html, $body);
// $body = str_replace('%date%', date('d.m.Y', $row['date']), $body);
// $body = str_replace('%list_name%', $prediction_info['name'], $body);
// $body = str_replace('%prediction_count%', count($predictions), $body);

require $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function ($str, $level) {
        $GLOBALS['status'][] = $str;
    };

    // Настройки вашей почты
    $mail->Host       = 'smtp.titan.email'; // SMTP сервера вашей почты
    $mail->Username   = 'no-reply@neraboost.com'; // Логин на почте
    $mail->Password   = 'Z0mV0Q56SJZ'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('no-reply@neraboost.com', 'Neraboost'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($mailto);

    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отравленность сообщения
    if ($mail->send()) {
        $result = "success";
    } else {
        $result = "error";
    }
} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// echo json_encode(["result" => $result, "status" => $status]);
