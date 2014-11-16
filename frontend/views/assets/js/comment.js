$(function () {

    //Нажатие на "Ответить"
    $("body").on('click', ".reply", function () {
        deleteForm ();
        var form = $('#newCommentForm').clone().attr('id', 'replyComment');
        form[0].reset();
        var parent = $(this).parent().parent().parent().attr('id').slice(8);
        form.find('#articlecomment-id_parent').val(parent);
        $(this).after(form);
    })

    //Отправка ответа
    .on('click', "#replyComment button", function () {
        comment ('#replyComment');
        return false;
    });

    //Отправка нового комментария
    $('#newCommentForm').on('beforeSubmit', function () {
        comment ($(this));
        return false;
    });

    //Отправка комментария
    function comment (form) {
        var selectForm = $(form);

        if (selectForm.find('#articlecomment-text').val() != '') {

            jQuery.ajax({
                url: '/article/add-comment.html',
                type: 'POST',
                dataType: "html",
                data: selectForm.serialize(),
                success: function(data) {

                    if (form == '#replyComment') {
                        var id = selectForm.find('#articlecomment-id_parent').val();

                        var childs = $('[data-parent = comment-' + id + ']');
                        if (childs.size() > 0)
                            childs.last().after(data);
                        else $('[id = comment-' + id + ']').after(data);

                        deleteForm ();
                    }
                    else {
                        $('#comments-list').append(data);
                        selectForm[0].reset();
                    }

                }
            });
        }
    }

    //Удаление формы комментария
    function deleteForm () {
        $('#replyComment').remove();
    }

});