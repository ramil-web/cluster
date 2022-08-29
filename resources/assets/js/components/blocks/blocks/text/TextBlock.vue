<template>
    <div class="well">
        <h3>Текстовый блок №{{block_id}}</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div>
        <hr>

        <text_component :deleteBlockFromList="deleteBlockFromList" :block="block"
                        :toggleShadow="toggleShadow"></text_component>

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
                block_id     : this.block.id,
                page_type_id : this.block.page_type_id,
                page_id      : this.block.page_id,
            }
        },
        components : {
            'text_component'  : require('../../components/Text/Text.vue'),
        },
        
        mounted() {},
        updated() {},
        watch      : {},
        computed   : {},
        methods    : {
            dellBlock() {
                if (confirm("Удалить блок?")) {
                    let self = this;

                    self.toggleShadow();
                    axios.post('/admin/dellTextBlock', {
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



