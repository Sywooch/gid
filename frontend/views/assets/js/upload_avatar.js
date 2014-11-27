$(function () {

    $('#user-avatar').change(function(evt) {

        var file = evt.target.files[0];// Объект изображения

        if (file.type.match('image.*')) {// Проверка на изображение

            var img = $('.avatar');

            var reader = new FileReader();

            // Обработчик события onload  вызывается, когда файл успешно прочитан
            reader.onload = (function(img) {
                return function(e) {
                    img.attr('src', e.target.result);
                };
            })(img);

            // возвращаем содержимое файла как data URL
            reader.readAsDataURL(file);
        }

    });
});