<template>
    <div class="gallery-item-wrap">
        <a href="javascript:void(0);"
           class="gallery-item"
           v-if="gallery_list.length"
           @click="init_gallery">
            
            <span class="icon"></span>

            <h3>{{gallery.name}}</h3>
            <p>
                {{gallery.short_text}}
            </p>
        </a>
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div :id="gallery_id" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe. 
                 It's a separate element, as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                <div class="pswp__container">
                    <!-- don't modify these 3 pswp__item elements, data is added later on -->
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">

                    <div class="pswp__top-bar">

                        <!--  Controls are self-explanatory. Order can be changed. -->

                        <div class="pswp__counter"></div>

                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                        <button class="pswp__button pswp__button--share" title="Share"></button>

                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>

                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>

                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>


<script>
    // http://photoswipe.com/documentation/getting-started.html
    window.PhotoSwipe           = require('photoswipe');
    window.PhotoSwipeUI_Default = require('photoswipe/dist/photoswipe-ui-default.js');

    export default {
        name    : 'photo-swipe-gallery',
        props   : {
            gallery : {}
        },
        data () {
            return {
                gallery_list      : this.gallery.blocks_list,
                gallery_id        : 'photo_swipe_' + this.gallery.id,
                photo_swipe_items : [],
            }
        },
        mounted() {
            let self = this;

            $(this.gallery_list).each(function (i, element) {

                let item = {
                    src   : element.image.src,
                    w     : element.image.resize_width ? element.image.resize_width : element.image.width,
                    h     : element.image.resize_height ? element.image.resize_height : element.image.height,
                    title : element.text.content
                };

                self.photo_swipe_items.push(item);
            });
      
        },
        methods : {

            init_gallery() {
                let pswpElement = document.getElementById(this.gallery_id);
                let self        = this;

                // define options (if needed)
                let options = {
                    // history & focus options are disabled on CodePen        
                    history: false,
                    focus: false,

                    showAnimationDuration : 0,
                    hideAnimationDuration : 0

                };

                let gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, self.photo_swipe_items, options);
                gallery.init();
            },


            open_gallery() {

            },
        }
    }
</script>

<style>

    @import "~photoswipe/dist/photoswipe.css";
    @import "~photoswipe/dist/default-skin/default-skin.css";
    
    @import "libs/scss/_style.scss";
    
</style>
