/*$(document).ready(function(){
    alert("moon.js loaded with JQuery");
})*/

$(document).ready(function () {
    $('.loginBtn').on('click', function(){
        $('#wrongLogin').addClass('hidden');
        $('#succesfulLogin').addClass('hidden');
        $.ajax({
            method: "POST",
            url: "http://localhost/MoonLabs/",
            data: {umail: $("#userEmail").val(), upass: $("#userPassword").val() },
            success: function(Response){
                if(Response !== ""){
                    if(Response == 'OK'){
                        $('#successfulLogin').removeClass('hidden');
                        setTimeout(function(){
                            location.reload(); 
                        }, 2000);
                    }
                    else if(Response == 'Hibás felhasználó vagy jelszó!'){
                        $('#wrongLogin').removeClass('hidden');
                    }
                }
            }
        })
    })     
    $('#logOut').on('click', function(){
        $.ajax({
            method: "POST",
            url: "http://localhost/MoonLabs/",
            data: {query :'logout'},
            success: function(Response){
                location.reload();
            }
        })
    }) 
})

    