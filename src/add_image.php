<?php
include "loginheader.php";
include "modular_views/header.php";
include "modular_views/header_menu.php";
?>

<div id="page_title" class="row">
    <h4>Add Image</h4>
</div>

<div id="projects" class="row small-up-1 medium-up-2 large-up-3 ">
    <div class="small-12 small-centered columns">
        <div class="callout">
            <p id="title_show">Title</p>
            <p><img id="upload_show" src="http://placehold.it/400X300"></p>
            <p id="contents_show" class="lead">Contents</p>
            <p id="description_show" class="subheader">Description</p>
        </div>
    </div>
</div>



<form id="image_upload_form" enctype="multipart/form-data" action="uploaded_backend.php" method="POST">
    <div id="msg_submit" class="label hide">Random Content</div>

    <div class ="row">
        <div class="large-6 columns">
            <label>Title
                <input id="title" type="text" placeholder="Title at top of image" name="title" required/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="large-6 columns">
            <label>Contents
                <input id="contents" type="text" placeholder="Image contents" name="content" required/>
            </label>
        </div>
    </div>
    <div class ="row">
        <div class="large-12 columns">
            <label>Description
                <input  id="description" type="text" placeholder="Detailed description of image" name="description" required/>
            </label>
        </div>
    </div>

    <div class="row">
        <div class = "large-6 columns">
            <label>Upload Image
                <input id="upload" type="file" name="userfile" id="userfile" required/>
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
<script src="assets/js/upload.js"></script>

<?php
include "modular_views/footer.php";
?>
