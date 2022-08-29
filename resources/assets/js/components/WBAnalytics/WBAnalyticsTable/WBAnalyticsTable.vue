<template>
    <div class="" style="margin-top: 20px">
        <div class="row">

            <div class="col-md-12">
                <vue-good-table
                        :columns="columns"
                        :rows="wb_stock"
                        max-height="700px"
                        :fixed-header="true"
                        :line-numbers="true"
                        :row-style-class="rowStyleClassFn"
                        :search-options=search_options
                        :pagination-options=pagination_options

                >

                    <template slot="table-row" slot-scope="props">

                        <span v-if="props.column.field == 'wb_item_route'">
                          <a :href="props.row.wb_item_route"
                             target="_blank">
                              {{props.row.c_product ? props.row.c_product.full_title: props.row.subject}}
                          </a>
                        </span>

                        <span v-else-if="props.column.field == 'ps_route'">
                            <span v-if="props.row.c_product">
                                 <a :href="'http://newsite.parishop.ru/catalog/product/'+props.row.c_product.alias"
                                    target="_blank">PS-></a>
                            </span>
                            <span v-else>
                                Нет на сайте
                            </span>

                        </span>
                        <span v-else-if="props.column.field == 'wb_route'">
                          <a :href="'https://www.wildberries.ru/catalog/'+props.row.nmId+'/detail.aspx?targetUrl='"
                             target="_blank">WB-></a>
                        </span>
                        <span v-else-if="props.column.field == 'd_cat_pl'">
                          {{ props.row.d_cat_pl }}/{{ props.row.d_src_pl }}
                        </span>

                        <span v-else-if="props.column.field == 'w_cat_avg_pl'">
                          {{ props.row.w_cat_avg_pl }}/{{ props.row.w_src_avg_pl }}
                        </span>
                        <span v-else-if="props.column.field == 'w_cat_min_pl'">
                          {{ props.row.w_cat_min_pl }}/{{ props.row.w_src_min_pl }}
                            <br>
                          {{ props.row.w_cat_max_pl }}/{{ props.row.w_src_max_pl }}
                        </span>
                        <span v-else-if="props.column.field == 'w_cat_vl_prc'">
                          {{ props.row.w_cat_vl_prc }}
                            <br>
                          {{ props.row.w_src_vl_prc }}
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
    export default {
        name: 'WBAnalyticsTable',
        props: {
            wb_stock: {},
        },

        data() {
            return {
                search_options: {
                    enabled: true,
                    trigger: '',
                    skipDiacritics: false,
                    placeholder: 'Поиск',
                },
                pagination_options: {
                    enabled: true,
                    mode: 'pages',
                    perPage: 50,
                    position: 'top',
                    perPageDropdown: [100, 300, 500, 1000],
                    dropdownAllowAll: true,
                    nextLabel: '',
                    prevLabel: '',
                    rowsPerPageLabel: 'Строк',
                    ofLabel: 'из',
                    pageLabel: 'Страница', // for 'pages' mode
                    allLabel: 'Все',
                },
                columns: [
                    {
                        field: 'nmId',
                        label: 'WB ID',
                        type: 'number',
                        width: '30px',
                    },
                    {
                        field: 'supplierArticle',
                        label: 'Артикул',
                        type: 'string',
                        width: '100px',
                    },
                    {
                        field: 'wb_item_route',
                        label: 'Название',
                        type: 'string',
                    },
                    {
                        field: 'sales_count',
                        label: 'Продажи',
                        type: 'number',
                        width: '50px',
                    },
                    {
                        field: 'orders_count',
                        label: 'Заказы',
                        type: 'number',
                        width: '50px',
                    },
                    {
                        field: 'd_cat_pl',
                        label: 'Актуаль.(кат./поиск)',
                        type: 'string',
                        width: '30px',
                    },
                    {
                        field: 'w_cat_avg_pl',
                        label: 'Сред. 7д(кат./поиск)',
                        type: 'string',
                        width: '30px',
                    },

                    {
                        field: 'w_cat_min_pl',
                        label: 'Худ/Луч 7д(кат./поиск)',
                        type: 'string',
                        width: '30px',

                    },
                    {
                        field: 'w_cat_vl_prc',
                        label: 'Волатильность(кат./поиск)',
                        type: 'string',
                        width: '30px',
                    },
                    {
                        field: 'ps_route',
                        label: 'PS->',
                        type: 'number',
                        width: '50px',
                    },
                    {
                        field: 'wb_route',
                        label: 'WB->',
                        type: 'number',
                        width: '30px',
                    },
                ],
            }
        },
        mounted() {
            console.log('wb_stock ', this.wb_stock);
        },
        components: {},
        methods: {
//            rowStyleClassFn(row) {
//                return row.c_product ? 'green' : 'red';
//            },
            formatFn: function (value) {
                return '<small>' + value + '</small>';
            }
        },
    }
</script>

