$(document).ready(function () {
    $('#getPackageInfo').on('click', function(){
        $.ajax({
            method: "POST",
            url: "http://localhost/MoonLabs/?menu=parcel",
            data: {query: 'getParcel' , 'parcel': $('#parcelNumberInput').val() },
            success: function(Response){
                $('#parcelTxt').val(Response);
            },
            error: function(Response){
                alert(Response);
            }
        })
    })     
})