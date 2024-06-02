<?php

namespace models;

use core\Model;

class Order extends Model
{
    public function __construct() {
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
                $orderItemData = [
                    'order_id' => $orderId,
                    'drink_id' => $item['id'],
                    'quantity' => $item['stock_quantity'],
                    'price' => $item['price']
                ];
                $this->db->insert('order_items', $orderItemData);

                $this->db->update('drinks', ['stock_quantity' => $item['stock_quantity'] - $item['stock_quantity']], ['id' => $item['id']]);
            }

            $this->db->pdo->commit();

            return $orderId;
        } catch (\Exception $e) {
            $this->db->pdo->rollBack();
            return false;
        }
    }
}