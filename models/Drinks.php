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

    public static function FindByCategory($category_id = null, $sort_price = null, $volume = null, $search_name = null) {
        $order_by = '';
        if ($sort_price === 'asc') {
            $order_by = ' ORDER BY price ASC';
        } elseif ($sort_price === 'desc') {
            $order_by = ' ORDER BY price DESC';
        }
    
        $sql = "SELECT * FROM " . static::$tableName;
        $conditions = [];
        $params = [];
    
        if (!empty($category_id)) {
            $conditions[] = "category_id = :category_id";
            $params[':category_id'] = $category_id;
        }
    
        if (!empty($volume)) {
            $conditions[] = "volume = :volume";
            $params[':volume'] = $volume;
        }
    
        if (!empty($search_name)) {
            $conditions[] = "name LIKE :search_name";
            $params[':search_name'] = '%' . $search_name . '%';
        }
    
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $sql .= $order_by;
        
        $sth = Core::get()->db->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $sth->bindValue($key, $value);
        }
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public function decreaseQuantity($drinkId, $quantity)
    {
        $query = "UPDATE drinks SET stock_quantity = stock_quantity - :quantity WHERE id = :id";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':id', $drinkId);
        $stmt->execute();
    }
}