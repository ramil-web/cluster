<template>
    <div class="" style="margin-top: 20px">
        <div class="row">

            <div class="col-md-12">
                <vue-good-table
                        :columns="columns"
                        :rows="rivals_items"
                        max-height="700px"
                        :fixed-header="true"
                        :line-numbers="true"
                        row-style-class="rivals-item"
                        :row-style-class="rowStyleClassFn"
                        :search-options=search_options
                        :pagination-options=pagination_options
                >
                    <template slot="table-row" slot-scope="props">
                        <span v-if="props.column.field === 'nmId'">
                           <a :href="'https://www.wildberries.ru/catalog/' + props.row.nmId + '/detail.aspx?targetUrl='"
                                   target="_blank" style="margin-left: -10px!important"><small>{{props.row.nmId}}</small>
                           </a>
                            <button class="btn btn-small rivals-item-btn"
                                    title="Только этот ID"
                                    @click="remote_items($event, props.row.nmId)"
                                    style="float: right;padding: 5px 6px;font-size: 10px;line-height: 1;margin-left: 5px">
                                +
                            </button>
                        </span>
                        <span v-else-if="props.column.field === 'sizes'" >
                           <ul v-for="size in JSON.parse(props.row.sizes)">
                                <li v-if="size.d"
                                    style="float: left; border: 1px solid #ccc;padding: 2px; background-color: rgba(194,25,48,0.15); margin-right: 3px; margin-bottom: 3px; font-size: 11px;font-weight: bold;">
                                        {{size.t}}
                                    </li>
                                    <li v-else
                                        style="float: left; border: 1px solid #ccc;padding: 2px; background-color: rgba(25,134,17,0.15); margin-right: 3px; margin-bottom: 3px; font-size: 11px;font-weight: bold;">
                                        {{size.t}}
                                  </li>
                            </ul>
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
            rivals_items: {},
            current_brand:{},
            rivals_brands:{}
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
                        label: 'Код WB',
                        type: 'number',
                        width: '110px',
                    },
                    {
                        field: 'category_place',
                        label: 'Позиция',
                        type: 'string',
                        width: '80px',
                    },
                    {
                        field: 'brand_name',
                        label: 'Бренд',
                        type: 'string',
                        width: '100px',
                    },
                    {
                        field: 'lower_price',
                        label: 'Текущая цена',
                        type: 'number',
                        width: '105px',
                    },
                    {
                        field: 'old_price',
                        label: 'Старая цена',
                        type: 'number',
                        width: '105px',
                    },
                    {
                        field: 'price_sale',
                        label: 'Скидка',
                        type: 'string',
                        width: '90px',
                    },
                    {
                        field: 'comments_count',
                        label: 'Коммент.',
                        type: 'string',
                        width: '115px',
                    },

                    {
                        field: 'stars_count',
                        label: 'Рейтинг',
                        type: 'string',
                        width: '90px',

                    },
                    {
                        field: 'sizes',
                        label: 'Размеры',
                        type: 'string',

                    },
                    {
                        field: 'parsed_at',
                        label: 'Дата парсинга',
                        type: 'number',
                        width: '180px',
                    },
                ],
            }
        },
        mounted() {
            let grid = document.querySelector('div.vgt-responsive');
            grid.classList.add('overlay');
            grid.classList.add('custom');
        },
        components: {},
        methods: {
            rowStyleClassFn(row){
                return 'rivals-item rivals-item-' + row.nmId;
            },
            remote_items(event, $nmId) {
                let self = this,
                    btn  = $(event.currentTarget);
                if (btn.hasClass('btn-primary')) {
                    $('.rivals-item').removeClass('hidden');
                    $('.rivals-item-btn').removeClass('btn-primary');

                } else {
                    $('.rivals-item').addClass('hidden');
                    $('.rivals-item-' + $nmId).removeClass('hidden').find('.rivals-item-btn').addClass('btn-primary');
                }
            },
            formatFn: function (value) {
                return '<small>' + value + '</small>';
            }
        },
    }
</script>


