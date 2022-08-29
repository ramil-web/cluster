<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name       : 'app',
        props      : {
            block               : {},
            ratio               : {
                default : false
            },
        },
        data () {
            return {

            }
        },
        mounted() {
            let self = this;

            console.log('Component mounted. - ', self.name)
        },
        components : {},
        watch     : {
            'test.item': {
                handler: function (val, oldVal) {
                    let self = this;

                },
                deep   : true
            },
        },
        methods    : {
            test() {
                let self = this;

                return true;
            },
        },
    }
</script>
