<template>
    <div class="">

        <div class="panel panel-primary">
            <div class="panel-heading">Бренды</div>
            <div class="panel-body">

                <div class="row">

                    <div class="col-md-6">
                        <select_component :input_options="inputs.rivals_brands_list"></select_component>
                    </div>
                    <div class="col-md-6" style="padding-top: 30px;">
                        <a :href="link.href" id="rivals_brands_btn">
                            <button class="btn btn-block"
                                    :class="{ 'btn-success': link.active, 'btn-warning': !link.active }">
                                {{link.title}}
                            </button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <small>
                            *Бреды которые парсятся по всем(100) страницам - <b>Rose&Petal, Infinity Lingerie, Vis-a-vis, CONTE Elegant, Incanto, Dea Fiori, Дефиле, Teyli, FELINA, ROSME</b>.
                        </small>
                    </div>
                </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div v-if="!current_brand" >
                    <w-b-rivals-date-picker></w-b-rivals-date-picker>
                </div>
                <div v-else>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import WBRivalsDatePicker from "./WBRivalsDatePicker";
    export default {
        name      : 'WBRivalsOptions',
        props     : {
            rivals_brands: {},
            current_brand:{},
        },
        data() {
            return {
                link: {
                    title : "Бренд не выбран",
                    href  : "/rivals",
                    active: false,
                },

                inputs: {
                    rivals_brands_list: {
                        rules       : '',   //
                        label       : 'Бренды (' + this.rivals_brands.length + 'шт.)',   //
                        vv_as       : 'Бренды',   //
                        placeholder : 'Бренды',   //
                        id          : 'brands_select_' + Math.floor(Math.random() * 1000000),  //
                        vmodel      : '',
                        name        : 'brands_select_' + Math.floor(Math.random() * 1000000),
                        select_items: this.rivals_brands,
                    },
                }
            };
        },
        mounted() {
            let self = this;

//            console.log('Component rivals_brands ', self.rivals_brands)
        },
        components: {WBRivalsDatePicker},
        watch     : {
            'inputs.rivals_brands_list.vmodel': {
                handler: function (val, oldVal) {
                    let self = this;

                    self.link.href   = self.link.href + '?brand=' + encodeURI(val.title);
                    self.link.title  = "Выборка по бренду - " + val.title;
                    self.link.active = true;

                    $("#rivals_brands_btn").focus();
                    },
                deep   : true
            },
        },
        methods   : {
            onEnter() {
                let self = this;

//                window.location.href = '/user/bookmarks/' + val;

                return true;
            },
        },
    }
</script>
