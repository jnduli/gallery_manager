<?php

require "../vendor/autoload.php";

use Gallery\controllers\UserController;

$username = $_POST['name'];
$password = $_POST['password'];

$userCtl = new UserController;

echo $userCtl->login($username, $password);

?>
