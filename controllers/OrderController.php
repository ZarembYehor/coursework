<?php

namespace controllers;

use core\Cart as CoreCart;
use core\Controller;
use core\Core;
use models\Order;
use models\Cart;
use models\Users;
use core\DB;

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
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        return $this->render();
    }

    public function actionUpdate()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        if ($this->isPost) {
            $id = (int)$_POST['id'];
            $newData = [
                'name' => $this->post->get('name'),
                'email' => $this->post->get('email'),
                'address' => $this->post->get('address'),
                'phone' => $this->post->get('phone'),
                'created_at' => $this->post->get('created_at')
            ];

            $orderModel = new Order();
            $orderModel->updateOrderById($id, $newData);

            header('Location: /order/index');
            exit();
        } else {
            header('Location: /orders');
            exit();
        }
    }

    public function actionGetOrders()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            return;
        }

        $orders = Order::getAllOrders();
        echo json_encode($orders);
    }

    public function actionDelete()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        if ($this->isPost) {
            if (!empty($this->post->get('id'))) {
                $id = intval($this->post->get('id'));
                $orderModel = new Order();
                $orderModel->deleteOrderById($id);
                return $this->render();
            }
        } else {
            $this->redirect('/order/index');
        }
    }

    public function actionIndex()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        $this->addRows(Order::getAllOrders());
        return $this->render();
    }

    public function actionShoworder()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        $orderId = '';
        if ($this->isPost) {
            $orderId = $this->post->get('order_id');
            $orderId = intval($orderId);
        }
        $this->addRows(Order::FindByOrderId($orderId));
        return $this->render();
    }

    public function actionFormtoupdate()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/');
        }
        if ($this->isPost) {
            return $this->render();
        } else {
            $this->redirect('order/index');
        }
    }
}
