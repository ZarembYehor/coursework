<?php

namespace controllers;

use core\Cart as CoreCart;
use core\Controller;
use models\Order;
use models\Cart;

class OrderController extends Controller
{
    public function actionCheckout()
    {
        $cart = CoreCart::getProducts();
        if (empty($cart)) {
            $this->redirect('/drinks/index');
        }

        if ($this->isPost) {
            $name = $this->post->get('name');
            $email = $this->post->get('email');
            $address = $this->post->get('address');
            $phone = $this->post->get('phone');

            $orderModel = new Order();
            $orderId = $orderModel->createOrder($name, $email, $address, $phone, $cart);

            if ($orderId) {
                CoreCart::clearCart();
                $this->redirect('/order/success');
            } else {
                $this->addErrorMessage('Не вдалося створити замовлення. Спробуйте ще раз.');
            }
        }

        $this->template->setParam('cart', $cart);
        return $this->render();
    }

    public function actionSuccess()
    {
        return $this->render();
    }
}
