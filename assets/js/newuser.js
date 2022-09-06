$(document).ready(function () {
    $('#newSubmit').on('click', function(){
        var jsonGen = {
            "first_name": $('#newFirst').val(),
            "last_name": $('#newLast').val(),
            "password": $('#newPassword').val(),
            "email_address": $('#newMail').val(),
            "phone_number": $('#newPhone').val()
        }; 
        $.ajax({
            method: "POST",
            url: "http://localhost/MoonLabs/?menu=newuser",
            data: {query: 'newUserJson' , 'json': jsonGen },
            success: function(Response){
                $('#parcelTxt').val(Response);
            },
            error: function(Response){
                alert(Response);
            }
        })
    })     
})