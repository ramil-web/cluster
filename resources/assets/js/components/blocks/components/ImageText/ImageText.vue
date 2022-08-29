<template>
    <ul style="list-style: none; padding: 0">
        <li class="mb10" v-for="block in prepareBlock()">
            <div class="row mb10">
                <div class="col-md-5"><strong><small>Изображение</small></strong></div>
                <div class="col-md-5"><strong><small>Текст</small></strong></div>
                <div class="col-md-2"><strong><small>Опции</small></strong></div>
            </div>
            <div class="row">
                <div class="col-md-5" style="height: 200px; overflow: hidden">
                    <img :src="block.image.src" 
                         alt="" 
                         style="max-width: 100%; width: 100%; height: 100%; object-fit: cover; vertical-align: middle;"
                         data-toggle="modal"
                         :data-target="'#img_txt_' + block.image.id + '_' + block.text.id">
                </div>
                <div class="col-md-5" v-html="block.text.content || 'Нет текста'"></div>
                <div class="col-md-2">
                    <button class="btn btn-primary collapsed btn-block btn-xs"
                            data-toggle="modal"
                            :data-target="'#img_txt_' + block.image.id + '_' + block.text.id">
                        Редактировать блок</button>
                    
                    <button class="btn btn-danger btn-block btn-xs" @click="dellBlock(block)" v-show="block_list">
                        Удалить блок</button>
                </div>
            </div>

            <div class="modal container" :id="'img_txt_' + block.image.id + '_' + block.text.id">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Редактирование</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a :href="'#image_tab_' + block.image.id" data-toggle="tab">Изображение1</a></li>
                            <li><a :href="'#text_tab_' + block.text.id" data-toggle="tab">Текст</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" :id="'image_tab_' + block.image.id">
                                <div class="row">
                                    <div class="col-md-12 pt10 pb10" :key="block.id" :data-sort="block.sort"  style="background: #fff;">

                                        <image_component :deleteBlockFromList="deleteBlockFromList" :block="block.image"
                                                         :toggleShadow="toggleShadow"
                                                         :zoomable="true"
                                                         :ratio="'free'"></image_component>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" :id="'text_tab_' + block.text.id">
                                <div class="row">
                                    <div class="col-md-12 pt10 pb10" :key="block.id" :data-sort="block.sort"  style="background: #fff">

                                        <text_component :deleteBlockFromList="deleteBlockFromList" :block="block.text"
                                                        :toggleShadow="toggleShadow"></text_component>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    $(document).ready(function () {});

    export default {
        name  : 'slider_block',
        props : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
        },

        data () {
            return {
                block_list : false,
            };
        },
        components : {
            'image_component' : require('../Image/Image.vue'),
            'text_component'  : require('../Text/Text.vue'),
        },
        created    : function () {},
        mounted() {
//            console.log('block_IT - ', this.block);
        },
        watch      : {
           
        },
        methods    : {

            dellBlock($block){
                let self = this;
                
                if (confirm("Удалить блок?")) {
                    self.toggleShadow();
                    axios.post('/admin/dellImageTextBlock', {
                        block_id     : $block.id,
                        page_type_id : $block.page_type_id,
                        page_id      : $block.page_id,
                    })
                        .then(function (response) {
                            self.block.image_text_list = _.filter(self.block.image_text_list, function (block) { return block.id != $block.id; });
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
            prepareBlock(){
                if (this.block.image_text_list) {
                    
                    this.block_list = true;
                    return this.block.image_text_list;
                    
                }else{
                    return {0 : this.block};
                }            
            },
        }
    };
    
    
</script>

<style>
    
</style>