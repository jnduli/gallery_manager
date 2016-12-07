$(document).ready(function(){
    $('#login_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            type : "POST",
            url : $(this).attr('action'),
            data : $(this).serialize(),
            success : function(data){
                if(data){
                    window.location = "index.php";
                }else{
                    $('#message').html("<p id='error_message' class='alert callout'>Error: Login attempt failed. Please check username or password</p>");
                }
            
            },
            error: function(error){
                console.log($(this).attr('action'));
                console.log(error);
//                alert("something wrong happened");
            },
            beforeSend: function(){
                $('message').html("<p class='text-center'><img src='assets/img/ajax-loader.gif'></p>");
            }
        });
    });

});
