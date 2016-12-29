<?php
use PHPUnit\Framework\TestCase;


use Gallery\controllers\UserController;
use Gallery\models\User;
require_once "GenericDatabaseTest.php";
//require_once "../src/controllers/User.php";
//require_once "../src/controllers/UserController.php";


class UserTest extends GenericDatabaseTest{

    public function testUserCreated(){
        $userCtl = new UserController;
        //test creation of new user
        $create = $userCtl->create("name","email", "password");
        $this->assertEquals($create, TRUE, "Failed Creating user: ".$create);

        //gets the usercreated for further tests
        $user = $userCtl->getUser("name");
        $this->assertEquals($user->getName(), "name", "ERROR: ".$userCtl->error);

        $this->assertTrue($user->checkPassword("password"), "ERROR: Password not similar");
        $this->assertEquals($user->isVerified(),0, "ERROR: User is verified by system already");
    }

    public function testUserVerified(){
        $userCtl = new UserController;
        //test creation of new user
        $create = $userCtl->create("verified","emailverify", "password");
        $this->assertEquals($create, TRUE, "Failed Creating user: ".$create);
        $user = $userCtl->getUser("verified");
        $success = $userCtl->verify($user->getName(), $user->getVerificationId());
        $this->assertTrue($success, "ERROR: ".$success);

        $user = $userCtl->getUser("verified");
        $this->assertEquals($user->isVerified(),1, "ERROR: User not verified but should be");
   
    }

    public function testUserLogin(){
        $userCtl = new UserController;
        //test creation of new user
        $create = $userCtl->create("login","emaillogin", "password");
        $this->assertEquals($create, TRUE, "Failed Creating user: ".$create);

        //failed login due to not verified
        $success = $userCtl->login("login", "password");
        $this->assertNotEquals($success, TRUE, "ERROR: ".$success);

        //verify account
        $user = $userCtl->getUser("login");
        $success = $userCtl->verify($user->getName(), $user->getVerificationId());
        $this->assertTrue($success, "ERROR: ".$success);
 

        //successful login
        $success = $userCtl->login("login", "password");
        $this->assertTrue($success, "ERROR: Failed login that shoudl work");

        //failed login
        $success = $userCtl->login("login", "randomek");
        $this->assertFalse($success, "ERROR: ".$success);
   
    }
}

?>
