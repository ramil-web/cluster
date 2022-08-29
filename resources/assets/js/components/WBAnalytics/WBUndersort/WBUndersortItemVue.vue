<template>
    <div class="" style="margin-top: 20px">
        <div class="row">

            <div class="col-md-12">
                <vue-good-table
                        :columns="columns"
                        :rows="undersort_products"
                        max-height="700px"
                        :fixed-header="true"
                        :line-numbers="true"
                        :row-style-class="rowStyleClassFn"
                        :search-options=search_options
                        :pagination-options=pagination_options

                >

                    <template slot="table-row" slot-scope="props">

                        <span v-if="props.column.field == 'nmId'">
                          <a :href="'https://www.wildberries.ru/catalog/' + props.row.nmId + '/detail.aspx?targetUrl='"
                             target="_blank">{{props.row.nmId}}</a>
                        </span>

                        <span v-else>
                          {{props.formattedRow[props.column.field]}}
                        </span>

                    </template>

                </vue-good-table>
            </div>

        </div>
    </div>
</template>


<script>
    // https://xaksis.github.io/vue-good-table/guide/#basic-example

    export default {
        name      : 'WBUndersortItemVue',
        props     : {
            undersort_products: {},
        },
        data() {
            return {
                search_options: {
                    enabled       : true,
                    trigger       : '',
                    skipDiacritics: false,
                    placeholder   : 'Поиск',
//                    searchFn      : mySearchFn,
//                    externalQuery : searchQuery
                },

                pagination_options: {
                    enabled         : true,
                    mode            : 'pages',
                    perPage         : 50,
                    position        : 'top',
                    perPageDropdown : [100, 300, 500, 1000],
                    dropdownAllowAll: true,
//                    setCurrentPage: 2,
                    nextLabel       : '',
                    prevLabel       : '',
                    rowsPerPageLabel: 'Строк',
                    ofLabel         : 'из',
                    pageLabel       : 'Страница', // for 'pages' mode
                    allLabel        : 'Все',
                },
                columns           : [
                    {
                        field   : 'nmId',
                        label   : 'WB',
                        type    : 'number',
                        width   : '30px',
                    },
                    {
                        field: 'barcode',
                        label: 'Штрих-код',
                        type : 'number',
                    },
                    {
                        field: 'techSize',
                        label: 'Размер',
                        width: '50px',
                    },
                    {
                        field: 'conversion',
                        label: 'Конв (год)',
                        type : 'number',
                    },
                    {
                        field: 'estimated_balance',
                        label: 'Остаток',
                        type : 'number',
                    },
                    {
                        field: 'days_on_site',
                        label: 'Дней на сайте(б.п)',
                        type : 'number',
                    },
                    {
                        field: 'orders',
                        label: 'Заказы за (б.п)',
                        type : 'number',
                    },
                    {
                        field: 'sales',
                        label: 'Продажи за (б.п)',
                        type : 'number',
                    },
                    {
                        field: 'orders_last_year',
                        label: 'Заказы за год',
                        type : 'number',
                    },
                    {
                        field: 'sales_last_year',
                        label: 'Продажи за год',
                        type : 'number',
                    },
                    {
                        field: 'product_need',
                        label: 'Потр.',
                        type : 'number',
                    },
                    {
                        field: 'undersort_count',
                        label: 'Подсорт',
                        type : 'number',
                    },
                ],
            }
        },
        mounted() {
            console.log('undersort_products ', this.undersort_products);


        },
        components: {},
        methods   : {
            rowStyleClassFn(row) {
                return row.undersort_count > 0 ? 'green' : 'red';
            },
            formatFn: function (value) {
                return '<small>' + value + '</small>';
            }
        },
    }
</script>
