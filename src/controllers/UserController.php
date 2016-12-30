<?php
namespace Gallery\controllers;

use Gallery\models\User;
use PDO;

class UserController extends DatabaseConnection{
    public $error;

    public function create ($name, $email, $password) {
        $success = TRUE;
        try{

            $verid = uniqid(rand() ,false);
            $query = $this->conn->prepare("INSERT INTO ".$this->tbl_users." (name, email, password, verificationid) VALUES (:name, :email, :password, :verid)");
            $query->bindParam(":name", $name);
            $query->bindParam(":email", $email);
            $newpwd = password_hash($password, PASSWORD_DEFAULT);
            $query->bindParam(":password", $newpwd);
            $query->bindParam(":verid", $verid);
            $query->execute();

        } catch (PDOException $e) {

            $success = $e->getMessage();
        
        }

        return $success;
    }

    public function getUser($name){
        try{
            $query = $this->conn->prepare("SELECT * FROM ".$this->tbl_users." WHERE name = :name");
            $query->bindParam(":name", $name);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $user = new User($result['name'], $result['password'], $result['verified'], $result['email'], $result['verificationid']);
            return $user;
        
        } catch (PDOException $e) {
        
            $error =  $e->getMessage();
            return FALSE;

        }
    
    }

    public function verify($name, $verid){
        $success = TRUE;
        try{
            $query = $this->conn->prepare("UPDATE ".$this->tbl_users." SET verified = 1 WHERE name = :name AND verificationid= :verid");
            $query->bindParam(":name", $name);
            $query->bindParam(":verid", $verid);
            $done = $query->execute();

        } catch (PDOException $e) {
        
            $success =  $e->getMessage();
            return $success;
        }
 
        return $success;
    }
    public function login($name, $password){

        $user = $this->getUser($name);
        if ( $user && $user->isVerified() && $user->checkPassword($password) ){
        
            session_start();
            $_SESSION['username'] = $name;
            return TRUE;
        }
        return FALSE;
        
    }

    public function test(){
        echo "UserControlee wokrs";
    }
}

?>
