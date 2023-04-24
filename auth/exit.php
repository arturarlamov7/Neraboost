<?php
require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

unset($_SESSION['uid']);
unset($_SESSION['user']);

setcookie("nerahash", "", time() - 1, "/");

header("Location: /");
