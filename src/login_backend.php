<?php
require_once "UserController.php";

$username = $_POST['name'];
$password = $_POST['password'];

$userCtl = new UserController;

echo $userCtl->login($username, $password);


?>
