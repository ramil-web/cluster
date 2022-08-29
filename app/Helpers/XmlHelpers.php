<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 05.02.2019
 * Time: 12:33
 */

namespace App\Helpers;


use App\Models\Order\OOrder;
use App\Models\User;
use App\Site\Order\ManagerOrder\ManagerOrder;
use App\Site\Order\ManagerOrder\ManagerOrderProduct\ManagerOrderProduct;
use DateTime;
use File;
use SimpleXMLElement;

class XmlHelpers
{

    public static function write_undersort_xml(ManagerOrder $order)
    {

        $xml_order_path = storage_path('flow_order/');

        if (!is_dir($xml_order_path)) {
            File::makeDirectory($xml_order_path, 0777, true);
        }

        /**@var $oorder OOrder */
        $oorder = $order->getOrder();

        /**@var $user User */
        $user   = $oorder->user;

        /**@var $order_products ManagerOrderProduct[] | \Illuminate\Database\Eloquent\Collection | boolean */
        $order_products   = $order->getOrderProductsWithOptions();

        $dt     = new DateTime;

        $xml_title   = "MOF_" . $oorder->getId() . ".xml";

        return false;


        $result_path = $xml_order_path . $xml_title;

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><order/>');

        $xml->addAttribute('order_id', $oorder->getId());
        $xml->addAttribute('created', $dt->format('Y.m.d H:i:s'));

        $manager_id = $xml->addChild('manager_flow_id', $order->getAdmin()->getId());

        $user_flow_login = $xml->addChild('user_flow_login', $user->getLogin());

        $user_phone      = $xml->addChild('user_site_id', $user->getId());
        $user_phone      = $xml->addChild('user_site_phone', $user->getPhone());
        $user_email      = $xml->addChild('user_site_email', $user->getEmail());

        $total_sum       = $xml->addChild('total_sum', $order->getTotalPriceSum());

        $products = $xml->addChild('products');

        foreach ($order_products as $order_product) {
            $product = $products->addChild('product');
            $product->addAttribute('product_tvc_id', $order_product->getTvcFlowId());
            $product->addAttribute('price', $order_product->getOrderDatePrice());

            foreach ($order_product->getOptions() as $order_product_option) {

                $option = $product->addChild('option');
                $option->addAttribute('option_id', $order_product_option->getFlowId());
                $option->addAttribute('quantity', $order_product_option->getQuantity());
            }
        }

        $xml->asXML($result_path);

        $aaa = 0;

    }
}