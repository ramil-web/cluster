/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');
import 'jquery-ui';
import 'jquery-ui/ui/widgets/sortable.js';
window.Laravel = {csrfToken: $('meta[name=csrf-token]').attr("content")};

window.jQueryBridget = require('jquery-bridget');

require('./bootstrap');
/*^^^^^^^^^^^^^^^^^^^^Плагины(без npm) */
// http://www.elevateweb.co.uk/image-zoom
require('./cluster/plugins/main');
/*____________________Плагины(без npm) */

jQuery.expr[':'].icontains = function (obj, index, meta) {
    return jQuery(obj).text().toUpperCase().indexOf(meta[3].toUpperCase()) >= 0;
};

window.Vue = require('vue');


// https://github.com/Imangazaliev/DiDOM/blob/master/README-RU.md

// модуль для коммуникации между несвязанными компонентами
export const communicationBetweenComponents = new Vue();

// https://text-mask.github.io/text-mask/
// https://github.com/text-mask/text-mask/blob/master/componentDocumentation.md#mask
// https://github.com/text-mask/text-mask/tree/master/addons#emailmask
import MaskedInput from 'vue-text-mask';

Vue.component('masked-input', MaskedInput);

// https://github.com/alfhen/vue-cookie
window.VueCookie = require('vue-cookie');
Vue.use(VueCookie);

// https://github.com/vuejs/vue-router
// import VueRouter from 'vue-router';

// window.VueRouter = VueRouter;
// Vue.use(VueRouter);

// https://github.com/Mikhus/domurl
import Url from 'domurl'

//https://antv.alipay.com/zh-cn/g2/3.x/tutorial/theme.html
window.AntvG2  = require('@antv/g2');
window.DataSet = require('@antv/data-set');

//Cлайдер Swiper
// https://idangero.us/swiper/
window.Swiper = require('swiper/dist/js/swiper');

/*^^^^^^^^^^^^^^^^^^^^МОБ МЕНЮ(ТЕСТ) */
// https://github.com/hammerjs/hammer.js/
// http://hammerjs.github.io/getting-started/
window.Hammer = require('hammerjs');
/*____________________МОБ МЕНЮ(ТЕСТ) */

//Ретактор Summernote
// https://summernote.org/
window.Summernote = require('summernote/dist/summernote');

/*^^^^^^^^^^^^^^^^^^^^Сводная таблица */
// https://qna.habr.com/q/683544
// https://github.com/nicolaskruchten/pivottable/

import 'pivottable';
require('pivottable/dist/export_renderers.js');
require('pivottable/dist/pivot.ru.js');
/*____________________Сводная таблица */

/*^^^^^^^^^^^^^^^^^^^^bootstrap-table */
// https://examples.bootstrap-table.com/#
import BootstrapTable from 'bootstrap-table';

// BootstrapTable.bootstrapVersion = 3; Не разобрался как по нормальному изменить версию bootstrap, изменил в(node_modules/bootstrap-table/dist/bootstrap-table.min.js) var Ro=3
require('bootstrap-table/dist/bootstrap-table-locale-all.min.js');
/*____________________bootstrap-table */

/*^^^^^^^^^^^^^^^^^^^^Vue-good-table */
import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);
/*____________________Vue-good-table */

/*^^^^^^^^^^^^^^^^^^^^DateTimePicker */
// https://github.com/mengxiong10/vue2-datepicker
// https://mengxiong10.github.io/vue2-datepicker/demo/index.html
import DatePicker from 'vue2-datepicker'
Vue.use(DatePicker);
/*____________________DateTimePicker */


/*<<<<<<<<<<<<<<<START - Валидатор >>>>>>>>>>>>>>>>*/
//https://baianat.github.io/vee-validate/
import ru from './cluster/localization/validation/ru';
import VeeValidate, {Validator} from 'vee-validate';


Validator.localize('ru', ru);

Validator.extend('phone_1', {
    getMessage: field => 'Допустимы только цифры.',
    validate  : function (value) {
        if (Array.isArray(value)) {
            return value.every(function (val) {
                return /^[0-9]+$/.test(String(val));
            });
        }
        return /^[0-9]+$/.test(String(value));
    }
});

window.VeeValidate = VeeValidate;
Vue.use(VeeValidate);
/*<<<<<<<<<<<<<<<END -  Валидатор >>>>>>>>>>>>>>>>*/
/*^^^^^^^^^^^^^^^^^^^^Notification */
//https://github.com/CodeSeven/toastr
window.toastr  = require('toastr');
toastr.options = {
    track_action     : false,
    closeButton      : false,
    debug            : false,
    newestOnTop      : false,
    progressBar      : false,
    positionClass    : "toast-top-left",
    preventDuplicates: false,
    onclick          : null,
    showDuration     : "300",
    hideDuration     : "1000",
    timeOut          : "5000",
    extendedTimeOut  : "1000",
    showEasing       : "swing",
    hideEasing       : "linear",
    showMethod       : "fadeIn",
    hideMethod       : "fadeOut"
};

