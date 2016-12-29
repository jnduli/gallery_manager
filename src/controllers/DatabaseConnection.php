<?php
namespace Gallery\controllers;

class DatabaseConnection{

    public $conn;
    public $tbl_users;
    public $tbl_images;

    public function __construct(){
        include($_SERVER('DOCUMENT_ROOT').'config.php');
        $this->tbl_users = $tbl_users;
        $this->tbl_images = $tbl_images;
        $this->conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
?>
