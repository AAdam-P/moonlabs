$('#getParcelInfo').on('click', function(){
    var packageNumberInput = $("#parcelNumberInput").val();
    $.ajax('?menu=parcels',{
        method: "POST",
        data: {'query' : 'getPackage', packageNumber: packageNumberInput},
        success: function(Response){
        }
    })
})    