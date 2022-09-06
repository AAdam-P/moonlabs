$(document).ready(function () {
    $.ajax({
        method: "POST",
        url: "http://localhost/MoonLabs/?menu=users",
        data: {query: 'getUsers'},
        success: function(Response){
            $('#usersTxt').val(Response);
        },
        error: function(Response){
            alert(Response);
        }
    })
})