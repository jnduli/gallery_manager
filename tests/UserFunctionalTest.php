<?php

use PHPUnit\Framework\TestCase;
require_once "GenericDatabaseTest.php";
require_once "../src/UserController.php";

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\LocalFileDetector;



class UserFunctionalTest extends GenericDatabaseTest{

    protected $url = "http://localhost_gallery.comd";
    protected $file_path = __DIR__."/files/phpunit.jpg";
    protected $file_uploaded_path = __DIR__."/../src/uploaded_images/phpunit.jpg";
    protected $webDriver;

    protected function setUp(){

        parent::setUp();

        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::firefox();

        $this->webDriver = RemoteWebDriver::create($host, $capabilities, 5000);

        //create a verified user with name jane and password password for testing
        $user = new UserController;
        $user->create("jane","jane@jane.com","password");
        $jane  = $user->getUser("jane");
        $user->verify($jane->getName(), $jane->getVerificationId());

    }

    protected function tearDown(){

        parent::tearDown();
        unlink($this->file_uploaded_path);
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
        $this->assertNotNull($form, "ERROR: No form in the page");
        //Jane then inputs her username and a wrong password
        //An error message is shown informing her of the error


        $this->webDriver->findElement(WebDriverBy::id("name"))->sendKeys("jane");
        $this->webDriver->findElement(WebDriverBy::id("password"))->sendKeys("wrongPassword");

        $this->webDriver->findElement(WebDriverBy::id("login_button"))->click();

        $this->webDriver->wait(10,500)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("error_message"))
        );

        $error = $this->webDriver->findElement(WebDriverBy::id("message"))->getText();
        $this->assertContains("Error", $error);

        
        //Jane then corrects it and inputs the correct password
        //She is redirected to a page than contains all the images in the system
         $this->webDriver->findElement(WebDriverBy::id("name"))->clear()->sendKeys("jane");
        $this->webDriver->findElement(WebDriverBy::id("password"))->clear()->sendKeys("password");

        $this->webDriver->findElement(WebDriverBy::id("login_button"))->click();

        $this->webDriver->wait(20,500)->until(function ($driver) {
            return $driver->getCurrentURL() === $this->url."/index.php";
        });
       
        $success = $this->webDriver->findElement(WebDriverBy::id("success"))->getText();
        $this->assertContains("Success", $success);

        //This page should contain no image
        //She then decides to add an image
        //She clicks on the link to add an image

        $this->webDriver->findElement(WebDriverBy::id("add_image"))->click();
        $this->webDriver->wait(10,500)->until( function ($driver) {
            return $driver->getCurrentURL() === $this->url."/add_image.php";
        });
        //A page showns with a title reading add image
        $title = $this->webDriver->findElement(webDriverBy::id("page_title"))->getText();
        $this->assertContains($title, "Add Image");
        //She then fillsup the form
        $this->webDriver->findElement(WebDriverBy::id("title"))->sendKeys("doodles");
        $this->webDriver->findElement(WebDriverBy::id("contents"))->sendKeys("Random doodles I made");
        $this->webDriver->findElement(WebDriverBy::id("description") )->sendKeys("This was drawn in class");

        //She also browses and adds an image
        
        $file_input = $this->webDriver->findElement(WebDriverBy::id("upload"));
        $file_input->setFileDetector(new LocalFileDetector());
        $file_input->sendKeys($this->file_path);

        //She clicks upload and the image is uploaded
        
        $this->webDriver->findElement(WebDriverBy::id("submit"))->click();

        //A message showing the same is produced

        $msg = $this->webDriver->findElement(WebDriverBy::id("msg_submit"))->getText();
        $this->webDriver->manage()->timeouts()->implicitlyWait(20000);
        $this->assertContains("Success", $msg);

        //She clicks on all images and the new image is shown in the system
        
        $this->webDriver->findElement(WebDriverBy::id("edit_images"))->click();
        $contents = $this->webDriver->findElement(WebDriverBy::className("lead"))->getText();
        $this->assertContains("Random doodles",$contents);

        //She then opts to edit the image uploaded
        //She clicks on edit image
        //SHe then changes the title of the image to something else
        //She clicks update image and a message confirming the change is shown
        //She then clicks all images and confirms the change
        //She logs out of the system
    
    }


}
?>
