<?php   
require "loginheader.php"; 

require_once "ImageHandler.php";
require_once "config.php";

$imagehandler = new ImageHandler;

$id = $_POST['id'];
$image_title = $_POST['title'];
$image_content = $_POST['content'];
$image_description = $_POST['description'];
$image_shown = $_POST['shown'];
$alternative ="alt image";


if ($image_title ==null || $image_content == null || $image_description == null){
    die("Please fill in all the required details");
}

$success = $imagehandler->update($id, $image_title, $image_subheader, $image_description, $alternative, $image_shown);
if ($success === TRUE){
    echo 'true';
}else{
    echo 'Something went wrong';
}

?>
