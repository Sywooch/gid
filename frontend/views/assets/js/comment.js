$(function () {

    //Нажатие на "Ответить"
    $("body").on('click', ".reply", function () {
        $('#replyComment').remove();
        var form = $('#newCommentForm').clone().attr('id', 'replyComment');
        var parent = $(this).parent().parent().parent().attr('id').slice(8);
        form.find('#articlecomment-id_parent').val(parent);
        $(this).after(form);
    });
    //Отправка комментария
    $('#newCommentForm, #replyComment').on('beforeSubmit', function () {

        jQuery.ajax({
            url: '/article/add-comment.html',
            type: 'POST',
            dataType: "html",
            data: $(this).serialize(),
            success: function(data) {
                $('#comments-list').append(data);
            }
        });

        return false;
    });



    //Валидация
    $('#replyComment').yiiActiveForm({
        'id': "articlecomment-text",
        'name': "text",
        'container': ".field-articlecomment-text",
        'input': "#articlecomment-text",
        'error': ".help-block.help-block-error",
        "validate": function (attribute, value, messages) {
            yii.validation.required(value, messages, {
                "message": "Необходимо заполнить «Текст».",
                "skipOnEmpty": 1
            });
        }
    });


});