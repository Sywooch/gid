$(function () {

    //Нажатие на "Ответить"
    $("body").on('click', ".reply", function () {
        deleteForm ();
        var form = $('#newCommentForm').clone().attr('id', 'replyComment');
        form[0].reset();
        var parent = $(this).parent().parent().parent().attr('id').slice(8);
        form.find('#articlecomment-id_parent').val(parent);
        form.find('.btn-danger').removeClass('hidden');
        $(this).parent().after(form);
    })

    //Отправка ответа
    .on('click', "#replyComment .btn-primary", function () {
        comment ('#replyComment');
        return false;
    })
    //Удаление формы кнопкой
    .on('click', "#replyComment .btn-danger", function () {
        deleteForm ();
    })

    //Скрытие / Показ ветки
    .on('click', ".hide-children", function () {
        var id = $(this).parent().parent().parent().attr('id');

        var childs = $('[data-parent = ' + id + ']');
        if (childs.size() > 0) {
            childs.toggle();
            if ($(this).html().indexOf('down') > 0)
                $(this).html("Показать ветку <span class='glyphicon glyphicon-chevron-up'></span>");
            else
                $(this).html("Скрыть ветку <span class='glyphicon glyphicon-chevron-down'></span>");
        }
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

            var button = selectForm.find('.btn-primary');
            button.addClass('disabled');

            jQuery.ajax({
                url: '/article/add-comment.html',
                type: 'POST',
                dataType: "html",
                data: selectForm.serialize(),
                success: function(data) {

                    if (form == '#replyComment') {

                        var id = selectForm.find('#articlecomment-id_parent').val();

                        var margin = parseInt($('#comment-' + id).attr('style').slice(13));
                        if (margin < 40)
                            margin += 8;

                        var childs = $('[data-parent = comment-' + id + ']');
                        childs.append(data);

                        $('[data-parent = comment-' + id + '] > div').last().prev().css('margin-left', margin + '%');

                        deleteForm ();
                    }
                    else {
                        $('#comments-list').append(data);
                        selectForm[0].reset();
                    }
                    button.removeClass('disabled');
                }
            });
        }
    }

    //Удаление формы комментария
    function deleteForm () {
        $('#replyComment').remove();
    }

});