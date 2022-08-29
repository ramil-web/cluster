jQuery.expr[':'].icontains = function (obj, index, meta) {
    return jQuery(obj).text().toUpperCase().indexOf(meta[3].toUpperCase()) >= 0;
};

function initGoogleMap() {
    console.log('Map init');
    $('body').trigger('googleMapInit')
}

$(document).ready(function () {

    //Транслитерация названий
    (function () {

        $('body').on('click', '.js-translit-btn', function () {
            let form  = $(this).parents('form'),
                title = form.find('.js-translit-title'),
                alias = form.find('.js-translit-alias');

            // Символ, на который будут заменяться все спецсимволы
            let space = '_';
            // Значение из нужного поля переводим в нижний регистр
            let text = title.val().toLowerCase();

            // Массив для транслитерации
            let transl = {
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
                'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
                'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
                'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space, 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
                ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
                '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
                '(': space, ')': space, '-': space, '\=': space, '+': space, '[': space,
                ']': space, '\\': space, '|': space, '/': space, '.': '', ',': '',
                '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
                '?': space, '<': space, '>': space, '№': space, '«': '', '»': ''
            };
            let result = '';
            let curent_sim = '';

            for (i = 0; i < text.length; i++) {
                // Если символ найден в массиве то меняем его
                if (transl[text[i]] != undefined) {
                    if (curent_sim != transl[text[i]] || curent_sim != space) {
                        result += transl[text[i]];
                        curent_sim = transl[text[i]];
                    }
                }
                // Если нет, то оставляем так как есть
                else {
                    result += text[i];
                    curent_sim = text[i];
                }
            }

            result = $.trim(result);

            // Выводим результат
            alias.val(result);
        });
    }());

    //Выбор иконки, поиск иконок
    (function () {

        $('body').on('click', '.js-icon-btn', function () {
            let id     = $(this).attr('data-id'),
                image  = $(this).attr('data-image'),
                target = $('#icon_target'),
                input  = $('#icon_id');

            target.attr('src', image);
            input.val(id);

        });

        $('#icons_search').on('change keyup click', function () {
            let text = $.trim($(this).val());
            
            console.log('ssssssssssss');

            $(".icon-button").addClass('hidden');
            $(".icon-button:icontains('" + text + "')").removeClass('hidden');
        });

    }());

});
