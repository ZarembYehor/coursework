<?php

namespace models;

use core\Model;
use core\Core;


/**
* @property string $login Логін
* @property string $password Пароль
* @property string $firstName Ім'я
* @property string $lastName Прізвище
* @property int $id ID користувача
*/

class Users extends Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password) {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);

        if(!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }

    public static function FindByLogin($login) {
        $rows = self::findByCondition(['login' => $login]);

        if(!empty($rows)) {
            return $rows;
        } else {
            return null;
        }
    }

    public static function IsUserLogged() {
        return !empty(Core::get()->session->get('user'));
    }

    public static function LoginUser($user) {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser($user) {
        Core::get()->session->remove('user', $user);
    }

    public static function RegisterUser($login, $password, $lastName, $firstName) {
        $user = new Users();
        $user->login = $login;
        $user->password = $password;
        $user->lastName = $lastName;
        $user->firstName = $firstName;
        $user->save();
    }
}
