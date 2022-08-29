<template>
    <div class="well" :id="block_main_id">
        <h3>Блок слайдера №{{block.id}}</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div> 
        <hr>

        <div class="alert alert-danger" v-if="slider_images.length <= 3">
            <strong>Меньше 4 фото</strong>
        </div>

        <ul class="clearfix" style="padding: 0;" v-if="slider_images.length <= 3">
            <li v-for="(img, index) in slider_images" style="list-style: none; float: left;">

                <img :data-image-id="img.id"
                     :data-image-index="index"
                     :src="img.src"
                     @click="deleteImage"
                     class="slider-image-wrap">
            </li>
        </ul>

        <div class="row" style="padding-top: 30px" v-show="slider_images.length > 3">
            <!-- Slider main container -->
            <div :id="slider_id" :style="slider_size()" class="swiper-container" v-show="slider_images.length > 3">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->

                    <template v-for="(img, index) in slider_images">

                        <div class="swiper-slide">
                            <img :data-image-id="img.id"
                                 :data-image-index="index"
                                 :src="img.src"
                                 @click="deleteImage"
                                 alt="">
                        </div>

                    </template>

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <!--<div class="swiper-scrollbar"></div>-->
            </div>
        </div>

        <button class="btn btn-primary btn-block slider-wrapper-btn collapsed"
                data-toggle="collapse"
                :data-target="'#' + image_wrap_id">
            <span class="open-title">Закрыть</span>
            <span class="close-title">Добавить изображения</span>
        </button>

        <div class="collapse slider-wrapper" :id="image_wrap_id">
            <div class="row">
                <form :id="form_id" @submit.prevent>
                    <div class="form-image-wrap col-xs-6 col-md-3"
                         v-for="(file, index) in image_files_arr"
                         :key="file">

                        <div class="thumbnail">

                            <img src="/default.png"
                                 class="preview-image"
                                 alt=""
                                 @click="touchFileInput"
                                 :style="image_size()">

                            <input type="file"
                                   class="hidden file_input"
                                   @change="changeFileImage($event)"
                                   name="file"
                                   accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-12">
                        <button class="btn btn-success btn-block"
                                data-toggle="collapse"
                                :data-target="'#' + image_wrap_id"
                                :class="[{ hidden: image_files_arr.length < 2 }]"
                                @click="saveImages">Сохранить
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</template>

