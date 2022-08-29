<template>
    <div class="">

        <div class="panel panel-primary">
            <div class="panel-heading">Склад : {{ products_group.warehouse_name }} </div>
            <div class="panel-body">
                <div class="row">
                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">Начало  периода(включительно): <b
                                class="text-danger">{{undersort.time_start || 'Не выбрана'}}</b> </b>
                        <div class="form-group">
                            <date-picker v-model="undersort.time_start"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">Окончание  периода : <b
                                class="text-danger">{{undersort.time_end || 'Не выбрана'}}</b> </b>
                        <div class="form-group">
                            <date-picker v-model="undersort.time_end"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                </div>

                <div class="row" v-if="undersort.time_start && undersort.time_end">
                    <div class="col-md-12">

                        <a :href="'/wb/base_item/'+id+'?warehouse='+products_group.warehouse_name+'&date_start=' + undersort.time_start + '&date_end=' + undersort.time_end">
                            <button class="btn btn-primary btn-block">
                                Выборка записей по диапазону
                            </button>
                        </a>

                    </div>
                </div>

                <div class="panel panel-danger" v-else="" style="margin: 0">
                    <div class="panel-heading">Укажите даты</div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        name      : "WBParsingUndersort",
        props     : {
            products_group: {},
            id            : '',
        },
        data() {
            return {
                loading  : false,
                undersort: {
                    time_start: false,
                    time_end  : false,
                },

            }
        },
        mounted() {
        },
        components: {
            DatePicker
        },
        watch     : {
            'undersort.time_start': {
                handler: function (val, oldVal) {
                    let self = this;

                    if (val) {

                    }

                },
                deep   : true
            },
            'undersort.time_end'  : {
                handler: function (val, oldVal) {
                    let self = this;

                    if (val) {

                    }
                },
                deep   : true
            },
        },
        methods   : {
        },
    }
</script>

<style scoped>

</style>