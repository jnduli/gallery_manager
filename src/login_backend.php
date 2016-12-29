<?php
require_once "controllers/UserController.php";

$username = $_POST['name'];
$password = $_POST['password'];

$userCtl = new UserController;

echo $userCtl->login($username, $password);


?>
