<?php

namespace controllers;

use core\Controller;
use core\Template;
use models\Drinks;
use core\Cart;

class DrinksController extends Controller {
    public function actionIndex() {
        $this->addRows(Drinks::getDrinks());
        return $this->render();
    }

    public function actionFilter() {
        $category_id = $this->post->get('category_id');
        $sort_price = $this->post->get('sort_price');
        $volume = $this->post->get('volume');
        $search_name = $this->post->get('search_name');

        $this->addRows(Drinks::FindByCategory($category_id, $sort_price, $volume, $search_name));

        $this->template->setParam('category_id', $category_id);
        $this->template->setParam('sort_price', $sort_price);
        $this->template->setParam('volume', $volume);
        $this->template->setParam('search_name', $search_name);

        return $this->render();
    }

    public function actionAddToCart() {
        $product_id = $this->post->get('product_id');
        $product = Drinks::findById($product_id);
        if ($product) {
            Cart::addProduct($product);
        }
        $this->redirect('/drinks');
    }

    public function actionCart() {
        $this->template->setParam('cart', Cart::getProducts());
        $this->template->setParam('total', Cart::getTotal());
        return $this->render('views/drinks/cart.php');
    }

    public function actionClearCart() {
        Cart::clearCart();
        $this->redirect('/drinks/cart');
    }

    public function actionRemoveFromCart() {
        $index = $this->post->get('index');
        Cart::removeProduct($index);
        $this->redirect('/drinks/cart');
    }
}