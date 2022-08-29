$(document).ready(function () {

    //Инициация редактора на textarea
    (function () {
        $('.summernote-review, .summernote-comment, .summernote-question').summernote({
            lang       : 'ru-RU',
            height     : '200',
            codemirror : {
                theme : 'cobalt'
            },
            styleTags: ['p', 'blockquote', 'h4'],
            toolbar    : [
                ['style', ['bold', 'italic', 'underline']],
            ],
            placeholder : 'Введите текст...',
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    console.log('!bufferText - ', bufferText);
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });

    }());
});
