<template>
    <div class="row" id="page_blocks_wrap" :class="{ pt40: page_blocks.length == 0}">
        <div class="page_blocks_wrap-shadow" v-show="shadow"></div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success sortable-wrap-btn"
                data-toggle="modal"
                data-target="#sortModal">
            Сортировка
        </button>

        <!-- Modal -->
        <div class="modal fade" id="sortModal" tabindex="-1" data-backdrop="false" role="dialog"
             aria-labelledby="sortModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="sortModalLabel">Сортировка</h5>
                    </div>
                    <div class="modal-body">
                        <div>
                            <ul id="sortable-wrap">
                                <li class="item"
                                    :class="not_draggable"
                                    v-for="block in page_blocks"
                                    :key="block.created_at"
                                    :data-sort="block.sort">
                                    {{getSortName(block)}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12" v-for="block in page_blocks" :key="block.id" :data-sort="block.sort"
             :id="makeBlockId(block)">

            <template v-if="block.type == 'text'">
                <text_block :deleteBlockFromList="deleteBlockFromList"
                            :block="block"
                            :toggleShadow="toggleShadow"></text_block>
            </template>

            <template v-if="block.type == 'image'">
                <image_block :deleteBlockFromList="deleteBlockFromList"
                             :block="block"
                             :toggleShadow="toggleShadow"></image_block>
            </template>

            <template v-if="block.type == 'slider'">
                <slider_block :deleteBlockFromList="deleteBlockFromList"
                              :block="block"
                              :toggleShadow="toggleShadow"></slider_block>
            </template>

            <template v-if="block.type == 'image_text'">
                <image_text_block :deleteBlockFromList="deleteBlockFromList"
                                  :block="block"
                                  :toggleShadow="toggleShadow"></image_text_block>
            </template>

            <template v-if="block.type == 'slider_text'">
                <slider_text_block :deleteBlockFromList="deleteBlockFromList"
                                   :block="block"
                                   :toggleShadow="toggleShadow"></slider_text_block>
            </template>

            <template v-if="block.type == 'google_map'">
                <google_map_block :deleteBlockFromList="deleteBlockFromList"
                                  :block="block"
                                  :toggleShadow="toggleShadow"></google_map_block>
            </template>

        </div>

        <page-blocks-constructor :page="page"
                                 :page_blocks="page_blocks"
                                 :toggleShadow="toggleShadow"></page-blocks-constructor>

    </div>
</template>

<script>
    window.Sortable = require('sortablejs');

    export default {
        props      : {
            page : {
                type    : Object,
                default : function () {
                    return {name : 'Нет страницы'}
                }
            },
        },
        data () {
            return {
                shadow : false,

                page_blocks   : this.page.content_blocks,
                sortable      : {},
                not_draggable : '',

                setBlockMethod : function ($name) {
                    return 'create_' + $name;
                }
            };
        },
        components : {
            'page-blocks-constructor' : require('./MainPageBlocks.vue'),
            'image_block'             : require('./blocks/image/ImageBlock.vue'),
            'text_block'              : require('./blocks/text/TextBlock.vue'),
            'slider_block'            : require('./blocks/slider/SliderBlock.vue'),
            'image_text_block'        : require('./blocks/image_text/ImageTextBlock.vue'),
            'slider_text_block'       : require('./blocks/slider_text/SliderTextBlock.vue'),
            'google_map_block'        : require('./blocks/google_map/GoogleMap.vue'),
        },
        mounted() {

            console.log('this.page.content_blocks - ', this.page.content_blocks);

            let self      = this;
            self.sortable = Sortable.create(document.getElementById('sortable-wrap'), {
                draggable  : ".item",
                dataIdAttr : 'data-sort',
                filter     : ".not-draggable",

                onEnd : function (/**Event*/evt) {

                    let new_sortable = self.sortable.toArray();

                    console.log('new_sortable - ', new_sortable);

                    if (evt.oldIndex != evt.newIndex) {
                        self.toggleShadow();
                        axios.post('/admin/sortBlocks', {
                            new_sortable : new_sortable,
                            page_alias   : self.page.alias,
                            page_id      : self.page.page_id,
                        })
                            .then(function (response) {
                                self.toggleShadow();

                                self.page_blocks = response.data.page_blocks;
                            })
                            .catch(function (error) {
                                self.toggleShadow();
                                if (error.response.status == 404) {
                                }
                                console.log(error.response.status);
                            });
                    }
                },

            });
        },

        methods : {

            makeBlockId($block) {
                return 'block_' + $block.type + '_' + $block.id;
            },

            toggleShadow() {
                if (this.shadow) {
                    this.shadow        = false;
                    this.not_draggable = '';
                } else {
                    this.shadow        = true;
                    this.not_draggable = 'not-draggable';
                }
            },

            deleteBlockFromList($id) {
                let self         = this;
                self.page_blocks = _.filter(self.page_blocks, function (block) { return block.id != $id; });
            },

            getSortName($block) {

                let sort_name = $block.type + ' - ';

                switch ($block.type) {
                    case 'text':
                        sort_name = 'Текст - ';
                        break;
                    case 'image':
                        sort_name = 'Изображение - ';
                        break;
                    case 'slider':
                        sort_name = 'Слайдер - ';
                        break;
                    case 'image_text':
                        sort_name = 'Изо+текст - ';
                        break;
                    case 'slider_text':
                        sort_name = 'Слайдер изо+текст - ';
                        break;
                    case 'google_map':
                        sort_name = 'Карта Google - ';
                        break;

                }
                return sort_name + $block.id;
            },
        }
    };
</script>

<style lang="scss">

    #page_blocks_wrap {
        position : relative;
    }

    .page_blocks_wrap-shadow {
        position         : fixed;
        top              : 0;
        bottom           : 0;
        left             : 0;
        right            : 0;
        background-color : rgba(0, 167, 208, 0.5);
        z-index          : 100000;
    }

    #sortModal {
    }

    #sortModal .modal-dialog {
        width : 220px;
    }

    #sortable-wrap {
        width   : 100%;
        padding : 0;
        margin  : 0;
    }

    #sortable-wrap li {
        list-style       : none;
        width            : 100%;
        padding          : 5px 10px;
        margin-bottom    : 3px;
        background-color : rgba(0, 167, 208, 0.5);
        color            : #fff;
        border           : 1px solid #fff;
        border-radius    : 3px;
        cursor           : move;
    }

    #sortable-wrap li.not-draggable {
        color            : #000;
        background-color : #ccc;
        border           : 1px solid #000;
        cursor           : default;
    }

    .sortable-wrap-btn {
        position : absolute;
        right    : 17px;
        z-index  : 10;
        top      : -50px;
    }


</style>
