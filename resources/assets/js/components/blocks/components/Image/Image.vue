<template>
    <div class="">
        <div class="now-wrapper" v-show="show_image_current">
            <div class="img-current" style="overflow: auto; width: 100%; max-height: 400px;">
                <img :id="current_img_id"
                     :width="resize_width"
                     :height="resize_height"
                     @click="openCropPopup"
                     :src="block.src" alt="" style="margin-bottom: 20px">
            </div>
        </div>

        <button class="btn btn-primary btn-block image-wrapper-btn collapsed"
                @click="closeImageCurrent"
                data-toggle="collapse"
                :data-target="'#' + modal_id">
            <span class="open-title">Закрыть</span>
            <span class="close-title">Редактировать изображение</span>
        </button>

        <div class="collapse main-cropper-wrapper" :id="modal_id">
            <div class="row">
                <div class="col-md-8">
                    <h5>Оригинал</h5>

                    <div class="original-wrapper" style="width: 560px; height: 350px; margin: auto;">

                        <img style="max-width: 100%; width: 100%" :id="resize_img_id" :src="block.original_src"
                             alt="original">

                    </div>

                    <button type="button"
                            @click="touchFileInput"
                            class="btn mt10 mb10">
                        Загрузить новое изображение
                    </button>

                    <input type="file" class="hidden" :id="upload_id" name="file"
                           accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">

                </div>
                <div class="col-md-4">
                    <h5>Превью</h5>

                    <div class="preview-wrapper">
                        <div :id="preview_id" class="img-preview"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <button type="button"
                            class="btn btn-success btn-block"
                            data-toggle="collapse" :data-target="'#' + modal_id"
                            @click="cropp">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    //    require('./libs/common');
    require('./libs/cropper');
    export default {
        name       : 'app',
        props      : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
            ratio               : {
                default : false
            },
            zoomable            : {//Зум картинки
                default : true
            },
        },
        data () {
            return {
                block_id     : this.block.id,
                page_type_id : this.block.page_type_id,
                page_id      : this.block.page_id,
                sort         : this.block.sort,

                main_id        : 'main_id_' + Math.floor(Math.random() * 10000),
                modal_id       : 'modal_id_' + Math.floor(Math.random() * 10000),
                current_img_id : 'current_img_' + Math.floor(Math.random() * 10000),
                resize_img_id  : 'resize_img_id_' + Math.floor(Math.random() * 10000),
                upload_id      : 'upload_id_' + Math.floor(Math.random() * 10000),
                preview_id     : 'preview_id_' + Math.floor(Math.random() * 10000),

                resize_width  : this.block.resize_width,
                resize_height : this.block.resize_height,
                block_width   : this.block.width,
                block_height  : this.block.height,
                block_x       : this.block.x,
                block_y       : this.block.y,

                show_image_current : true,

                cropBoxResizable : this.getCropBoxResizable(),
                imageRatio       : (!this.block.resize_width && !this.block.resize_height) ? 'free' : this.ratio
            }
        },
        mounted() {

            // Import image
            let self              = this,
                $inputImage       = $('#' + this.upload_id),
                $image            = $('#' + this.resize_img_id),
                URL               = window.URL || window.webkitURL,
                uploadedImageType = 'image/jpeg',
                uploadedImageURL;

            let options = {
                preview : '#' + self.preview_id,

                zoomable         : self.zoomable,//Зум картинки
                cropBoxResizable : self.cropBoxResizable,//ресайз области кропа
                aspectRatio      : self.imageRatio ? self.imageRatio : 16 / 9,
                dragMode         : 'none',//кроп в новом месте
                data             : {
                    x      : parseInt(self.block_x),
                    y      : parseInt(self.block_y),
                    width  : parseInt(!self.cropBoxResizable ? self.resize_width : self.block_width),
                    height : parseInt(!self.cropBoxResizable ? self.resize_height : self.block_height)
                }
            };
            
            $('#' + this.resize_img_id).cropper(options);

            $inputImage.change(function () {
                let files = this.files;
                let file;

                if (!$image.data('cropper')) {
                    return;
                }

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        uploadedImageType = file.type;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                        }

                        uploadedImageURL = URL.createObjectURL(file);
                        $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
//                        $inputImage.val('');
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            });
        },
        components : {},
        methods    : {

            touchFileInput () {
                $('#' + this.upload_id).click();
            },

            openCropPopup () {
                $('#' + this.modal_id).collapse('show');
                this.show_image_current = false;
            },

            closeImageCurrent () {

                let button = $(event.currentTarget);
                if (button.hasClass('collapsed')) {
                    this.show_image_current = false;
                }else {
                    this.show_image_current = true;   
                }
            },
            
            changeFn () {
                console.log('getData - ', $('#' + this.resize_img_id).cropper('getData', true));
            },

            getCropBoxResizable(){
                //Если не установлена ширина и высота для ресайза, разрешаем ресайз области кропа                                
                if (!this.block.resize_width && !this.block.resize_height) {
                    return true;
                }
                return false;
            },

            cropp () {
                let self = this;

                self.toggleShadow();

                // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
                $('#' + this.resize_img_id).cropper('getCroppedCanvas', {
                    width  : self.resize_width,
                    height : self.resize_height
                }).toBlob(function (blob) {
                    let cropper_data = $('#' + self.resize_img_id).cropper('getData', true),
                        formData     = new FormData();

                    formData.append('type', self.block.type);
                    formData.append('block_id', self.block.id);
                    formData.append('page_type_id', self.block.page_type_id);
                    formData.append('page_id', self.block.page_id);
                    formData.append('width', cropper_data.width);
                    formData.append('height', cropper_data.height);
                    formData.append('x', cropper_data.x);
                    formData.append('y', cropper_data.y);

                    formData.append('original', $('#' + self.upload_id)[0].files[0]);
                    formData.append('cropped', blob);

                    axios.post('/admin/imageBlockUploadImage', formData)
                        .then(function (response) {

                            let curr_img = $('#' + self.current_img_id);

                            if (response.data.error) {
                                console.log('Upload error = ', response.data.error);
                                return;
                            }

                            if (response.data.image_block) {
                                self.block.src          = response.data.image_block.src + "?" + Math.random();
                                self.block.original_src = response.data.image_block.original_src;
                            }

                            $('#' + self.modal_id).collapse('hide');
                            self.show_image_current = true;
                            self.toggleShadow();
                        })
                        .catch(function (error) {
                            if (error.response.status == 404) {
                            }

                            console.log('Upload error - ', error.response.status);
                            self.toggleShadow();
                        });
                });
            },
        }
    };
</script>

<style lang="scss">
    @import "libs/_style.scss";
    @import "libs/cropper.css";

    .image-wrapper-btn.collapsed .open-title {
        display : none;
    }

    .image-wrapper-btn .close-title {
        display : none;
    }

    .image-wrapper-btn.collapsed .close-title {
        display : block;
    }

    .img-preview {
        border : 1px solid #ccc;
    }


</style>