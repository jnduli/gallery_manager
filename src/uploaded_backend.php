<?php   
require "loginheader.php"; 

require_once "ImageHandler.php";
require_once "config.php";

$imagehandler = new ImageHandler;
$image_title = $_POST['title'];
$image_content = $_POST['content'];
$image_description = $_POST['description'];
$image = $_FILES['userfile'];

//dealing with image upload errors
$image_error = 'Error Uploading File';
switch($image['error']){
case UPLOAD_ERR_OK:
    $image_error = false;
    break;
case UPLOAD_ERR_INI_SIZE:
case UPLOAD_ERR_FORM_SIZE:
    $image_error .= 'File too large. Limit of '.get_max_upload(). 'bytes.';
    break;
case UPLOAD_ERR_PARTIAL:
    $image_error .= 'File upload was not completed';
    break;
case UPLOAD_ERR_NO_FILE:
    $image_error .= 'Zero length file uploaded';
    break;
default:
    $image_error .= 'Internal Error '.$image['error'];
    break;

}

if ($image_error){
    die($image_error);
}


$uploadfile = $upload_dir . basename($image['name']);

$info = getimagesize($image['tmp_name']);
if ($info == FALSE) {
    die("Unable to determine image type of uploaded file");
}

if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
    die("Not a gif/jpeg/png");
}

if (file_exists($uploadfile)){
    die('The file exists in server. Try changing name of file if it has to be uploaded');
}

if ($image_title ==null || $image_content == null || $image_description == null){
    die("Please fill in all the required details");
}

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    $relfile =$relative_dir.$image['name'];
    $success = $imagehandler->save($image_title, $relfile, $image_content, $image_description, "Image showing :".$image_content); 
    if ($success === TRUE){
        echo 'true';
    }else{
        echo 'Something went wrong';
    }
} else {
    echo "Could not upload file." ;
}

?>
