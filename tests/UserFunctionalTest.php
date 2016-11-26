<?php

use PHPUnit\Framework\TestCase;
require_once "GenericDatabaseTest.php";

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;


class UserFunctionalTest extends GenericDatabaseTest{

    protected $url = "http://localhost_gallery";
    protected $webDriver;

    protected function setUp(){

        parent::setUp();

        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::firefox();

        $this->webDriver = RemoteWebDriver::create($host, $capabilities, 5000);

        //create a verified user with name jane and password password for testing

    }

    protected function tearDown(){

        parent::tearDown();
        if( $this->webDriver ){

            $this->webDriver->quit();
        
        }
    
    }

    public function testSuccessfulUserLoginandFunctions(){
        //Jane has successfully set up the system
        //She then opens up the system
        
        $this->webDriver->get($this->url);

        //She is redirected to a login page
        //The page should show the title Gallery Manager
        
        $this->assertContains('Gallery', $this->webDriver->getTitle());
        //It also contains a form to be input by Jane
        
        $form = $this->webDriver->findElement(WebDriverBy::tagName('form'));
        $this->assertNonNull($form, "ERROR: No form in the page");
        //Jane then inputs her username and a wrong password
        //An error message is shown informing her of the error
        //Jane then corrects it and inputs the correct password
        //She is redirected to a page than contains all the images in the system
        //This page should contain no image
        //She then decides to add an image
        //She clicks on the link to add an image
        //A page showns with a title reading add image
        //She then fillsup the form
        //She also browses and adds an image
        //She clicks upload and the image is uploaded
        //A message showing the same is produced
        //She clicks on all images and the new image is shown in the system
        //She then opts to edit the image uploaded
        //She clicks on edit image
        //SHe then changes the title of the image to something else
        //She clicks update image and a message confirming the change is shown
        //She then clicks all images and confirms the change
        //She logs out of the system
    
    }


}
?>
