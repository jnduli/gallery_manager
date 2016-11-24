<?php
//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

use PHPUnit\Extensions\SeleniumTestCase;

class UserFunctionalTest extends PHPUnit_Extensions_SeleniumTestCase{
    protected function setUp(){
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://localhost_gallery.com/');
    }

    public function testTitle(){
        $this->open('http://localhost_gallery.com/');
        $this->assertTitle('Sample Page');
    
    }

} 

?>