/*^^^^^^^^^^^^^^^^^^^^WBAnalytics */
Vue.component('wb_all_sales_diagrams', require('./components/WBAnalytics/Sales/AllSalesDiagrams.vue'));
Vue.component('wb_base_product', require('./components/WBAnalytics/WBBaseProduct/WBBaseProduct.vue'));
Vue.component('wb_base_product_sales', require('./components/WBAnalytics/WBBaseProduct/WBBaseProductSales.vue'));
Vue.component('wb_undersort', require('./components/WBAnalytics/WBUndersort/WBUndersort.vue'));
Vue.component('wb_undersort_item', require('./components/WBAnalytics/WBUndersort/WBUndersortItem.vue'));
Vue.component('wb_undersort_item_vue', require('./components/WBAnalytics/WBUndersort/WBUndersortItemVue.vue'));
Vue.component('wb_parsing_undersort_vue', require('./components/WBAnalytics/WBParsingResult/WBParsingUndersort.vue'));
Vue.component('wb_sales_diagram_by_range_vue', require('./components/WBAnalytics/Sales/SalesDiagramsByRange.vue'));
Vue.component('wb_pivot_table', require('./components/WBAnalytics/WBPivotTable/WBPivotTable.vue'));
Vue.component('wb_analytics_table', require('./components/WBAnalytics/WBAnalyticsTable/WBAnalyticsTable.vue'));
Vue.component('wb_rivals', require('./components/WBAnalytics/WBRivals/WBRivals.vue'));
Vue.component('wb_date_range_vue', require('./components/WBAnalytics/DateRangeVue/DateRangeVue.vue'));
/*____________________WBAnalytics */

/*^^^^^^^^^^^^^^^^^^^^ФОРМЫ */
/*^^^^^^^^^^^^^^^^^^^^Компоненты форм */
/*^^^^^^^^^^^^^^^^^^^^INPUT */
Vue.component('input_component', require('./components/Forms/Components/Input/Input.vue'));
/*____________________INPUT */
/*^^^^^^^^^^^^^^^^^^^^TEXTAREA */
Vue.component('textarea_component', require('./components/Forms/Components/Textarea/Textarea.vue'));
/*____________________TEXTAREA */
/*^^^^^^^^^^^^^^^^^^^^SELECT */
// https://vue-multiselect.js.org/
window.VueMultiselect = require('vue-multiselect');

Vue.component('multiselect', window.VueMultiselect.default);
Vue.component('select_component', require('./components/Forms/Components/Select/Select.vue'));
/*____________________SELECT */
/*^^^^^^^^^^^^^^^^^^^^CHECKBOX */
Vue.component('checkbox_component', require('./components/Forms/Components/Checkbox/Checkbox.vue'));
/*____________________CHECKBOX */
/*____________________Компоненты форм */


/*^^^^^^^^^^^^^^^^^^^^GoogleMap */
Vue.component('google-map', require('./components/GoogleMap/GoogleMap.vue'));
/*____________________GoogleMap */

/*<<<<<<<<<<<<<<<START - PAGE-BLOCKS >>>>>>>>>>>>>>>>*/
Vue.component('page-blocks-constructor', require('./components/blocks/MainPageBlocks.vue'));
Vue.component('page-blocks-list', require('./components/blocks/ListPageBlocks.vue'));
Vue.component('slider-1', require('./components/Slider_1/Slider_1.vue'));
Vue.component('big-slider', require('./components/Sliders/BigSlider/BigSlider.vue'));


Vue.component('test_wb', require('./components/Test/TestWB.vue'));


if ($('#big_slider_wrap').length) {
    const big_slider_wrap = new Vue({
        el: '#big_slider_wrap'
    });
}

if ($('#main_blocks_wrap').length) {
    const main_blocks_wrap = new Vue({
        el: '#main_blocks_wrap'
    });
}

if ($('#main_content_wrapper').length) {
    const main_content_wrapper = new Vue({
        el: '#main_content_wrapper'
    });
}
/*<<<<<<<<<<<<<<<END -  PAGE-BLOCKS >>>>>>>>>>>>>>>>*/


/*^^^^^^^^^^^^^^^^^^^^PhotoSwipe Gallery */
Vue.component('photo-swipe-gallery', require('./components/PhotoGallery/PhotoSwipe/PhotoSwipe.vue'));
if ($('#photo_gallery').length) {
    const photo_gallery = new Vue({
        el: '#photo_gallery'
    });
}
/*____________________PhotoSwipe Gallery */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//
//const app = new Vue({
//    el: '#app'
//});
