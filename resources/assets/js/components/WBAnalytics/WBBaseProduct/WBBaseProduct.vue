<template>
    <div class="">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">

                    <div class="panel-heading">

                        <template v-if="base_product.c_product">
                            {{ base_product.c_product.full_title }}
                        </template>
                        <template v-else="">
                            {{ base_product.subject }}
                        </template>

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2" v-if="base_product.c_product && base_product.c_product.image">
                                <img :src="'http://newsite.parishop.ru/' + base_product.c_product.image"
                                     class="img-responsive"
                                     alt="">
                            </div>
                            <div class="col-md-2" v-else="">
                                <img src="/default_images/default(225_337).png"
                                     class="img-responsive"
                                     alt="">
                            </div>
                            <div class="col-md-10">
                                <table class="table table-bordered"
                                       style="font-size: 13px; font-weight: 500; margin-bottom: 0;">
                                    <tbody>
                                    <tr v-if="base_product.c_product">
                                        <td>Артикул(PS)</td>
                                        <td>
                                            {{base_product.c_product.art}}
                                            <a :href="'http://newsite.parishop.ru/catalog/product/' + base_product.c_product.alias"
                                               target="_blank">
                                                <small>ссылка PS-></small>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Артикул(WB /
                                            <small>supplierArticle</small>
                                            )
                                        </td>
                                        <td>
                                            {{base_product.supplierArticle}}
                                            <a :href="'https://www.wildberries.ru/catalog/' + base_product.nmId + '/detail.aspx?targetUrl='"
                                               target="_blank">
                                                <small>ссылка WB-></small>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID(WB /
                                            <small>nmId</small>
                                            )
                                        </td>
                                        <td>{{base_product.nmId}}</td>
                                    </tr>
                                    <tr>
                                        <td>Категория(WB /
                                            <small>category</small>
                                            )
                                        </td>
                                        <td>{{base_product.category}}</td>
                                    </tr>
                                    <tr>
                                        <td>Предмет(WB /
                                            <small>subject</small>
                                            )
                                        </td>
                                        <td>{{base_product.subject}}</td>
                                    </tr>
                                    <tr>
                                        <td>Кол-во заказов</td>
                                        <td>{{base_product.orders_count}}</td>
                                    </tr>
                                    <tr>
                                        <td>Кол-во продаж</td>
                                        <td>{{base_product.sales_count}}</td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--</tr>-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" v-for="(products_group, index) in wb_products_group_by_warehouse">
                    <div class="panel-heading">
                        Склад : {{ products_group.warehouse_name }}
                    </div>
                    <div class="panel-body">

                        <h3>
                            Текущие остатки по складу
                        </h3>
                        <table class="table table-bordered" style="font-size: 13px; font-weight: 500;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Размер<br>
                                    <small class="text-danger">techSize</small>
                                </th>
                                <th>Кол-во доступное для продажи<br>
                                    <small class="text-danger">quantity</small>
                                </th>
                                <th>Кол-во полное<br>
                                    <small class="text-danger">quantityFull</small>
                                </th>
                                <th>Кол-во не в заказе<br>
                                    <small class="text-danger">quantityNotInOrders</small>
                                </th>
                                <th>В пути к клиенту(штук)<br>
                                    <small class="text-danger">inWayToClient</small>
                                </th>
                                <th>В пути от клиента(штук)<br>
                                    <small class="text-danger">inWayFromClient</small>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in products_group.wb_products">
                                <td>{{index + 1}}</td>
                                <td>{{product.techSize}}</td>
                                <td>{{product.quantity}}</td>
                                <td>{{product.quantityFull}}</td>
                                <td>{{product.quantityNotInOrders}}</td>
                                <td>{{product.inWayToClient}}</td>
                                <td>{{product.inWayFromClient}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <template v-if="1">
                            <h3>
                                Результаты парсинга
                            </h3>
                            <wb_parsing_undersort_vue
                                    :products_group="products_group"
                                    :id="nmId">
                            </wb_parsing_undersort_vue>
                            <p>{{ products_group.title }}</p>
                            <table class="table table-bordered" style="font-size: 12px; font-weight: 500;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Дата</th>
                                    <th>Категория</th>
                                    <th>Категория<br>(позиция)</th>
                                    <th>Поиск<br>(слово)</th>
                                    <th>Поиск<br>(позиция)</th>
                                    <th>Кол-во доступное для продажи<br>
                                        <small class="text-danger">quantity</small>
                                    </th>
                                    <th>Кол-во полное<br>
                                        <small class="text-danger">quantityFull</small>
                                    </th>
                                    <th>Кол-во не в заказе<br>
                                        <small class="text-danger">quantityNotInOrders</small>
                                    </th>
                                    <th>В пути к клиенту(штук)<br>
                                        <small class="text-danger">inWayToClient</small>
                                    </th>
                                    <th>В пути от клиента(штук)<br>
                                        <small class="text-danger">inWayFromClient</small>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(parser_item, index2) in products_group.parser_collection_base">
                                    <td>{{index2 + 1}}</td>
                                    <td>{{parser_item.date_rfc3339}}</td>
                                    <td>{{parser_item.category_title}}</td>
                                    <td>{{parser_item.category_place}}</td>
                                    <td>{{parser_item.search_word}}</td>
                                    <td>{{parser_item.search_place}}</td>
                                    <td>{{parser_item.quantity}}</td>
                                    <td>{{parser_item.quantityFull}}</td>
                                    <td>{{parser_item.quantityNotInOrders}}</td>
                                    <td>{{parser_item.inWayToClient}}</td>
                                    <td>{{parser_item.inWayFromClient}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div  class="diagram-wrapp" :id="'diagram_' + products_group.id"></div>
                        </template>

                    </div>
                </div>
            </div>
        </div>

        <wb_base_product_sales :base_product="base_product"
                               :sales_diagram_collections="sales_diagram_collections"></wb_base_product_sales>

        <div class="row">
            <div class="col-md-12">

                <!--<table id="table"></table>-->

            </div>
        </div>
    </div>
</template>


<script>

    // https://bootstrap-table.com/docs/getting-started/usage/

    export default {
        name      : 'WBBaseProduct',
        props     : {
            base_product                  : {},
            wb_products_group_by_warehouse: {},
            sales_diagram_collections     : {},

        },
        data() {
            return {
                nmId: ''
            }
        },
        mounted() {
            let self = this;
//            console.log('base_product - ', self.base_product);
//            console.log('wb_products_group_by_warehouse - ', self.wb_products_group_by_warehouse);
            self.initDiagrams();

//            $('#table').bootstrapTable({
//                columns: [{
//                    field: 'id',
//                    title: 'Item ID'
//                }, {
//                    field: 'name',
//                    title: 'Item Name'
//                }, {
//                    field: 'price',
//                    title: 'Item Price'
//                }],
//                data: [{
//                    id: 1,
//                    name: 'Item 1',
//                    price: '$1'
//                }, {
//                    id: 2,
//                    name: 'Item 2',
//                    price: '$2'
//                }]
//            })
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
            initDiagrams() {
                let self = this;
                $(self.wb_products_group_by_warehouse).each(function (key, products_group) {
                    for (let product_id of products_group.wb_products) {
                        self.nmId = product_id.nmId;
                    }
                    let block_id = 'diagram_' + products_group.id;
                    const chart = new G2.Chart({
                        container: block_id,
                        forceFit : true,
                        height   : 450,
                        padding  : [50, 50, 150, 50],
                    });
                    chart.source(products_group.parser_collection);
                    chart.scale('category_place', {
                        min: products_group.min_position - 2000,
                        max: products_group.max_position,
                    });
                    chart.scale('search_place', {
                        min: products_group.min_position - 2000,
                        max: products_group.max_position,
                    });
                    chart.scale('date', {
                        range: [0, 1]
                    });

//                    chart.tooltip({
//                        showTitle: false,
//                        crosshairs: {
//                            type: 'cross'
//                        },
//                        htmlContent: (title, items) => {
//                            // debugger;
//                            let container =
//                                    '<div class="g2-tooltip" style="visibility: visible;position: absolute;border: 1px solid #efefef;'
//                                    + 'color:#000;padding: 5px 15px;opacity: 0.8; background: white; "transition":top 200ms, left 200ms; ">'
//                                    // + '<div class="g2-tooltip-title" style="margin-bottom: 4px;"></div>'
//                                    // + `${title}`
//                                    + '<ul class="g2-tooltip-list"></ul>';
//                            items.forEach((item, index) => {
//                                const color = item.color;
//                                container += '<li style="list-style:none;">'
//                                    + '<p>' + item.name + '</p>'
//                                    + '</li>';
//                            });
//                            container += '</div>';
//                            return container;
//                        },
//                    });

                    chart.tooltip({
                        htmlContent: (title, items) => {

                            let current_col = false;

                            $.each(products_group.parser_collection, function (index, collection) {
                                if (title === collection.date) {
                                    current_col = collection;

                                    return false;
                                }
                            });

                            let msg = '<div class="g2-tooltip" style="visibility: visible;position: absolute;border: 1px solid #efefef; color:#000;padding: 5px 15px;opacity: 0.9; background: white; "transition":top 200ms, left 200ms;>' +
                                '<div class="g2-tooltip-title" style="margin:10px 0;">' + title + '</div>' +
                                '<ul class="g2-tooltip-list">';

                            $.each(items, function (index, item) {

                                let title;

                                if (item.name === 'category_place') {

                                    title = 'Категория ';

                                } else if (item.name === 'search_place') {

                                    title = 'Поиск ';
                                }

                                msg += '<li data-index=' + index + '>' +
                                    '<span style="background-color:' + item.color + ';width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    title + ': ' +
                                    '<span style="float: right">' + (item.value * -1) + '<span>' +
                                    '</li>';

                            });

                            if (current_col) {

                                msg += '<li>' +
                                    '<span style="background-color: red;width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    'Кол-во доступное для продажи : ' +
                                    '<span style="float: right">' + current_col.q + '<span>' +
                                    '</li>';

                                msg += '<li>' +
                                    '<span style="background-color: red;width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    'Кол-во полное : ' +
                                    '<span style="float: right">' + current_col.qf + '<span>' +
                                    '</li>';

                                msg += '<li>' +
                                    '<span style="background-color: red;width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    'Кол-во не в заказе : ' +
                                    '<span style="float: right">' + current_col.qnio + '<span>' +
                                    '</li>';

                                msg += '<li>' +
                                    '<span style="background-color: red;width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    'В пути к клиенту(штук) : ' +
                                    '<span style="float: right">' + current_col.iwtc + '<span>' +
                                    '</li>';

                                msg += '<li>' +
                                    '<span style="background-color: red;width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:8px;"></span>' +
                                    'В пути от клиента(штук) : ' +
                                    '<span style="float: right">' + current_col.iwfc + '<span>' +
                                    '</li>';
                            }

                            msg += '</ul></div>';

                            return msg;
                        },
                        crosshairs : {
                            type: 'line'
                        }
                    });

                    chart.line()
                        .position('date*category_place')
                        .color('#3f8fc2')
                        .label('date*category_place', (date, category_place) => {
                            return category_place;
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
                        .position('date*search_place')
                        .color('#2fc25b')
                        .label('date*search_place', (date, search_place) => {
                            return search_place;
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

                            if (value === 'category_place') {

                                title = 'Категория';

                            } else if (value === 'search_place') {

                                title = 'Поиск';
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
//                 console.log('products_group2 - ', products_group);
                 });

            },
            test() {

                let self = this;

            },
        },
    }
</script>