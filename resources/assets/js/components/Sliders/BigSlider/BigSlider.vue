<template>
    <div class="">

        <strong style="color: red; display: block;" v-if="slider_count.length == 0">Слайдер не активен. Нет фото!!!</strong>
        <!--{{block.image_text_list}}-->

        <!-- Slider main container -->
        <div class="swiper-container big-slider-swiper"
             :id="slider_id"
             :style="slider_size()"
             v-show="slider_count.length > 0">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                <template v-for="block in block.image_text_list">

                    <div class="swiper-slide">
                        <img class="slider-image" :src="block.image.src" alt="">
                        <div class="slider-text"  v-html="block.text.content"></div>
                    </div>

                </template>

            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination" v-show=" block.image_text_list.length > 1"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" v-show=" block.image_text_list.length > 1"></div>
            <div class="swiper-button-next" v-show=" block.image_text_list.length > 1"></div>

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
                default: 1
            },
            slidesPerView : {
                default: 1
            },
        },
        data () {
            return {
                image_width:  this.block.width ? this.block.width : '100%',
                image_height: this.block.height ? this.block.height : 'auto',

                slider_id: 'slider_id_' + this.block.id,
                slider_count: this.block.image_text_list,

                swiper: false,
            }
        },

        created: function () {},
        mounted() {
            let self = this;
            if (this.slider_count.length >= 2) {

                this.swiper = new Swiper('#' + this.slider_id, {
                    // Optional parameters
                    loop: true,

                    autoplay: 4500,
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
                    width: '100%',
                    height: (parseInt(this.image_height) + 40) + 'px',
                }
            },
        }
    };
</script>

<style>
    @import "./libs/slider/swiper.min.css";

    .big-slider-swiper .swiper-slide {
        position: relative;
    }

    .big-slider-swiper .slider-image {
        width: 100%;
    }
    .big-slider-swiper .slider-text {
        position: absolute;
        height: 200px;
        width: 300px;
        top: 0;
        right: 25%;
        bottom: 0;
        margin: auto;
    }
    

    .big-slider-swiper .swiper-pagination-bullets{
        bottom: 30px;
    }
</style>