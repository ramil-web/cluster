<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser\WBProduct;

class WBProduct
{
    // Код WB
    public $nmId;
    // Название склада
    public $warehouseName;
    // Ваш артикул
    public $supplierArticle;
    // Размер
    public $techSize;
    // Бренд
    public $brand;
    // Количество доступное для продажи
    public $quantity;
    // Количество полное
    public $quantityFull;
    // Количество не в заказе
    public $quantityNotInOrders;
    // Категория
    public $category;
    // Предмет
    public $subject;
    // Количество дней на сайте
    public $daysOnSite;
    // Штрих-код
    public $barcode;
    // Договор поставки
    public $isSupply;
    // Договор реализации
    public $isRealization;
    // В пути к клиенту(штук)
    public $inWayToClient;
    // В пути от клиента(штук)
    public $inWayFromClient;
    // Дата и время обновления информации в сервисе
    public $lastChangeDate;

    public function __construct()
    {

    }
}