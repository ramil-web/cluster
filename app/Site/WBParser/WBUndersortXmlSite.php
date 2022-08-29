<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 04.02.2020
 * Time: 0:28
 */

namespace App\Site\WBParser;


use App\Models\WBParser\WBUndersortProduct;
use Cache;
use DateTime;
use File;
use Log;
use SimpleXMLElement;

class WBUndersortXmlSite
{
    public function __construct()
    {

    }

    public function base($undersort_id)
    {
        if (!$undersort_id) {

            Log::channel('undersort_log')->critical('ERROR  - undersort_id');
            return false;
        }

        try {

            Log::channel('undersort_log')->info('Undersort XML: start running. undersort_id = ' . $undersort_id);

            $undersort_xml_path = public_path('files/undersort_xml/');

            if (!is_dir($undersort_xml_path)) {
                File::makeDirectory($undersort_xml_path, 0777, true);
            }

            $dt = new DateTime;

            /**@var $undersort \App\Models\WBParser\WBUndersort */
            $undersort = \App\Models\WBParser\WBUndersort::where('id', $undersort_id)->first();

            $xml_title = "base_err_undersort_" . $dt->format('Y_m_d__H_i_s') . ".xml";

            if ($undersort) {

                $xml_title = $undersort->getAlias();
            }

            $result_path = $undersort_xml_path . $xml_title;

            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><undersort/>');

            $xml->addAttribute('created', $dt->format('Y.m.d H:i:s'));

            $header = $xml->addChild('header');
            $header->addChild('header_barcode', 'BarCode');
            $header->addChild('header_art', 'Артикул');
            $header->addChild('header_wbid', 'wbId');
            $header->addChild('header_size', 'Размер');
            $header->addChild('header_stok', 'Склад');
            $header->addChild('header_estimated_balance', 'Расчетный остаток(a1)');
            $header->addChild('header_days_on_site', 'Кол.во дней на сайте(б\п)(a2)');
            $header->addChild('header_orders', 'Заказы за (б\п)(a3)');
            $header->addChild('header_sales', 'Продажи за (б\п)(a4)');
            $header->addChild('header_orders_divide_days_on_site', '(a3)/(a2)=(a5)');
            $header->addChild('header_orders_last_year', 'Заказы за год');
            $header->addChild('header_sales_last_year', 'Продажи за год');
            $header->addChild('header_conversion', 'Конверсия');
            $header->addChild('header_product_need', 'Потребность в товаре(a10)');
            $header->addChild('header_undersort_count', 'Товар к подсортировке(a10)-(a1)');


            /**@var $undersort_products WBUndersortProduct []| \Illuminate\Support\Collection | bool*/
            $undersort_products = WBUndersortProduct::where('undersort_id', $undersort_id)->orderByDesc('days_on_site')->get();

            $table = $xml->addChild('table');

            foreach ($undersort_products as $undersort_product) {

                $product = $table->addChild('wb_product');
                $product->addChild('barcode', $undersort_product->getBarcode());
                $product->addChild('art', htmlspecialchars($undersort_product->getSupplierArticle()));
                $product->addChild('wbid', $undersort_product->getNmId());
                $product->addChild('size', $undersort_product->getTechSize());
                $product->addChild('stock', $undersort_product->getWarehouseName());
                $product->addChild('estimated_balance', $undersort_product->getEstimatedBalance());
                $product->addChild('days_on_site', $undersort_product->getDaysOnSite());
                $product->addChild('orders', $undersort_product->getOrders());
                $product->addChild('sales', $undersort_product->getSales());
                $product->addChild('orders_divide_days_on_site', $undersort_product->getOrdersDivideDaysOnSite());
                $product->addChild('conversion', $undersort_product->getConversion());
                $product->addChild('orders_last_year', $undersort_product->getOrdersLastYear());
                $product->addChild('sales_last_year', $undersort_product->getSalesLastYear());
                $product->addChild('product_need', $undersort_product->getProductNeed());
                $product->addChild('undersort_count', $undersort_product->getUndersortCount());
            }

            $xml->asXML($result_path);

            Cache::forget('undersort_xml_running');

            Log::channel('undersort_log')->info('Undersort XML: end running. undersort_id = ' . $undersort_id);

            $aaa = 0;

        } catch (\Exception $ex) {

            Cache::forget('undersort_xml_running');

            Log::channel('undersort_log')->critical('Ошибка undersort_xml_running - ' . $ex->getFile() . ' - ' . $ex->getLine() . ' - ' . $ex->getMessage());
            throw $ex;
        }
    }
}