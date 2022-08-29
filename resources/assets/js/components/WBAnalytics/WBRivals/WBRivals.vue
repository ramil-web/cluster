<template>
    <div class="">

        <options_component
                :rivals_brands="rivals_brands"
                :current_brand="current_brand"
        ></options_component>

        <div class="row">
            <div class="col-md-12">
                <h2>{{title}}</h2>
            </div>

            <div class="col-md-12">
                <w-b-rivals-table
                        :rivals_items="rivals_items"
                        :current_brand="current_brand"
                        :rivals_brands="rivals_brands">
                </w-b-rivals-table>
            </div>

        </div>
    </div>
</template>

<script>
    import WBRivalsTable from "./WBRivalsTable";
    export default {
        name      : 'WBRivals',
        props     : {
            rivals_brands: {},
            rivals_items : {},
            current_brand: {},
        },
        data() {
            return {
                title: '',
            }
        },
        mounted() {
            let self = this;

            if (self.current_brand) {
                self.title = "Выборка по бренду - " + self.current_brand + "(" + self.rivals_items.length + "шт.)";
            } else {
                self.title = "Выборка за весь период (первые 10 страниц) (" + self.rivals_items.length + "шт.)";
            }

            console.log('Component mounted. - ', self.rivals_items)
        },
        components: {
            WBRivalsTable,
            'options_component': require('./WBRivalsOptions.vue'),
        },
        watch     : {
            'test.item': {
                handler: function (val, oldVal) {
                    let self = this;

                },
                deep   : true
            },
        },
        methods   : {
            test($parsed_at) {
                let self = this;

                let d          = new Date($parsed_at);
                let curr_date  = d.getDate();
                let curr_month = d.getMonth() + 1;
                let curr_year  = d.getFullYear();

                return curr_year + "-" + curr_month + "-" + curr_date;
            },
        },
    }
</script>
