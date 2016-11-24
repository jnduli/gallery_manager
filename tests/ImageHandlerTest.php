<?php
//use PHPUnit\Framework\TestCase;

require_once "GenericDatabaseTest.php";
require_once "../src/ImageHandler.php";

class ImageHandlerTest extends GenericDatabaseTest{

    public function testSave(){
        $image_handler = new ImageHandler;
        $result = $image_handler->save("title","rel_path","subheader", "description", "alternative");
        $this->assertEquals($result, TRUE, $image_handler->error);

        $image = $image_handler->getImage($image_handler->getInsertId());
        $this->assertEquals($image->getTitle(), "title");

    }

    public function testUpdate(){
        $image_handler = new ImageHandler;
        $result = $image_handler->save("titleUpdate","rel_pathUpdate" ,"subheader", "description", "alternative");
        $this->assertEquals($result, TRUE, $image_handler->error);

        $id = $image_handler->getInsertId();

        $image = $image_handler->getImage($id);
        $this->assertEquals($image->getTitle(), "titleUpdate");

        $result = $image_handler->update($id, "newtitle", "subheader", "description", "alternative", 1);
        $this->assertEquals($result, TRUE, $image_handler->error);

        $image = $image_handler->getImage($id);
        $this->assertEquals($image->getTitle(), "newtitle");

    }


}

?>
