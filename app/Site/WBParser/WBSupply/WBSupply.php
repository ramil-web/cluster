<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser\WBSupply;

class WBSupply
{
    // Код WB
    public $nmId;
    // Название склада
    public $warehouseName;
    // Ваш артикул
    public $supplierArticle;
    // Размер
    public $techSize;
    // Количество
    public $quantity;
    // Цена из УПД
    public $totalPrice;
    // Номер УПД
    public $number;
    // Номер поставки
    public $incomeId;
    // Штрих-код
    public $barcode;
    // Дата поступления
    public $date;
    // Дата и время обновления информации в сервисе
    public $lastChangeDate;
    // Дата принятия(закрытия) в WB
    public $dateClose;

    public function __construct()
    {

    }
}