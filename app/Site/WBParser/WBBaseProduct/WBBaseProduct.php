<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser\WBBaseProduct;

class WBBaseProduct
{
    // Код WB
    public $nmId;
    // Ваш артикул
    public $supplierArticle;
    // Бренд
    public $brand;
    // Количество доступное для продажи (все размеры)
    public $quantity;
    // Количество полное (все размеры)
    public $quantityFull;
    // Количество не в заказе (все размеры)
    public $quantityNotInOrders;
    // Категория
    public $category;
    // Предмет
    public $subject;
    // В пути к клиенту(штук) (все размеры)
    public $inWayToClient;
    // В пути от клиента(штук) (все размеры)
    public $inWayFromClient;

    public function __construct()
    {

    }
}