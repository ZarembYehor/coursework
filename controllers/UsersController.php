<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Users;
use models\Order;

class UsersController extends Controller
{

    public function actionLogin()
    {
        if (Users::IsUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->get('login'), $this->post->get('password'));
            if (!empty($user)) {
                Users::LoginUser($user);
                return $this->redirect('/');
            } else {
                $this->addErrorMessage('Неправильний логін і/або пароль');
            }
        }
        return $this->render();
    }

    public function actionLogout()
    {
        Users::LogoutUser();
        return $this->redirect('/users/login');
    }

    public function actionRegister()
    {
        if ($this->isPost) {
            $user = Users::FindByLogin($this->post->get('login'));
            if (!empty($user)) {
                $this->addErrorMessage('Користувач із таким логіном вже існує');
            }
            if (strlen($this->post->get('login')) === 0) {
                $this->addErrorMessage('Логін не вказано');
            }
            if ($this->post->get('password') != $this->post->get('password2')) {
                $this->addErrorMessage('Паролі не співпадають');
            }
            if (strlen($this->post->get('password')) === 0) {
                $this->addErrorMessage('Пароль не вказано');
            }
            if (strlen($this->post->get('password2')) === 0) {
                $this->addErrorMessage('Пароль(ще раз) не вказано');
            }
            if (strlen($this->post->get('lastname')) === 0) {
                $this->addErrorMessage('Прізвище не вказано');
            }
            if (strlen($this->post->get('firstname')) === 0) {
                $this->addErrorMessage("Ім'я не вказано");
            }
            if (!$this->isErrorMessageExists()) {
                Users::RegisterUser($this->post->get('login'), $this->post->get('password'), $this->post->get('lastname'), $this->post->get('firstname'));
                return $this->redirect("/users/registersuccess");
            }
        }
        return $this->render();
    }

    public function actionRegistersuccess()
    {
        return $this->render();
    }

    public function actionIndex()
    {
        if (!Users::IsUserLogged() || !Users::IsUserAdmin()) {
            return $this->redirect('/users/login');
        }
        $this->addRows(Order::getAllOrders());
        return $this->render();
    }

    public function actionProfile()
    {
        if (!Users::IsUserLogged()) {
            return $this->redirect('/users/login');
        }

        $user = Core::get()->session->get('user');
        $email = $user['login'];
        $orders = Order::findByEmail($email);
        $this->addRows($orders);

        return $this->render();
    }

    public function actionUpdateProfile()
    {
        if (!Users::IsUserLogged()) {
            return $this->redirect('/users/login');
        }

        if ($this->isPost && Users::IsUserLogged()) {
            $user = Core::get()->session->get('user');
            $updatedData = [
                'password' => $_POST['password'],
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName']
            ];

            Users::updateUserById($user['id'], $updatedData);

            $updatedUser = Users::findByLogin($user['login']);
            Core::get()->session->set('user', $updatedUser);

            header('Location: /users/profile');
            exit();
        }
    }
}
