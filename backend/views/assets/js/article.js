/**
 * Created by Администратор on 28.11.2014.
 */

$(function () {

    //Удаление
    $("body").on('click', ".delParam", function () {
        var parentDiv = $(this).parent().parent().parent().parent();
        var article = parentDiv.find('.articleInput').val();
        var param = parentDiv.find('.paramInput').val();

        jQuery.ajax({
            url: '/article/delete-parameter?article=' + article + '&param=' + param,
            //dataType: "html",
            success: function(data) {
                parentDiv.remove();
            }
        });
        return false;
    });


});