<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <options_component :limit="limit" :table="table"></options_component>
            </div>
            <div class="col-md-12">
                <div id="output" style="overflow: auto"></div>
            </div>
        </div>
    </div>
</template>

<script>

//    https://github.com/nicolaskruchten/pivottable/wiki/Optional-Extra-Renderers

    export default {
        name      : 'WBPivotTable',
        props     : {
            wb_stock: {},
            limit   : false,
            table   : false,
        },
        data() {
            return {}
        },
        mounted() {
            let self = this;

//            console.log('Component mounted WBPivotTable limit - ', self.wb_stock);

            let derivers = $.pivotUtilities.derivers;
            let renderers = $.extend($.pivotUtilities.locales["ru"].renderers, $.pivotUtilities.export_renderers);

            $("#output").pivotUI(
                self.get_data(),
                {
//                    derivedAttributes: {
////                        "Бренд": derivers.bin("brand"),
//                        "Бренд": function(wb_stock) {
//                            return wb_stock.brand;
//                        },
//
//                    },
//                    hiddenAttributes : ["brand"],
                    renderers: renderers,
                    derivedAttributes: {
                        "Mесяц"    : derivers.dateFormat("Дата", "%n", true),
                        "Год"      : derivers.dateFormat("Дата", "%y", true),
                        "Год/Mесяц": derivers.dateFormat("Дата", "%y-%m", true)
                    },

//                    derivedAttributes: {
////                        "Duration (months)": function(record) { return duration(record["effective_date"], record["expiration_date"]) },
////                        "Expiration in less than x months": function(record) { return date_bin_months(record, "expiration_date", 3) },
////                        "Signed x months ago": function(record) { return date_bin_months(record, "signature_date", 3) },
////                        "Started x months ago": function(record) { return date_bin_months(record, "effective_date", 3)  },
//                        "Expiration Month": derivers.dateFormat("order_at", "%m"),
//                        "Expiration Year": derivers.dateFormat("order_at", "%y"),
//                        "Expiration Year/Month": derivers.dateFormat("order_at", "%y-%m")
//                    },


                    rows: ["Бренд"],
                    cols: ["Склад"],
                },
                false,
                "ru"
            );

        },
        components: {
            'options_component': require('./WBPivotTableOptions.vue'),
        },
        methods   : {
            get_data() {
                let self = this;

                if (self.table === 'orders') {
                    return function (injectRecord) {
                        self.wb_stock.map(function (mp) {

                            injectRecord(self.get_orders_val(mp));
                        });
                    }
                } else if (self.table === 'sales') {
                    return function (injectRecord) {
                        self.wb_stock.map(function (mp) {

                            injectRecord(self.get_sales_val(mp));
                        });
                    }
                } else if (self.table === 'supplies') {
                    return function (injectRecord) {
                        self.wb_stock.map(function (mp) {

                            injectRecord(self.get_suppliess_val(mp));
                        });
                    }
                } else if (self.table === 'products') {
                    return function (injectRecord) {
                        self.wb_stock.map(function (mp) {

                            injectRecord(self.get_products_val(mp));
                        });
                    }
                } else if (self.table === 'base_products') {
                    return function (injectRecord) {
                        self.wb_stock.map(function (mp) {

                            injectRecord(self.get_base_products_val(mp));
                        });
                    }
                } else {

                    return self.wb_stock;
                }
            },

            get_orders_val(mp) {

                return {
                    "Код WB"                 : mp.nmId,
                    "Номер заказа WB"        : mp.number,
                    "Область"                : mp.oblast,
                    "Склад"                  : mp.warehouseName,
                    "Артикул"                : mp.supplierArticle,
                    "Предмет"                : mp.subject,
                    "Категория"              : mp.category,
                    "Бренд"                  : mp.brand,
                    "Количество"             : mp.quantity,
                    "Размер"                 : mp.techSize,
                    "Цена до скидки"         : mp.totalPrice,
                    "Соглас. дисконт"        : mp.discountPercent,
                    "Штрихкод"               : mp.barcode,
                    "Номер поставки"         : mp.incomeID,
                    "Уник. ID позиции заказа": mp.odid,
                    "Дата заказа"            : mp.format_date,
                    "Дата/Время заказа"      : mp.order_at,
                    "Дата обновления"        : mp.lastChangeDate,
                    "Дата"                   : mp.date,
                }
            },

            get_sales_val(mp) {

                return {
                    "Код WB"                 : mp.nmId,
                    "Номер документа"        : mp.number,
                    "Промокод"               : mp.promoCodeDiscount,
                    "Склад"                  : mp.warehouseName,
                    "Страна"                 : mp.countryName,
                    "Округ"                  : mp.oblastOkrugName,
                    "Регион"                 : mp.regionName,
                    "Артикул"                : mp.supplierArticle,
                    "Размер"                 : mp.techSize,
                    "Штрихкод"               : mp.barcode,
                    "Количество"             : mp.quantity,
                    "Нач.цена"               : mp.totalPrice,
                    "Скидка"                 : mp.discountPercent,
                    "Договор поставки"       : mp.isSupply,
                    "Договор реализации"     : mp.isRealization,
                    "Номер заказа"           : mp.orderId,
                    "Номер поставки"         : mp.incomeID,
                    "Уник. ID продажи"       : mp.saleID,
                    "Уник. ID позиции заказа": mp.odid,
                    "СПП"                    : mp.spp,
                    "Поставщику"             : mp.forPay,
                    "Факт.цена"              : mp.finishedPrice,
                    "priceWithDisc"          : mp.priceWithDisc,
                    "Предмет"                : mp.subject,
                    "Категория"              : mp.category,
                    "Бренд"                  : mp.brand,
                    "Дата Продажи"           : mp.format_date,
                    "Дата/Время Продажи"     : mp.sale_at,
                    "Дата обновления"        : mp.lastChangeDate,
                    "Дата"                   : mp.date,
                }
            },

            get_suppliess_val(mp) {

                return {
                    "Код WB"             : mp.nmId,
                    "Название склада"    : mp.warehouseName,
                    "Ваш артикул"        : mp.supplierArticle,
                    "Размер"             : mp.techSize,
                    "Количество"         : mp.quantity,
                    "Цена из УПД"        : mp.totalPrice,
                    "Номер УПД"          : mp.number,
                    "Номер поставки"     : mp.incomeId,
                    "Штрихкод"           : mp.barcode,
                    "Дата поставки"      : mp.format_date,
                    "Дата/Время поставки": mp.date,
                    "Дата обновления"    : mp.lastChangeDate,
                    "Дата закрытия"      : mp.dateClose,
                    "Дата"               : mp.date,
                }
            },

            get_products_val(mp) {

                return {
                    "Код WB"               : mp.nmId,
                    "ID(Flow)"             : mp.tvc_flow_id,
                    "Склад"                : mp.warehouseName,
                    "Артикул"              : mp.supplierArticle,
                    "Размер"               : mp.techSize,
                    "Бренд"                : mp.brand,
                    "Конверсия за год"     : mp.conversion,
                    "Кол.дост. для продажи": mp.quantity,
                    "Кол. полное"          : mp.quantityFull,
                    "Кол. не в заказе"     : mp.quantityNotInOrders,
                    "К клиенту(шт)"        : mp.inWayToClient,
                    "От клиента(шт)"       : mp.inWayFromClient,
                    "Категория"            : mp.category,
                    "Предмет"              : mp.subject,
                    "Кол. дней на сайте"   : mp.daysOnSite,
                    "Штрих-код"            : mp.barcode,
                    "Договор поставки"     : mp.isSupply,
                    "Договор реализации"   : mp.isRealization,
                    "Дата обновления"      : mp.lastChangeDate,
                    "Текущая позиция поиск": mp.search_pars_new,
                    "Старая позиция поиск" : mp.search_pars_old,
                    "Текущая позиция кат." : mp.category_pars_new,
                    "Старая позиция кат."  : mp.category_pars_old,
                    "Рейтинг(наш)"         : mp.rating,
                    "Уходящий товар"       : mp.is_outgoing_goods,
                    "Новинка"              : mp.is_new_goods,
                    "Расчетный остаток"    : mp.estimated_balance,
                }
            },

            get_base_products_val(mp) {

                return {
                    "Код WB"                  : mp.nmId,
                    "ID(Flow)"                : mp.tvc_flow_id,
                    "Артикул"                 : mp.supplierArticle,
                    "Бренд"                   : mp.brand,
                    "Категория"               : mp.category,
                    "Предмет"                 : mp.subject,
                    "Кол.заказов"             : mp.orders_count,
                    "Кол.продаж"              : mp.sales_count,
                    "Кол.дост. для продажи"   : mp.quantity,
                    "Кол.полное"              : mp.quantityFull,
                    "Кол.не в заказе"         : mp.quantityNotInOrders,
                    "В пути к клиенту(штук)"  : mp.inWayToClient,
                    "В пути от клиента(штук)" : mp.inWayFromClient,
                    "Позиция категории"       : mp.d_cat_pl,
                    "Ср.поз.категория(7дн)"   : mp.w_cat_avg_pl,
                    "Мин.поз.категория(7дн)"  : mp.w_cat_min_pl,
                    "Макс.поз.категория(7 дн)": mp.w_cat_max_pl,
                    "Волат.поз.категория(7дн)": mp.w_cat_vl_prc,
                    "Позиция поиск"           : mp.d_src_pl,
                    "Ср.поз.поиск(7дн)"       : mp.w_src_min_pl,
                    "Мин.поз.поиск (7дн)"     : mp.w_src_avg_pl,
                    "Макс.поз.поиск(7дн)"     : mp.w_src_max_pl,
                    "Волат.по поиску(7дн)"    : mp.w_src_vl_prc,
                    "Текущая цена товара"     : mp.lower_price,
                    "Старая цена товара"      : mp.old_price,
                    "Скидка на товар"         : mp.price_sale,
                    "Кол-во коммент."         : mp.comments_count,
                    "Рейтинг(WB)"             : mp.stars_count,
                }
            },

            loc() {

                return true
            },
        },
    }
</script>
