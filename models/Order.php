<?php

namespace models;

use core\Core;
use core\Model;
use core\Db;
use core\Config;

class Order extends Model
{
    public static $tableName = 'orders';

    public function __construct()
    {
        parent::__construct();
    }

    public function createOrder($name, $email, $address, $phone, $cart)
    {
        try {
            $this->db->pdo->beginTransaction();

            $orderData = [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('orders', $orderData);
            $orderId = $this->db->pdo->lastInsertId();

            foreach ($cart as $item) {
                if ($item['stock_quantity'] > 0) {
                    $orderItemData = [
                        'order_id' => $orderId,
                        'drink_id' => $item['id'],
                        'quantity' => $item['stock_quantity'],
                        'price' => $item['price']
                    ];
                    $this->db->insert('order_items', $orderItemData);

                    $newQuantity = $item['stock_quantity'] - 1;
                    $this->db->update('drinks', ['stock_quantity' => $newQuantity], ['id' => $item['id']]);
                } else {
                    throw new \Exception('Insufficient stock for item ID: ' . $item['id']);
                }
            }

            $this->db->pdo->commit();

            return $orderId;
        } catch (\Exception $e) {
            $this->db->pdo->rollBack();
            return false;
        }
    }


    public static function getAllOrders()
    {
        $rows = self::getAll(self::$tableName);
        if (!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }

    public static function FindByOrderId($id)
    {
        $rows = self::findById($id);

        if (!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }

    public function deleteOrderById($id)
    {
        $this->db->delete('orders', ['id' => $id]);
    }

    public function updateOrderById($id, $newData)
    {
        $this->db->update('orders', $newData, ['id' => $id]);
    }



    public static function findByEmail($email)
    {
        return Core::get()->db->select(static::$tableName, '*', ['email' => $email]);
    }
}
