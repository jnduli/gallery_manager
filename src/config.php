<?php
$host = "localhost"; 
$username = "root"; 
$password="root"; 
$dbname ="images";

//tables
$tbl_users = "users";
$tbl_images = "images";

$test_environment = TRUE;

if($test_environment){
    $dbname = "test_".$dbname;
}

$tbl_users = "users";

//settings for the upload file directories
$upload_dir = __DIR__. "/uploaded_images/";
//$upload_dir = "/uploaded_images/";
$relative_dir = "/uploaded_images/";
?>
