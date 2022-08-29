<template>
    <div class="col-sm-12" :class="{ pt40: page_blocks.length == 0}">

        <div class="page-block-buttons dropup">

            <button class="btn btn-success btn-block dropdown-toggle"
                    type="button"
                    id="blocks_dropdown"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="true">
                Добавить блок
                <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="blocks_dropdown">

                <li v-for="block_type in block_types">
                    <a href="javascript:void(0);" @click="openBlock(block_type.alias)">
                        {{ block_type.name }}
                    </a>
                </li>

            </ul>
        </div>

        <div class="modal fade" id="image_size_modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Опции блока</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Размер изображения:</label>
                            <br>
                            <div class="btn-group radio-buttons-group">
                                <label class="btn btn-default btn-on btn-sm"
                                       :class="{ active: image_size_version == 'default'}">
                                    <input type="radio"
                                           name="version"
                                           v-model="image_size_version"
                                           value="default">Заданный</label>
                                <label class="btn btn-default btn-off btn-sm"
                                       :class="{ active: image_size_version == 'free'}">
                                    <input type="radio"
                                           name="version"
                                           v-model="image_size_version"
                                           value="free">Свободный</label>
                            </div>
                        </div>

                        <div class="form-group" v-show="image_size_version == 'default'">
                            <label>Ширина:</label>
                            <input type="text"
                                   v-model="image_width"
                                   name="image_width"
                                   v-validate.initial="'required|numeric|min:2|max:4'"
                                   data-vv-as="'Ширина'"
                                   class="form-control"
                                   placeholder="Укажите ширину">
                            <small v-show="show_errors" class="help text-center text-danger">{{
                                errors.first('image_width') }}
                            </small>
                        </div>
                        <div class="form-group" v-show="image_size_version == 'default'">
                            <label>Высота:</label>
                            <input type="text"
                                   v-model="image_height"
                                   name="image_height"
                                   v-validate.initial="'required|numeric|min:2|max:4'"
                                   data-vv-as="'Высота'"
                                   class="form-control"
                                   placeholder="Укажите высоту">
                            <small v-show="show_errors" class="help text-center text-danger">{{
                                errors.first('image_height') }}
                            </small>
                        </div>

                        <div class="form-group" v-show="modal_target == 'slider_text'">
                            <label>Тип слайдера:</label>
                            <br>
                            <div class="btn-group radio-buttons-group">
                                <label class="btn btn-default btn-on btn-sm"
                                       :class="{ active: slider_text_version == 'default'}">
                                    <input type="radio" name="version" v-model="slider_text_version" value="default">Обычный</label>
                                <label class="btn btn-default btn-off btn-sm"
                                       :class="{ active: slider_text_version == 'ful_width'}">
                                    <input type="radio" name="version" v-model="slider_text_version" value="ful_width">На
                                    всю ширину</label>
                            </div>
                        </div>

                        <div class="form-group" v-show="modal_target == 'image_text'">
                            <label>Тип блока изо+текст:</label>
                            <br>
                            <div class="btn-group radio-buttons-group">
                                <label class="btn btn-default btn-on btn-sm"
                                       :class="{ active: img_text_version == 'default'}">
                                    <input type="radio" name="version" v-model="img_text_version" value="default">Обычный</label>
                                <label class="btn btn-default btn-off btn-sm"
                                       :class="{ active: img_text_version == 'team'}">
                                    <input type="radio" name="version" v-model="img_text_version"
                                           value="team">Банда</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                @click="set_image_size"
                                :class="{'active': (!errors.has('image_width') && !errors.has('image_height')) }"
                                class="btn btn-primary">
                            Добавить блок
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props      : {
            page         : {
                type    : Object,
                default : function () {
                    return {name : 'Нет страницы'}
                }
            },
            toggleShadow : {},
            page_blocks  : {},
        },
        data () {
            return {
                block_types  : this.page.block_types,
                image_width  : '',
                image_height : '',
                show_errors  : false,
                modal_target : '',

                image_size_version : 'default',

                slider_text_version : 'default',
                img_text_version    : 'default',
            };
        },
        created() {},
        watch      : {},
        mounted() {},
        components : {},
        methods    : {
            set_image_size(event) {

                let modal_block = $('#image_size_modal'),
                    target      = modal_block.attr('data-target');

                if (this.image_size_version == 'default') {
                    if (this.errors.items.length) {
                        this.show_errors = true;
                        return;
                    }
                } else {
                    this.image_width  = '';
                    this.image_height = '';
                }

                modal_block.modal('toggle');

                if (target == 'creating_image') {
                    this.create_image();
                } else if (target == 'creating_image_text') {
                    this.create_image_text();
                } else if (target == 'creating_slider_text') {
                    this.create_slider_text();
                }
            },

            create_image() {

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveImageBlock', {
                    block_id      : null,
                    page_type_id  : self.page.id,
                    page_id       : self.page.page_id,
                    resize_width  : self.image_width,
                    resize_height : self.image_height,
                    sort          : null,
                    content       : '',
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.image_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            create_text() {

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveTextBlock', {
                    block_id     : null,
                    page_type_id : self.page.id,
                    page_id      : self.page.page_id,
                    sort         : null,
                    content      : '',
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.text_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            create_slider() {

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveSliderBlock', {
                    block_id     : null,
                    page_type_id : self.page.id,
                    page_id      : self.page.page_id,
                    sort         : null,
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.slider_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            create_image_text() {

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveImageTextBlock', {
                    block_id      : null,
                    page_type_id  : self.page.id,
                    page_id       : self.page.page_id,
                    version       : self.img_text_version,
                    resize_width  : self.image_width,
                    resize_height : self.image_height,
                    sort          : null,
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.image_text_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            create_slider_text() {

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveSliderTextBlock', {
                    block_id      : null,
                    page_type_id  : self.page.id,
                    page_id       : self.page.page_id,
                    resize_width  : self.image_width,
                    version       : self.img_text_version,
                    resize_height : self.image_height,
                    sort          : null,
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.slider_text_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            create_google_map() {

                let self = this;
                self.toggleShadow();
                //Для инициализации карты
                $('body').addClass('googleMapInit');
                axios.post('/admin/saveGoogleMapBlock', {
                    block_id     : null,
                    page_type_id : self.page.id,
                    page_id      : self.page.page_id,
                    sort         : null,
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.page_blocks.push(response.data.google_map_block);
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            openBlock($alias) {
                this.modal_target = '';

                if ($alias == 'image') {
                    $('#image_size_modal').attr('data-target', 'creating_image').modal('toggle');
                }

                if ($alias == 'text') {
                    this.create_text();
                }

                if ($alias == 'slider') {
                    this.create_slider();
                }

                if ($alias == 'image_text') {
                    this.modal_target = 'image_text';
                    $('#image_size_modal').attr('data-target', 'creating_image_text').modal('toggle');
                }

                if ($alias == 'slider_text') {
                    this.modal_target = 'slider_text';
                    $('#image_size_modal').attr('data-target', 'creating_slider_text').modal('toggle');
                }

                if ($alias == 'google_map') {
                    this.create_google_map();
                }
            },
        }
    };
</script>

<style lang="scss">
    @import "libs/scss/_style.scss";
</style>