<script>
    //https://github.com/nolimits4web/Swiper
    require('./libs/slider/swiper.min');

    $(document).ready(function () {

    });

    export default {
        name  : 'slider_block',
        props : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
        },

        data () {
            return {

                image_files_arr       : [1],
                image_files_arr_count : 1,
                sort                  : this.block.sort,
                block_id              : this.block.id,
                image_width           : this.block.width ? this.block.width : 230,
                image_height          : this.block.height ? this.block.height : 160,
                
                image_wrap_id         : 'image_wrap_' + Math.floor(Math.random() * 10000),
                block_main_id         : 'block_' + this.block.type + '_' + this.block.id,
                slider_id             : 'slider_id_' + this.block.id,
                form_id               : 'slider_form_' + this.block.id,
                
                slider_images         : this.block.block_slider_images ? this.block.block_slider_images : [],
                swiper                : false,

            };
        },
        components : {},
        created    : function () {},
        mounted() {

            if (this.slider_images.length > 3) {
                this.swiperInit();
            }
        },
        watch      : {
            slider_images : function (val) {
                let self = this;

                if (val.length > 3) {
                    if (!this.swiper) {
                        this.swiperInit();
                    }
                    setTimeout(function () {
                        self.swiper.update();
                    }, 1000);
                }
            },
        },
        methods    : {

            image_size() {
                return {
                    width  : this.image_width + 'px',
                    height : this.image_height + 'px',
                }
            },

            slider_size() {
                return {
                    width  : '98%',
                    height : (parseInt(this.image_height) + 40) + 'px',
                }
            },

            changeFileImage (event) {

                // Import image
                let self              = this,
                    input             = event.currentTarget,
                    $input            = $(input),
                    image             = $input.siblings('.preview-image'),
                    URL               = window.URL || window.webkitURL,
                    uploadedImageType = 'image/jpeg',
                    uploadedImageURL,
                    files             = input.files,
                    file;

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        uploadedImageType = file.type;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                        }

                        uploadedImageURL = URL.createObjectURL(file);
                        image.attr('src', uploadedImageURL);

                        if (!$input.hasClass('loaded')) {
                            self.image_files_arr_count = self.image_files_arr_count + 1;
                            self.image_files_arr.unshift(self.image_files_arr_count);

                            $(input).addClass('loaded').parents('.form-image-wrap').addClass('image-loaded');
                        }

                    } else {
                        window.alert('Выберите файл.');
                    }
                }
            },

            touchFileInput () {
                let self  = this,
                    image = $(event.currentTarget);

                image.siblings('.file_input').click();
            },

            swiperInit () {

                if (!this.swiper) {

                    this.swiper = new Swiper('#' + this.slider_id, {
                        // Optional parameters
//            direction: 'vertical',
//                    loop: true,

                        pagination          : '.swiper-pagination',
                        slidesPerView       : 3,
                        slidesPerGroup      : 3,
                        paginationClickable : true,
//                        spaceBetween: 30,

                        // Navigation arrows
                        nextButton : '.swiper-button-next',
                        prevButton : '.swiper-button-prev',

                        // And if we need scrollbar
//            scrollbar: '.swiper-scrollbar',
                    });

                    this.swiper.update();
                }
            },

            saveImages () {
                let self        = this,
                    file_inputs = $('#' + this.form_id).find('.file_input.loaded'),
                    formData    = new FormData();

                self.toggleShadow();

                $(file_inputs.get().reverse()).each(function (index) {
                    let file_name = 'file_' + index;
                    formData.append(file_name, $(this)[0].files[0]);
                });

                formData.append('block_id', self.block.id);
                formData.append('page_type_id', self.block.page_type_id);
                formData.append('page_id', self.block.page_id);
                formData.append('width', self.image_width);
                formData.append('height', self.image_height);


                axios.post('/admin/sliderBlockUploadImage', formData)
                    .then(function (response) {

                        if (response.data.error) {
                            console.log('Upload error = ', response.data.error);
                            return;
                        }

                        if (response.data.image_arr) {
                            $(response.data.image_arr).each(function (index) {
                                self.slider_images.push(this);
                            });
                            self.image_files_arr_count = self.image_files_arr_count + 1;
                            self.image_files_arr       = [self.image_files_arr_count];
                        }

                        self.toggleShadow();
                    })
                    .catch(function (error) {
                        if (error.response.status == 404) {
                        }

                        console.log(error.response.status);
                        self.toggleShadow();
                    });
            },

            deleteImage() {
                let self        = this,
                    image       = $(event.currentTarget),
                    image_index = image.attr('data-image-index'),
                    image_id    = image.attr('data-image-id');

                if (confirm("Удалить фото?")) {
                    self.toggleShadow();
                    axios.post('/admin/sliderBlockDeleteImage', {
                        id : image_id,
                    })
                        .then(function (response) {

                            if (response.data.error) {
                                console.log('Delete error = ', response.data.error);
                                return;
                            }

                            if (response.data.success) {
                                self.slider_images.splice(parseInt(image_index), 1);
                            }

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

            dellBlock() {
                let self = this;
                if (confirm("Удалить блок?")) {
                    self.toggleShadow();
                    axios.post('/admin/dellSliderBlock', {
                        block_id : self.block_id,
                    })
                        .then(function (response) {
                            if (response.data.success) {
                                self.deleteBlockFromList(self.block_id);
                            }
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
    @import "./libs/slider/swiper.min.css";

    .slider-wrapper-btn {
        margin-bottom : 20px;
    }

    .slider-wrapper-btn.collapsed .open-title {
        display : none;
    }

    .slider-wrapper-btn .close-title {
        display : none;
    }

    .slider-wrapper-btn.collapsed .close-title {
        display : block;
    }

    .slider-wrapper {
        background-color : #fff;
        padding          : 10px;
    }

    .slider-image-wrap {
        padding    : 10px;
        float      : left;
        list-style : none;
    }

    .slider-image-wrap img {
        border : 1px solid #000;
    }

    .swiper-slide > img {
        margin  : auto;
        display : block;
    }
</style>