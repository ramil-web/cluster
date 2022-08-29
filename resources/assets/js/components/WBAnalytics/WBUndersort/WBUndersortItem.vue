<template>
    <div class="">
        <div class="row">
            <!--<div class="col-md-12">-->
            <!--undersort_products-->

            <!--<div id="output"></div>-->
            <!--</div>-->

            <div class="col-md-12">
                <table id="table"></table>
            </div>

        </div>
    </div>
</template>


<script>
    // https://examples.bootstrap-table.com/#
    // https://bootstrap-table.com/docs/api/table-options/

    export default {
        name      : 'WBUndersortItem',
        props     : {
            undersort_products: {},
        },
        data() {
            return {}
        },
        mounted() {
            console.log('undersort_products ', this.undersort_products);

            $('#table').bootstrapTable({
                search                : true,
                locale                : 'ru-RU',
//                height                : 500,
                pagination            : true,
                showExtendedPagination: true,
                pageSize              : 50,
                pageList              : [50, 100, 200, 'All'],

                columns: [
                    {
                        field: 'nmId',
                        title: 'Код WB',
                    },
                    {
                        field: 'barcode',
                        title: 'Штрих-код',
                    },
                    {
                        field: 'techSize',
                        title: 'Размер',
                    },
                    {
                        field   : 'conversion',
                        title   : 'Конв <br> (год)',
                        sortable: true,
                    },
                    {
                        field   : 'estimated_balance',
                        title   : 'Остаток',
                        sortable: true,
                    },
                    {
                        field   : 'days_on_site',
                        title   : 'Дней на <br> сайте(б.п)',
                        sortable: true,
                    },
                    {
                        field   : 'orders',
                        title   : 'Заказы<br> за (б.п)',
                        sortable: true,
                    },
                    {
                        field   : 'sales',
                        title   : 'Продажи<br> за (б.п)',
                        sortable: true,
                    },
                    {
                        field   : 'orders_last_year',
                        title   : 'Заказы <br> за год',
                        sortable: true,
                    },
                    {
                        field   : 'sales_last_year',
                        title   : 'Продажи <br> за год',
                        sortable: true,
                    },
                    {
                        field   : 'product_need',
                        title   : 'Потребность',
                        sortable: true,
                    },
                    {
                        field   : 'undersort_count',
                        title   : 'Подсорт',
                        sortable: true,
                    },
                ],
                data   : this.undersort_products
            });


//            $("#output").pivot(
//                [
//                    {color: "blue", shape: "circle"},
//                    {color: "red", shape: "triangle"}
//                ],
//                {
//                    rows: ["color"],
//                    cols: ["shape"]
//                }
//            );
        },
        components: {},
        methods   : {},
    }
</script>
