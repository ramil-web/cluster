<template>
    <div class="well">
        <h3>Блок с изображением №{{block_id}}</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div>
        <hr>
        
        <image_component :deleteBlockFromList="deleteBlockFromList" 
                         :block="block"
                         :toggleShadow="toggleShadow"></image_component>

    </div>
</template>

<script>
   
    export default {
        name       : 'app',
        props      : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
            ratio               : {
                default : false
            },
        },
        data () {
            return {
                block_id       : this.block.id,
                page_type_id   : this.block.page_type_id,
                page_id        : this.block.page_id,
            }
        },
        components : {
            'image_component' : require('../../components/Image/Image.vue'),
        },
        mounted() {},
        methods    : {

            dellBlock() {
                let self = this;
                if (confirm("Удалить блок?")) {
                    self.toggleShadow();
                    axios.post('/admin/dellImageBlock', {
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

<style lang="scss">
   
</style>