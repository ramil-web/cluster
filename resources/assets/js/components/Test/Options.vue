<template>
    <div class="">

        <div class="panel panel-primary">
            <div class="panel-heading">Данные для выборки</div>
            <div class="panel-body">

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-12">
                        <b style="display: block; margin: 10px 0">Таблица:</b>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 10px">
                        <div class="btn-group">

                            <button class="btn btn-primary"
                                    :class="{ 'active': options.table == 'orders'}"
                                    @click="options.table = 'orders'">
                                Заказы
                            </button>
                            <button class="btn btn-primary"
                                    :class="{ 'active': options.table == 'sales'}"
                                    @click="options.table = 'sales'">
                                Продажи
                            </button>
                            <button class="btn btn-primary"
                                    :class="{ 'active': options.table == 'supplies'}"
                                    @click="options.table = 'supplies'">
                                Поставки
                            </button>
                            <button class="btn btn-primary"
                                    :class="{ 'active': options.table == 'products'}"
                                    @click="options.table = 'products'">
                                Товары
                            </button>


                        </div>
                    </div>
                </div>

                <div class="row"
                     v-if="options.table == 'orders' || options.table == 'sales' || options.table == 'supplies'">
                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">
                            Начало выборки:
                            <b class="text-danger">{{options.date_start || 'Не выбрана'}}</b>
                        </b>
                        <div class="form-group">
                            <date-picker v-model="options.date_start"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                    <div class='col-sm-6'>
                        <b style="margin-bottom: 5px; display: block;">
                            Окончание выборки:
                            <b class="text-danger">{{options.date_end || 'Не выбрана'}} </b>
                        </b>
                        <div class="form-group">
                            <date-picker v-model="options.date_end"
                                         valueType="format"
                                         format="YYYY-MM-DD"
                                         :lang="'ru'"
                                         type="date"
                                         :input-class="'form-control'"
                                         :first-day-of-week="1"></date-picker>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-12">
                        <b style="display: block; margin: 10px 0">Количество строк:</b>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 10px">
                        <div class="btn-group">

                            <button class="btn btn-primary"
                                    :class="{ 'active': options.items_limit == 5000}"
                                    @click="options.items_limit = 5000">
                                5000
                            </button>
                            <button class="btn btn-primary"
                                    :class="{ 'active': options.items_limit == 100000}"
                                    @click="options.items_limit = 'all'">
                                Все(макс = 100000)
                            </button>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" v-if="current_url">

                        <a :href="current_url">
                            <button class="btn btn-primary btn-block">
                                Загрузить
                            </button>
                        </a>

                    </div>
                </div>

            </div>
        </div>

        <h2>{{header}}</h2>

    </div>
</template>

<script>
    export default {
        name      : 'TestOptions',
        props     : {
            limit: false,
            table: false,
            block: {},
            page : {
                type   : Object,
                default: function () {
                    return {name: 'Нет страницы'}
                }
            },
        },
        data() {
            return {
                header     : 'Заказы',
                base_url   : 'test_index?',
                current_url: false,
                options    : {
                    items_limit: this.limit ? this.limit : 5000,
                    table      : this.table ? this.table : 'orders',
                    date_start : false,
                    date_end   : false,

                },
            }
        },
        mounted() {
            let self = this;

            console.log('Component mounted. - TestOptions');

            self.update_header();
        },
        components: {},
        watch     : {
            'options'      : {
                handler: function (val, oldVal) {
                    let self        = this,
                        current_url = self.current_url,
                        limit       = val.items_limit,
                        table       = val.table,
                        date_start  = val.date_start,
                        date_end    = val.date_end;

                    current_url = self.base_url;

                    if (limit) {
                        current_url += 'limit=' + limit;
                    }

                    if (date_start) {
                        current_url += '&date_start=' + date_start;
                    }

                    if (date_end) {
                        current_url += '&date_end=' + date_end;
                    }

                    if (table) {
                        current_url += '&table=' + table;
                    }

                    self.current_url = current_url;
                },
                deep   : true
            },
        },
        methods   : {
            update_header() {
                let self  = this,
                    table = self.options.table;

                if (table === 'orders') {

                    self.header = "Заказы";
                } else if (table === 'sales') {

                    self.header = "Продажи";
                } else if (table === 'supplies') {

                    self.header = "Поставки";
                } else if (table === 'products') {

                    self.header = "Товары(WB)";
                } else {
                    self.header = "Таблица не определена";
                }
            },
            test() {
                let self = this;

                return true;
            },
        },
    }
</script>
