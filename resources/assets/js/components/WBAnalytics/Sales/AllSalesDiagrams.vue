<template>
    <div class="row ">
        <div class="col-md-12">
            <h2>{{ title }}</h2>
            <wb_sales_diagram_by_range_vue :wb_sales="wb_sales"></wb_sales_diagram_by_range_vue>
        </div>

        <div class="col-md-12">

            <div id="all_sales_diagram" class=""></div>

        </div>
    </div>
</template>

<script>
    //https://antv.alipay.com/zh-cn/g2/3.x/tutorial/attr.html
    // Tooltip: htmlContent  https://github.com/antvis/component/issues/50
    export default {
        name      : 'AllSalesDiagrams',
        props     : {
            wb_sales: {},
            ratio   : {
                default: false
            },
        },
        data() {
            return {
                block_width : 600,
                block_height: 400,
                title       : '',
            }
        },
        mounted() {
            let self = this;

//            console.log('wb_sales - ', self.wb_sales);
            self.getTitle();
            const data = self.wb_sales;

            const chart = new G2.Chart({
                container: 'all_sales_diagram',
                forceFit : true,
                height   : 500
            });
            chart.source(data);
            chart.scale('count', {
                min: 0
            });
            chart.scale('year', {
                range: [0, 1]
            });
            chart.tooltip({
                useHtml    : true,
                htmlContent: function (title, items) {

                    let orders_count = false,
                        count        = false,
                        sail_sum     = false;

                    $.each(items, function (index, item) {

                        if (item.name === 'orders_count') {
                            orders_count = item;
                        }else if (item.name === 'count'){
                            count = item;
                        }else if (item.name === 'sail_sum'){
                            sail_sum = item;
                        }

                    });

                    let msg = '<div class="g2-tooltip" style="visibility: visible;position: absolute;border: 1px solid #efefef; color:#000;padding: 5px 15px;opacity: 0.9; background: white; "transition":top 200ms, left 200ms;>' +
                        '<div class="g2-tooltip-title" style="margin:10px 0;">' + title + '</div>' +
                        '<ul class="g2-tooltip-list">';

                    if (orders_count) {
                        msg += '<li>Кол-во заказов : ' + orders_count.value + 'шт.</li>'
                    }
                    if (count) {
                        msg += '<li>Кол-во продаж : ' + count.value + 'шт.</li>'
                    }
                    if (sail_sum) {
                        msg += '<li>Сумма : ' + sail_sum.value + 'руб.</li>'
                    }

                    msg += '</ul></div>';

                    return msg;
                },
                crosshairs : {
                    type: 'line'
                }
            });

            chart.line()
                .position('year*orders_count')
                .color('#3f8fc2')
                .label('year*orders_count', (year, orders_count) => {
                    return orders_count;
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
                .position('year*count')
                .color('#c21930')
                .label('year*count', (year, count) => {
                    return count;
                }, {
                    textStyle: {
                        fill      : '#7f0713',
                        fontSize  : 11,
                        stroke    : 'white',
                        lineWidth : 5,
                        fontWeight: 500
                    }
                })
                .style({
                    stroke   : '#fff',
                    lineWidth: 1
                })
            ;

            chart.line()
                .position('year*sail_sum')
                .color('#2fc25b')
                .label('year*sail_sum', (year, sail_sum) => {
                    return sail_sum;
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

                    if (value === 'count') {
                        title = 'Кол-во продаж';

                    } else if (value === 'orders_count') {

                        title = 'Кол-во заказов';
                    } else if (value === 'sail_sum') {

                        title = 'Сумма';
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
        components: {},

        methods: {
            getTitle(){
              let self = this;
            for(let sale of self.wb_sales){
                      self.title = sale.title;
              }

            },
            test() {
                let self = this;
            }
        },
    }
</script>
