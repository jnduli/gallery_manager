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
        $('#upload_show').attr('src', "http://placehold.it/400X300");
    }
    $('#upload').change(function(){
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') +1).toLowerCase();
        if ($(this)[0].files && $(this)[0].files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#upload_show').attr('src', e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        }else{
            alert("File selected is not an image");
        }

    });
    $("#image_upload_form").submit(function(e) {
        e.preventDefault();
        var form_data = new FormData($('#image_upload_form')[0]);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            //data: $(this).serialize(), // serializes the form's elements.
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data)
            {
                if (data == 'true'){
                    $('#image_upload_form')[0].reset();
                    messageShow(true, 'Success: Image uploaded');
                    resetPreview();
                }else{
                    messageShow(false, "Error:" +data);
                }
            },
            error: function(error){
                $('#image_upload_form')[0].reset();
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
