$(document).ready(function () {
    $('#submitparcel').on('click', function(){
        var jsonGen = {
            "size": $('#parcelSize').val(),
            "user_id": $('#userId').val()
        }; 
        $.ajax({
            method: "POST",
            url: "http://localhost/MoonLabs/?menu=parcels",
            data: {query: 'parcels' , 'json': jsonGen },
            success: function(Response){
                $('#parcelTxt').val(Response);
            },
            error: function(Response){
                alert(Response);
            }
        })
    })     
})