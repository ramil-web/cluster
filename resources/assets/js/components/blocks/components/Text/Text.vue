<template>
    <div class="">
        <div :id="main_id"></div>
    </div>
</template>

<script>

    //    window.CodeMirror =   require('./libs/codemirror/lib/codemirror');
    window.summernote = require('./libs/summernote/summernote');
    require('./libs/summernote/lang/summernote-ru-RU.min');

    export default {
        props      : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
        },
        data () {
            return {
                main_id      : 'main_id_' + Math.floor(Math.random() * 10000),
                content      : this.block.content,
                block_id     : this.block.id,
                page_type_id : this.block.page_type_id,
                page_id      : this.block.page_id,
                sort         : this.block.sort,
            }
        },
        watch      : {},
        computed   : {},
        mounted() {
            let self       = this,
                SaveButton = function (context) {
                    let ui     = $.summernote.ui,
                        button = ui.button({
                            className : 'editor-save-btn',
                            contents  : '<i class="fa fa-floppy-o"/> Сохранить',
                            tooltip   : 'Сохранить',
                            click     : function (button) {
                                self.saveData(button);
                            }
                        });

                    return button.render();
                };

            $('#' + self.main_id).summernote({
                lang       : 'ru-RU',
                height     : '100%',
                codemirror : {
                    theme : 'cobalt'
                },
                toolbar    : [
//                     [groupName, [list of button]]
//                    ['style', ['style']],
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['mybutton', ['save']],
                ],

                buttons     : {
                    save : SaveButton,
                },
                placeholder : 'Введите текст...',
            });

            $('#' + self.main_id).summernote('code', this.content);
            $('#' + self.main_id).on('summernote.change', function (we, contents, $editable) {
                let button = $(we.currentTarget).siblings('.note-editor').find('.editor-save-btn');

                if (button && !button.hasClass('changed')) {
                    button.addClass('changed');
                }
            });
        },
        updated    : function () {},
        components : {},
        methods    : {
            saveData($button) {

                let button = $($button.currentTarget);
                if (!button.hasClass('changed')) {
                    return;
                }

                let markupStr = $('#' + this.main_id).summernote('code');

                let self = this;
                self.toggleShadow();
                axios.post('/admin/saveTextBlock', {
                    type         : self.block.type,
                    block_id     : self.block_id,
                    page_type_id : self.page_type_id,
                    page_id      : self.page_id,
                    sort         : self.sort,
                    content      : $('#' + self.main_id).summernote('code'),
                })
                    .then(function (response) {

                        if (response.data.text_block) {
                            button.removeClass('changed');
                            self.block.content = response.data.text_block.content;
                        }
                       
                        self.toggleShadow();
                    })
                    .catch(function (error) {
                        if (error.response.status == 404) {
                        }

                        console.log(error.response.status);
                        button.removeClass('changed');
                        self.toggleShadow();
                    });
            },

            dellBlock() {
                if (confirm("Удалить блок?")) {
                    let self = this;

                    self.toggleShadow();
                    axios.post('/admin/dellTextBlock', {
                        block_id     : self.block_id,
                        page_type_id : self.page_type_id,
                        page_id      : self.page_id,
                    })
                        .then(function (response) {
                            self.deleteBlockFromList(self.block_id);
                            self.toggleShadow();
                        })
                        .catch(function (error) {
                            if (error.response.status == 404) {
                            }

                            console.log(error.response.status);
                            self.toggleShadow();
                        });
                }
            },
        }
    };
</script>


<style>
    @import "./libs/summernote/summernote.css";
    @import "./libs/codemirror/lib/codemirror.css";
    @import "./libs/codemirror/theme/cobalt.css";

    button.editor-save-btn {
        background-color : #fff;
        color            : #ccc;
    }

    button.editor-save-btn.changed {
        background-color : rgba(0, 200, 0, 0.74);
        color            : #fff;
    }
    
    .note-editing-area {
        min-height: 100px!important;
    }
</style>



