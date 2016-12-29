<?php
namespace Gallery\models;

class Image{
    private $id;
    private $title;
    private $rel_path;
    private $subheader;
    private $description;
    private $alternative;
    private $shown;

    public function __construct($id, $title, $rel_path, $subheader, $description, $alternative, $shown){

        $this->id = $id;
        $this->title= $title;
        $this->rel_path = $rel_path;
        $this->subheader = $subheader;
        $this->description = $description;
        $this->alternative = $alternative;
        $this->shown = $shown;
    
    }

    public function getTitle(){

        return $this->title;
    
    }

    public function isShown(){
    
        return $this->shown;

    }

    public function getSubheader(){

        return $this->subheader;
    
    }

    public function getRelPath(){

        return $this->rel_path;
    
    }

    public function getDescription(){
    
        return $this->description;
    }

}
?>
