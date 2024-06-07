<?php

namespace controllers;

use core\Controller;
use core\Template;
use models\Drinks;
use core\Cart;
use models\Users;

class DrinksController extends Controller
{
    public function actionIndex()
    {
        $this->addRows(Drinks::getDrinks());
        return $this->render();
    }

    public function actionFilter()
    {
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

    public function actionAddToCart()
    {
        $product_id = $this->post->get('product_id');
        $product = Drinks::findById($product_id);
        if ($product) {
            Cart::addProduct($product);
        }
        $this->redirect('/drinks/filter');
    }

    public function actionDelete()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }

        if ($this->isPost) {

            if (!empty($this->post->get('product_id'))) {
                $id = intval($this->post->get('product_id'));
                $drinkModel = new Drinks();
                $drinkModel->deleteDrinkrById($id);
                return $this->render();
            }
        } else {
            $this->redirect('/drinks/index');
        }
    }

    public function actionAdd()
    {
        if (!Users::isUserAdmin()) {
            header('Location: /');
            exit();
        }

        if ($this->isPost) {
            $name = $this->post->get('name');
            $price = $this->post->get('price');
            $volume = $this->post->get('volume');
            $manufacturer = $this->post->get('manufacturer');
            $description = $this->post->get('description');
            $image_url = $this->post->get('image_url');
            $stock_quantity = $this->post->get('stock_quantity');
            $category_id = $this->post->get('category_id');

            if (empty($name)) {
                $this->addErrorMessage('Назва не вказана');
            }
            if (!is_numeric($price) || $price < 0) {
                $this->addErrorMessage('Некоректна ціна');
            }
            if (empty($volume)) {
                $this->addErrorMessage('Об\'єм не вказано');
            }
            if (empty($manufacturer)) {
                $this->addErrorMessage('Виробник не вказано');
            }
            if (empty($description)) {
                $this->addErrorMessage('Опис не вказано');
            }
            if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
                $this->addErrorMessage('Некоректний URL зображення');
            }
            if (!is_numeric($stock_quantity) || $stock_quantity < 0) {
                $this->addErrorMessage('Некоректна кількість на складі');
            }

            if (!$this->isErrorMessageExists()) {
                Drinks::addDrink($name, $price, $volume, $manufacturer, $description, $image_url, $stock_quantity, $category_id);
                return $this->redirect("/drinks/addsuccess");
            }
        }
        return $this->render();
    }

    public function actionAddsuccess()
    {
        if (!Users::isUserAdmin()) {
            header('Location: /');
            exit();
        }
        return $this->render();
    }

    public function actionCart()
    {
        $this->template->setParam('cart', Cart::getProducts());
        $this->template->setParam('total', Cart::getTotal());
        return $this->render();
    }

    public function actionClearCart()
    {
        Cart::clearCart();
        $this->redirect('/drinks/cart');
    }

    public function actionRemoveFromCart()
    {
        $index = $this->post->get('index');
        Cart::removeProduct($index);
        $this->redirect('/drinks/cart');
    }

    public function actionUpdate()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        if ($this->isPost && !empty($this->post->get('name'))) {
            $id = $this->post->get('id');
            $name = $this->post->get('name');
            $price = $this->post->get('price');
            $volume = $this->post->get('volume');
            $manufacturer = $this->post->get('manufacturer');
            $description = $this->post->get('description');
            $image_url = $this->post->get('image_url');
            $stock_quantity = $this->post->get('stock_quantity');
            $category_id = $this->post->get('category_id');

            if (empty($name)) {
                $this->addErrorMessage('Назва не вказана');
            }
            if (!is_numeric($price) || $price < 0) {
                $this->addErrorMessage('Некоректна ціна');
            }
            if (empty($volume)) {
                $this->addErrorMessage('Об\'єм не вказано');
            }
            if (empty($manufacturer)) {
                $this->addErrorMessage('Виробник не вказано');
            }
            if (empty($description)) {
                $this->addErrorMessage('Опис не вказано');
            }
            if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
                $this->addErrorMessage('Некоректний URL зображення');
            }
            if (!is_numeric($stock_quantity) || $stock_quantity < 0) {
                $this->addErrorMessage('Некоректна кількість на складі');
            }

            $newData = [
                'name' => $name,
                'price' => $price,
                'volume' => $volume,
                'manufacturer' => $manufacturer,
                'description' => $description,
                'image_url' => $image_url,
                'stock_quantity' => $stock_quantity,
                'category_id' => $category_id
            ];
            $drinksModel = new Drinks();
            $drinksModel->updateDrinkById($id, $newData);

            header('Location: /drinks/index');
            exit();
            $this->addRows(Drinks::findById($this->post->get('product_id')));
            return $this->render();
        } else {
            $this->redirect("/drinks/index");
        }
    }
}
