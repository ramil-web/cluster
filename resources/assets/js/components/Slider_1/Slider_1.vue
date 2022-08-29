<template>
    <div class="well">

        <strong style="color: red; display: block;" v-if="slider_images.length <= 3">Слайдер не активен. Меньше 4 фото!!!</strong>
        <!--{{slider_images}}-->

        <!-- Slider main container -->
        <div class="swiper-container"
             :id="slider_id"
             :style="slider_size()"
             v-show="slider_images.length > 3">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                <template v-for="img in slider_images">

                    <div class="swiper-slide">
                        <img :src="img.src"
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
</template>


<script>

    //https://github.com/nolimits4web/Swiper
    require('./libs/slider/swiper.min');

    export default {
        name: 'slider_1',
        props: {
            block : {},
            slidesPerGroup : {
                default: 3
            },
            slidesPerView : {
                default: 3
            },
        },
        data () {
            return {
                image_width:  this.block.width ? this.block.width : 230,
                image_height: this.block.height ? this.block.height : 160,

                slider_id: 'slider_id_' + this.block.id,
                slider_images: this.block.block_slider_images,

                swiper: false,
            }
        },

        created: function () {},
        mounted() {
            let self = this;
            if (this.slider_images.length >= 3) {

                this.swiper = new Swiper('#' + this.slider_id, {
                    // Optional parameters
                    loop: true,

                    pagination: '.swiper-pagination',
                    slidesPerView: self.slidesPerView,
                    slidesPerGroup: self.slidesPerGroup,
                    paginationClickable: true,
//                        spaceBetween: 30,

                    // Navigation arrows
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',

                    // And if we need scrollbar
//            scrollbar: '.swiper-scrollbar',
                });
            }
        },
        watch: {},
        components: {},
        methods: {

            image_size() {
                return {
                    width: this.image_width + 'px',
                    height: this.image_height + 'px',
                }
            },
            slider_size() {
                return {
                    width: '98%',
                    height: (parseInt(this.image_height) + 40) + 'px',
                }
            },
        }
    };
</script>

<style>
    @import "./libs/slider/swiper.min.css";
    .slider-image-wrap
    {
        padding: 10px;
        float: left;
        list-style: none;
    }
    .slider-image-wrap img
    {
        border: 1px solid #000;
    }

    .swiper-slide>img {
        margin: auto;
        display: block;
    }
</style>