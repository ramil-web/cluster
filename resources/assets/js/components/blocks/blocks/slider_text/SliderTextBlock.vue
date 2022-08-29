<template>
    <div class="well">
        <h3>Блок слайдера с текстом №{{block.id}}</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div>
        <hr>

        <image_text_component :deleteBlockFromList="deleteBlockFromList" 
                              :block="block" 
                              :toggleShadow="toggleShadow">
            
        </image_text_component>

        <button class="btn btn-primary btn-block image-wrapper-btn"
                @click="addSliderItem">
            Добавить блок
        </button>
        
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
                sort                  : this.block.sort,
                block_id              : this.block.id,
            };
        },
        components : {
            'image_text_component'  : require('../../components/ImageText/ImageText.vue'),
        },
        created    : function () {},
        mounted() {
            console.log('block_ST - ', this.block);
        },
        watch      : {
           
        },
        
        methods    : {

            addSliderItem () {
                let self        = this;

                self.toggleShadow();

                axios.post('/admin/addNewSliderTextItem', {
                    block_id     : self.block_id,
                })
                    .then(function (response) {

                        if (response.data.error) {
                            console.log('Upload error = ', response.data.error);
                            return;
                        }

                        if (response.data.image_text_block) {
                            self.block.image_text_list.push(response.data.image_text_block);
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

            dellBlock() {
                let self = this;
                if (confirm("Удалить блок?")) {
                    self.toggleShadow();
                    axios.post('/admin/dellSliderTextBlock', {
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

            showChild($block) {
                console.log('block - ', $block.show);
                $block.show = true;
                console.log('block - ', $block.show);
            },
        }
    };
</script>

<style>
    @import "./libs/slider/swiper.min.css";
</style>