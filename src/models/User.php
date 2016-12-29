<?php
namespace Gallery\models;

class User{
    private $name;
    private $password;
    private $verified;
    private $emaii;

    private $verId;

    public function __construct($name, $password, $verified, $email, $verId){
        $this->name = $name;
        $this->password = $password;
        $this->verified = $verified;
        $this->email = $email;
        $this->verId = $verId;

    }

    public function checkPassword($passwd){

        return password_verify($passwd, $this->password);

    }

    public function getName(){

        return $this->name;
    
    }

    public function getVerificationId(){
    
        return $this->verId;
    
    }

    public function isVerified(){
    
        return $this->verified;

    }
}

?>
