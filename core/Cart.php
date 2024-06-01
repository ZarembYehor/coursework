<?php

namespace core;

class Cart {
    public static function addProduct($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $product;
        
    }

    public static function getProducts() {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    public static function clearCart() {
        $_SESSION['cart'] = [];
    }

    public static function removeProduct($index) {
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
        }
    }

    public static function getTotal() {
        $total = 0;
        foreach (self::getProducts() as $product) {
            $total += $product['price'];
        }
        return $total;
    }
}