<?php
include "modular_views/header.php";
?>

<div class="row">
    <div class="medium-6 medium-centered large-4 large-centered columns">
        <form id="login_form" action="/login_backend.php">
            <div class="row column log-in-form">
                <div class="log-in-form">
                    <h4 class="text-center">Log in with your username</h4>
                    <label>Username
                        <input id="name" name="name" type="text" placeholder="janedoe" required>
                    </label>
                    <label>Password
                        <input id="password" name="password" type="password" placeholder="Password" required>
                    </label>
                    <input type="submit" id="login_button" class="button expanded" value="Log In"/>
                    <div id="message"></div>

                    <p class="text-center"><a href="#">Forgot your password?</a></p>   
                    
                </div>
            </div>

        </form>

    </div>

</div>
<?php
include "scripts.php";
?>
<script src="assets/js/login.js"></script>
<?php
include "modular_views/footer.php";
?>

