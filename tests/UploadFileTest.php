<?php
namespace Upload;

use PHPUnit\Framework\TestCase;

require_once "../src/UploadFile.php";

function move_uploaded_file($filename, $destination){
    return copy($filename, $destination);
}

class UploadFileTest extends TestCase{

    protected function setUp(){
        parent::setUp();
        $_FILES = array(
            'image'    =>  array(
                'name'      =>  'test.jpg',
                'tmp_name'  =>  __DIR__ . '/files/phpunit.jpg',
                'type'      =>  'image/jpeg',
                'size'      =>  499,
                'error'     =>  0
                        )
                    );
    }

    public function testUploadFile(){
        $upload = new UploadFile;
        $result = $upload->uploadFile();

        $this->assertNotEquals($result, FALSE, $upload->error);

        //deletes file for the next test
        unlink($upload->upload_file);
    
    }

}
?>
