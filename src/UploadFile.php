<?php
namespace Upload;

class UploadFile{
    public $error;
    public $upload_file;
    
    public function uploadFile(){
        include "controllers/config.php";
        $image = $_FILES['image'];
    
        if ($this->checkImageErrors($image['error'])){
            return False;
        }

        if ( !$this->checkIfImage(getimagesize($image['tmp_name'])) ){
            return False;
        } 

        $upload_file = $upload_dir . basename($image['name']);

        $this->upload_file = $upload_file;

        if ( file_exists($upload_file) ){
            $this->error = "File already exists in server. Try changing file name if it has to be uploaded.";
            return False;
        
        }

        if ( move_uploaded_file($image['tmp_name'], $upload_file) ) {
            $relative_file = $relative_dir . $image['name'];
            return $relative_file;
        }else {

            $this->error = "Could not upload file. Unknown error";
            return False;
        
        }
    }

    private function checkImageErrors($imageError){
        $image_error = true;

        switch($imageError){

        case UPLOAD_ERR_OK:
            $image_error = false;
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $this->error =  "File too large. Limit of ".get_max_upload(). ' bytes.'; 
            $image_error = true;
            break;
        case UPLOAD_ERR_PARTIAL:
            $this->error = "File upload was not completed";
            $image_error = true;
            break;
        case UPLOAD_ERR_NO_FILE:
            $this->error = "Zero length file uploaded";
            $image_error = true;
            break;
        default:
            $this->error = "Internal Error ".$imageError;
            $image_error = true;
            break;
        }

        return $image_error;

    }

    private function checkIfImage($image_info){

        if($image_info == FALSE){
        
            $this->error = "Unable to determine type of file";
            return FALSE;

        }
        
        $type = $image_info[2];
        if( $type !== IMAGETYPE_GIF && $type !== IMAGETYPE_JPEG && $type !== IMAGETYPE_PNG ) {

            $this->error = "FIle is not a gif, jpeg or png";
            return FALSE;
        
        }

        return TRUE;
    
    }

}
?>
