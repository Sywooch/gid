$(function () {

    $('#newCommentForm').on('beforeSubmit', function () {

        jQuery.ajax({
            url: '/article/add-comment.html',
            type: 'POST',
            //dataType: "json",
            dataType: "html",
            data: $(this).serialize(),
            success: function(response) {
                //alert('yeah');
            }
        });

        return false;
    });



});