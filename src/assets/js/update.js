$(document).ready(function(){
    $('#title').keyup(function(){
        $('#title_show').text($(this).val());
    });
    $('#contents').keyup(function(){
        $('#contents_show').text($(this).val());
    });
    $('#description').keyup(function(){
        $('#description_show').text($(this).val());
    });
 
    function resetPreview(){
        $('#title_show').text('Title');
        $('#contents_show').text('Contents');
        $('#description_show').text('Description');
    }
    $("#image_upload_form").submit(function(e) {
        e.preventDefault();
        //var form_data = new FormData($('#image_upload_form')[0]);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data)
            {
                if (data == 'true'){
                    //$('#image_upload_form')[0].reset();
                    messageShow(true, 'Success: Image uploaded');
                    //resetPreview();
                }else{
                    messageShow(false, "Error:" +data);
                }
            },
            error: function(error){
                //$('#image_upload_form')[0].reset();
                messageShow(false, "Error: did not connect to server "+$('#image_upload_form').attr('action'));
            }
        });
    });

    function messageShow(valid, message){
        if (valid){
            var msgClasses = "label success";
        }else{
            var msgClasses = "label alert";
        }
        $('#msg_submit').removeClass().addClass(msgClasses).html('<h4>'+message+'</h4>');
    }
});
