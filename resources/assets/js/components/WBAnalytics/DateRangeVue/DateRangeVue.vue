<template>
    <div class="">

        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">Начало  периода(включительно): <b class="text-danger">{{range_data.time_start || 'Не выбрана'}}</b> </b>
                        <div class="form-group">
                            <date-picker v-model="range_data.time_start"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">Окончание периода: <b class="text-danger">{{range_data.time_end || 'Не выбрана'}}</b> </b>
                        <div class="form-group">
                            <date-picker v-model="range_data.time_end"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                </div>

                <div class="row" v-if="range_data.time_start && range_data.time_end">
                    <div class="col-md-12">

                        <a :href="'/' + url + '?date_start=' + range_data.time_start + '&date_end=' + range_data.time_end">
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
        name      : 'DateRangeVue',
        props     : {
            url: {
                type     : String,
                'default': function () {
                    return 'test_index';
                }
            },
        },
        data() {
            return {
                loading  : false,
                range_data: {
                    time_start: false,
                    time_end  : false,
                },

            }
        },
        mounted() {
            console.log('Component mounted range_data')
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
        },
        methods   : {},
    }
</script>