<?php
require "loginheader.php";
require_once "ImageHandler.php";
$imagehandler = new ImageHandler;

if(!isset($shown)){
    $images = $imagehandler->getImages();
}else{
    if ($shown ==1 )
        $value = TRUE;
    else if ($shown == 2) 
        $value =0; 
    $images = $imagehandler->getShownImages($value);
}
include "header.php";
include "header_menu.php";
?>

<ul class="menu" data-dropdown-menu>
    <li <?php if(!isset($shown))echo "class='active'";?>><a href="edit_images.php">ALL IMAGES</a></li>
    <li <?php if($shown == 1)echo "class='active'";?>><a href="edit_images.php?shown=1">IMAGES SHOWN</a></li>
    <li <?php if($shown==2)echo "class='active'";?>><a href="edit_images.php?shown=2">IMAGE NOT SHOWN</a></li>
</ul>

<div class="off-canvas-content" data-off-canvas-content>

    <!-- Page Content Goes here -->
    <div class="row column">
        <hr>
    </div>

    <div class="row column">
        <p class="lead">Projects</p>
    </div>

    <div id="projects" class="row small-up-1 medium-up-2 large-up-3">
        <?php
                       foreach($images as $image):?>
                       <div class="column">
                           <div class="callout">
                               <p id="image_title_for_test"><?php echo $image['title'];?></p>
                               <p><img src="<?php echo $image['image_link'];?>" alt="Transformer Installation"></p>
                               <p class="lead"><?php echo $image['contents'];?></p> 
                               <p class="subheader"><?php echo $image['description'];?></p>
                               <a href="update_image.php?id=<?php echo $image['id'];?>" classs="button">EDIT IMAGE</a>
                           </div>
                       </div>

                       <?php endforeach;?>
    </div>

    <?php
                                                                                        include 'footer.php';
                                                                                        ?>

