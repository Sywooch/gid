/**
 * Created by Администратор on 28.11.2014.
 */

$(function () {
    var url = window.location.pathname;

    //Обновление параметров
    function updateParams () {
        var exception = $(".paramInput").map(function(i, e) {
            return $(e).val();
        }).get().join();

        jQuery.ajax({
            url: '/article/update-select',
            type: "POST",
            data: {exception : exception},
            success: function(data) {
                $('#searchParams').html(data);
            }
        });
    }

    //Удаление
    $("body").on('click', ".delParam", function () {
        var parentDiv = $(this).parent().parent().parent().parent();

        if (url.indexOf('update') > 0 ) {
            var article = parentDiv.find('.articleInput').val();
            var param = parentDiv.find('.paramInput').val();

            jQuery.ajax({
                url: '/article/delete-parameter?article=' + article + '&param=' + param
            });
        }
        parentDiv.remove();
        updateParams();
        return false;
    })
    //Добавление
    .on('click', "#addParam", function () {
        var article = '';

        if (url.indexOf('update') > 0 ) {
            article = '&article=' + Number(url.replace(/\D+/g, ""));
        }
        var param = $('#param-unique').val();

        jQuery.ajax({
            url: '/article/add-parameter?param=' + param + article,
            success: function(data) {
                if (url.indexOf('update') > 0 )
                    $('#parameters').html(data);
                else $('#parameters').append(data);
                updateParams();
            }
        });
        return false;
    });


});