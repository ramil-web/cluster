<template>
    <div class="well">
        <h3>Изо Текст</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div>
        <hr>
        
        <image_text_component :deleteBlockFromList="deleteBlockFromList"
                              :block="block"
                              :toggleShadow="toggleShadow">

        </image_text_component>

    </div>
</template>

<script>

    export default {
        props      : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
        },
        data () {
            return {

                block_id       : this.block.id,
                page_type_id   : this.block.page_type_id,
                page_id        : this.block.page_id,
                
                text_block  : this.block.text,
                image_block : this.block.image,
            }
        },
        components : {
            'image_text_component'  : require('../../components/ImageText/ImageText.vue'),
        },
        mounted() {
//            console.log('block_IT - ', this.block);
        },
        updated() {},
        watch      : {},
        computed   : {},
        methods    : {

            dellBlock() {
                let self = this;
                if (confirm("Удалить блок?")) {
                    self.toggleShadow();
                    axios.post('/admin/dellImageTextBlock', {
                        block_id     : self.block_id,
                        page_type_id : self.page_type_id,
                        page_id      : self.page_id,
                    })
                        .then(function (response) {
                            self.deleteBlockFromList(self.block_id);
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

</style>



