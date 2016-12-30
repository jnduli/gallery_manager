<?php

require "../vendor/autoload.php";

use Gallery\controllers\ImageHandler;
include "loginheader.php";
include "modular_views/header.php";
include "modular_views/header_menu.php";

$id = $_GET['id'];
$imageHandler = new ImageHandler;
$image = $imageHandler->getImage($id);

?>

<div id="page_title" class="row">
    <h4>Edit Image</h4>
</div>

<div id="projects" class="row small-up-1 medium-up-2 large-up-3 ">
    <div class="small-12 small-centered columns">
        <div class="callout">
        <p id="title_show"><?php echo $image->getTitle();?></p>
        <p><img id="upload_show" src="<?php echo $image->getRelPath();?>"></p>
        <p id="contents_show" class="lead"><?php echo $image->getSubheader();?></p>
        <p id="description_show" class="subheader"><?php echo $image->getDescription();?></p>
        </div>
    </div>
</div>



<form id="image_upload_form" enctype="multipart/form-data" action="updated_backend.php" method="POST">
    <div id="msg_submit" class="label hide">Random Content</div>
    <input name="id" value="<?php echo $id;?>" type="hidden"/>

    <div class ="row">
        <div class="large-6 columns"> <label>Title
            <input id="title" type="text" placeholder="Title at top of image" name="title" required value="<?php echo $image->getTitle();?>"/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="large-6 columns">
            <label>Contents
            <input id="contents" type="text" placeholder="Image contents" name="content" required value="<?php echo $image->getSubheader();?>"/>
            </label>
        </div>
    </div>
    <div class ="row">
        <div class="large-12 columns">
            <label>Description
            <input  id="description" type="text" placeholder="Detailed description of image" name="description" required value="<?php echo $image->getDescription();?>"/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="large-4 columns">
            <label>Show Image
                <select name="shown">
                    <option value='1' <?php if($image->isShown())echo 'selected="selected"';?>>Yes</option>
                    <option value='0' <?php if(!$image->isShown())echo 'selected="selected"';?>>No</option>
                </select>
            </label>
        </div>
    </div>
 

   <div class="row">
        <div class="large-6 columns">
            <input id="submit" class="button" type="submit" value="send File"/>
        </div>
    </div>

</form>

<?php 
include "scripts.php";
?>
<script src="assets/js/update.js"></script>

<?php
include "modular_views/footer.php";
?>
