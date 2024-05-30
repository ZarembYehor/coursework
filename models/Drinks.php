<?php

namespace models;

use core\Model;
use core\Core;


/**
* @property string $name Назва напоюі
* @property int $category_id id категорії даного напою
* @property decimal(10,2) $price Ціна за напій
* @property string $volume Об'єм ємності товару
* @property string $manufacturer Виробник
* @property int $stock_quantity Кількість товару на складі
* @property text $description Опис товару
* @property varchar(255) $image_url Посилання на картинку
* @property timestamp $created_at Час створення запису
* @property timestamp $updated_at Час оновлення запису
* @property int $id ID напою
*/

class Drinks extends Model
{
    public static $tableName = 'drinks';

    public static function getDrinks() {

        $rows = self::getAll(self::$tableName);
        if(!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }
}