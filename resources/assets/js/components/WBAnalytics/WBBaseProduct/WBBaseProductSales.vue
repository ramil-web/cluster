<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <h2>Графики товара</h2>
            </div>
        </div>

        <div class="row" v-if="sales_price_collection">
            <div class="col-md-12">
                <h4 style="font-weight: 500">
                    История продаж. Отношение цен, Наша цена(forPay)\Цена WB(finishedPrice)
                </h4>
            </div>
            <div class="col-md-12">
                <div class="diagram-wrapp" id="sales_price_diagram"></div>
            </div>
        </div>

        <div class="row" v-if="sales_by_date_collection">
            <div class="col-md-12">
                <h4 style="font-weight: 500">
                    История продаж. Кол-во продаж на дату\Цена WB(finishedPrice)
                </h4>
            </div>
            <div class="col-md-12">
                <div class="diagram-wrapp" id="sales_by_date_diagram"></div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        name      : 'WBBaseProductSales',
        props     : {
            base_product             : {},
            sales_diagram_collections: {},
        },
        data() {
            return {
                sales                   : this.base_product.wb_sales,
                sales_price_collection  : this.sales_diagram_collections.sales_price_collection,
                sales_by_date_collection: this.sales_diagram_collections.sales_by_date_collection,
            }
        },
        mounted() {
            let self = this;
//            console.log('Component mounted. - WBBaseProductSales - ', self.sales);
//            console.log('sales_diagram_collections - ', self.sales_diagram_collections);

            if (self.sales_price_collection) {
                self.sales_price_diagram_init();
            }

            if (self.sales_by_date_collection) {
                self.sales_by_date_diagram_init();
            }
        },
        components: {},
        watch     : {
            'test.vmodel': {
                handler: function (val, oldVal) {
                    let self = this;

                },
                deep   : true
            },
        },
        methods   : {
            sales_price_diagram_init() {

                let self = this;

                const chart = new G2.Chart({
                    container: 'sales_price_diagram',
                    forceFit : true,
                    height   : 450,
                    padding  : [50, 50, 150, 50],
                });
                chart.source(self.sales_price_collection.items);
                chart.scale('price_forPay', {
                    max: self.sales_price_collection.max_value,
                    min: self.sales_price_collection.min_value,
                });
                chart.scale('price_finishedPrice', {
                    max: self.sales_price_collection.max_value,
                    min: self.sales_price_collection.min_value,
                });
                chart.scale('date', {
                    range: [0, 1]
                });

                chart.tooltip({
                    htmlContent: function (title, items) {

                        let msg = '<div class="g2-tooltip" style="visibility: visible;position: absolute;border: 1px solid #efefef; color:#000;padding: 5px 15px;opacity: 0.9; background: white; "transition":top 200ms, left 200ms;>' +
                            '<div class="g2-tooltip-title" style="margin:10px 0;">' + title + '</div>' +
                            '<ul class="g2-tooltip-list">';

                        $.each(items, function (index, item) {

                            let title = ' -- ';

                            if (item.name === 'price_forPay') {

                                title = 'Наша цена(forPay)';
                            } else if (item.name === 'price_finishedPrice') {

                                title = 'Цена WB(finishedPrice)';
                            }

                            msg += '<li data-index=' + index + '>' +
                                '<span style="background-color:' + item.color + ';width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                title + ': ' +
                                '<span style="float: right">' + item.value + '₽<span>' +
                                '</li>';

                        });

                        msg += '</ul></div>';

                        return msg;
                    },
                    crosshairs : {
                        type: 'line'
                    }
                });

                chart.line()
                    .position('date*price_forPay')
                    .color('#3f8fc2')
                    .label('date*price_forPay', (date, price_forPay) => {
                        return price_forPay;
                    }, {
                        textStyle: {
                            fill      : '#1e3282',
                            fontSize  : 11,
                            stroke    : 'white',
                            lineWidth : 5,
                            fontWeight: 500
                        }
                    });

                chart.line()
                    .position('date*price_finishedPrice')
                    .color('#2fc25b')
                    .label('date*price_finishedPrice', (date, price_finishedPrice) => {
                        return price_finishedPrice;
                    }, {
                        textStyle: {
                            fill      : '#175a11',
                            fontSize  : 11,
                            stroke    : 'white',
                            lineWidth : 5,
                            fontWeight: 500
                        }
                    });

                //https://g2.antv.vision/zh/docs/manual/tutorial/legend
                chart.legend({
                    useHtml : true,
                    position: 'bottom',
                    itemTpl : (value, color, checked, index) => {

                        let title;
                        console.log('value - ', value);

                        if (value === 'price_forPay') {

                            title = 'Наша цена(forPay)';

                        } else if (value === 'price_finishedPrice') {

                            title = 'Цена WB(finished)';
                        }

                        checked = checked ? 'checked' : 'unChecked';
                        return '<tr class="g2-legend-list-item item-' + index + ' ' + checked +
                            '" data-value="' + value + '" data-color=' + color +
                            ' style="cursor: pointer;font-size: 14px;">' +
                            '<td width=150 style="border: none;padding:0;"><i class="g2-legend-marker" style="width:10px;height:10px;display:inline-block;margin-right:10px;background-color:' + color + ';"></i>' +
                            '<span class="g2-legend-text">' + title + '</span></td>' +
                            '<td style="text-align: right;border: none;padding:0;"></td>' +
                            '</tr>';
                    },
                });

                chart.render();

            },
            sales_by_date_diagram_init() {

                let self = this;

                const chart2 = new G2.Chart({
                    container: 'sales_by_date_diagram',
                    forceFit : true,
                    height   : 450,
                    padding  : [50, 50, 150, 50],
                });
                chart2.source(self.sales_by_date_collection.items);
                chart2.scale('quantity', {
                    min: 0,
                });
                chart2.scale('price_finishedPrice', {
                    min: 0
                });
                chart2.scale('date', {
                    range: [0, 1]
                });

                chart2.tooltip({
                    useHtml    : true,
                    htmlContent: function (title, items) {


                        let msg = '<div class="g2-tooltip" style="visibility: visible;position: absolute;border: 1px solid #efefef; color:#000;padding: 5px 15px;opacity: 0.9; background: white; "transition":top 200ms, left 200ms;>' +
                            '<div class="g2-tooltip-title" style="margin:10px 0;">' + title + '</div>' +
                            '<ul class="g2-tooltip-list">';

                        $.each(items, function (index, item) {

                            let title = ' -- ';

                            if (item.name === 'quantity') {

                                title = 'Кол-во продаж';
                            } else if (item.name === 'price_finishedPrice') {

                                title = 'Цена WB(finishedPrice)';
                            }

                            msg += '<li data-index=' + index + '>' +
                                '<span style="background-color:' + item.color + ';width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                title + ': ' +
                                '<span style="float: right">' + item.value + '<span>' +
                                '</li>';

                        });

                        msg += '</ul></div>';

                        return msg;
                    },
                    crosshairs : {
                        type: 'line'
                    }
                });

                chart2.line()
                    .position('date*quantity')
                    .color('#3f8fc2')
                    .label('date*quantity', (date, quantity) => {
                        return quantity;
                    }, {
                        textStyle: {
                            fill      : '#1e3282',
                            fontSize  : 11,
                            stroke    : 'white',
                            lineWidth : 5,
                            fontWeight: 500
                        }
                    });

                chart2.line()
                    .position('date*price_finishedPrice')
                    .color('#2fc25b')
                    .label('date*price_finishedPrice', (date, price_finishedPrice) => {
                        return price_finishedPrice;
                    }, {
                        textStyle: {
                            fill      : '#175a11',
                            fontSize  : 11,
                            stroke    : 'white',
                            lineWidth : 5,
                            fontWeight: 500
                        }
                    });

                //https://g2.antv.vision/zh/docs/manual/tutorial/legend
                chart2.legend({
                    useHtml : true,
                    position: 'bottom',
                    itemTpl : (value, color, checked, index) => {

                        let title;

                        if (value === 'quantity') {

                            title = 'Кол-во продаж';

                        } else if (value === 'price_finishedPrice') {

                            title = 'Цена WB(finished)';
                        }

                        checked = checked ? 'checked' : 'unChecked';
                        return '<tr class="g2-legend-list-item item-' + index + ' ' + checked +
                            '" data-value="' + value + '" data-color=' + color +
                            ' style="cursor: pointer;font-size: 14px;">' +
                            '<td width=150 style="border: none;padding:0;"><i class="g2-legend-marker" style="width:10px;height:10px;display:inline-block;margin-right:10px;background-color:' + color + ';"></i>' +
                            '<span class="g2-legend-text">' + title + '</span></td>' +
                            '<td style="text-align: right;border: none;padding:0;"></td>' +
                            '</tr>';
                    },
                });

                chart2.render();

            },
            test() {

                let self = this;

            },
        },
    }
</script>