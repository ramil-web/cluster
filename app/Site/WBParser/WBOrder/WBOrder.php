<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 17.10.2018
 * Time: 16:09
 */

namespace App\Site\WBParser\WBOrder;

class WBOrder
{
    // Код WB
    public $nmId;
    // Номер заказа WB
    public $number;
    // Область
    public $oblast;
    // Склад отгрузки
    public $warehouseName;
    // Ваш артикул
    public $supplierArticle;
    // Предмет
    public $subject;
    // Категория
    public $category;
    // Бренд
    public $brand;
    // Количество
    public $quantity;
    // Размер
    public $techSize;
    // Цена до согласованной скидки\промо\спп
    public $totalPrice;
    // Согласованный итоговый дисконт
    public $discountPercent;
    // Штрих-код
    public $barcode;
    // Номер поставки
    public $incomeID;
    // Уникальный идентификатор позиции заказа
    public $odid;
    // Дата заказа
    public $date;
    // Дата время обновления информации в сервисе
    public $lastChangeDate;

    public function __construct()
    {

    }
}