<template>
    <div class="wrapper well">
        <h3>Блок с изображением</h3>

        <div class="now-wrapper">
            <h2>Сейчас</h2>
            <div class="img-now">
                <img id="now_img"
                        data-toggle="modal"
                        data-target="#myModal"
                        @click="croppPopup"
                        src="test_123.png" alt="" style="margin-bottom: 20px">
            </div>
        </div>

        <div class="work-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">REsize</h4>
                        </div>

                        <div class="modal-body">
                            <div class="preview-wrapper">
                                <h2>Превью</h2>
                                <div class="img-preview"></div>
                            </div>
                            <h2>Оригинал</h2>
                            <div class="original-wrapper" style="width: 560px; height: 350px; margin: auto;">

                                <img style="max-width: 100%; width: 100%" :id="test_id" src="test_12345.png" alt="vvvv">





                                <div class="docs-data hidden">
                                    <input type="text" value="628" id="dataX">
                                    <input type="text" value="190" id="dataY">
                                    <input type="text" value="329" id="dataWidth">
                                    <input type="text" value="342" id="dataHeight">
                                    <input type="text" value="0" id="dataRotate">
                                    <input type="text" value="1" id="dataScaleX">
                                    <input type="text" value="1" id="dataScaleY">
                                </div>
                            </div>
                            <input type="file" class="" :id="test_id_2" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                            <button @click="changeFn" >test ID</button>
                            <button @click="cropp" >CROPP</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>














        </div>
    </div>
</template>

<script>
    require('./libs/common');
    require('./libs/cropper');
    export default {
        name: 'app',
        props: {

            test_id : {
                default: 'test_img'
            },
            test_id_2 : {
                default: 'test_img_2'
            },
        },
        data () {
            return {}
        },
        mounted() {


            // Import image
            var $inputImage = $('#' + this.test_id_2);
            var $image = $('#' + this.test_id);
            var URL = window.URL || window.webkitURL;
            var uploadedImageType = 'image/jpeg';
            var uploadedImageURL;

            var $dataX = $('#dataX');
            var $dataY = $('#dataY');
            var $dataHeight = $('#dataHeight');
            var $dataWidth = $('#dataWidth');
            var $dataRotate = $('#dataRotate');
            var $dataScaleX = $('#dataScaleX');
            var $dataScaleY = $('#dataScaleY');


            var options = {
                aspectRatio: 16 / 9,//'free'
                preview: '.img-preview',

//                zoomable: false,//Зум картинки
//                cropBoxResizable: false,//ресайз области кропа
                dragMode: 'none',//кроп в новом месте
//                data:{
//                    x: 58,
//                    y: 78,
//                    width: 300,
//                    height: 150
//                }
            };

            $('#' + this.test_id).cropper(options);

            console.log('options - ', options);

            $inputImage.change(function () {
                var files = this.files;
                var file;

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
        components: {},
        methods: {



            croppPopup () {

                console.log('getData - ',  $('#' + this.test_id).cropper('getData', true));
            },
            changeFn () {


//                $('#' + this.test_id).cropper('setData', {
//                    x: 628,
//                    y: 190,
//                    width: 329,
//                    height: 342
//
//
//                          55.782692
//                });

                console.log('getData - ',  $('#' + this.test_id).cropper('getData', true));
            },
            cropp () {
                var self = this;

                // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
//                $('#' + this.test_id).cropper('getCroppedCanvas', {width: 100, height: 100}).toBlob(function (blob) {
                $('#' + this.test_id).cropper('getCroppedCanvas', {width: 300, height: 150}).toBlob(function (blob) {
                    var formData = new FormData();

                    formData.append('croppedImage', blob);
                    formData.append('croppedImage2', $('#'+ self.test_id_2)[0].files[0]);

                    $.ajax('upload.php', {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function () {
                            $('#now_img').attr('src', $('#now_img').attr('src').split("?")[0] + "?" + Math.random());
//                            $('#now_img').attr('src', 'test_123.png');
                            console.log('Upload success');
                        },
                        error: function () {
                            console.log('Upload error');
                        }
                    });
                });
            },

        }
    };
</script>

<style>
    @import "libs/_style.scss";
    @import "libs/cropper.css";
</style>