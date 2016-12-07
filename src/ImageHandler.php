<?php

require_once "DatabaseConnection.php";
require_once "Image.php";

class ImageHandler extends DatabaseConnection{

    public $error;
    public function save($title, $rel_path, $subheader, $description, $alternative ){
        $success = TRUE;
        try{

            $query = $this->conn->prepare("INSERT INTO ".$this->tbl_images." (title, relative_path, subheader, description, alternative ) VALUES (:title, :rel_path, :subheader, :description, :alternative)");
            $query->bindParam(":title", $title);
            $query->bindParam(":rel_path", $rel_path);
            $query->bindParam(":subheader", $subheader);
            $query->bindParam(":description", $description);
            $query->bindParam(":alternative", $alternative);

            $query->execute();

        } catch (PDOException $e) {
            $this->error = "ERROR: ".$e->getMessage();
            $success = FALSE;

        }

        return $success;

    }

    public function getInsertId(){

        return $this->conn->lastInsertId();
    
    }

    public function getImage($id){

        try{

            $query = $this->conn->prepare("SELECT * FROM ".$this->tbl_images." WHERE id = :id");
            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $image = new Image($result['id'], $result['title'], $result['relative_path'], $result['subheader'], $result['description'], $result['alternative'], $result['shown']);
            return $image;
        
        } catch (PDOException $e) {
        
            $error =  $e->getMessage();
            return FALSE;
        }
 
    }

    public function update($id, $title, $subheader, $description, $alternative, $shown ){
        $success = TRUE;
        try{

            $query = $this->conn->prepare("UPDATE ".$this->tbl_images." set title = :title, subheader = :subheader, description = :description, alternative = :alternative, shown = :shown where id = :id ");
            $query->bindParam(":title", $title);
            $query->bindParam(":subheader", $subheader);
            $query->bindParam(":description", $description);
            $query->bindParam(":alternative", $alternative);
            $query->bindParam(":shown", $shown);
            $query->bindParam(":id", $id);

            $query->execute();

        } catch (PDOException $e) {
            $this->error = "ERROR: ".$e->getMessage();
            $success = FALSE;

        }

        return $success;

    }
    public function getImages(){

        try{

            $query = $this->conn->prepare("SELECT * FROM ".$this->tbl_images );
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        
        } catch (PDOException $e) {
        
            $error =  $e->getMessage();
            return FALSE;
        }
 
    }



}
?>
