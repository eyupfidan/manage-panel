function get_subcategory() {
    var city_id = "CategoryID=" + $("#CategoryID").val();
    $.ajax({
        type:'GET',
        url:'https://manager.itembag.net/action/get_subcategory.php',
        data: city_id,
        success:function(html){
            $('#SubCategoryID').html(html);
        }
    }); 
}
 