$(function () {

    $('#newCommentForm').on('beforeSubmit', function () {

        jQuery.ajax({
            url: '/article/add-comment.html',
            type: 'POST',
            //dataType: "json",
            dataType: "html",
            data: $(this).serialize(),
            success: function(data) {
                $('#comments-list').append(data);
            }
        });

        return false;
    });
    
});