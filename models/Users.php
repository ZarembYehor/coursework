<?php

namespace models;

use core\Model;
use core\Core;

class Users extends Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function IsUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function IsUserAdmin()
    {
        $user = Core::get()->session->get('user');
        return isset($user['isAdmin']) && $user['isAdmin'] == 1;
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser()
    {
        Core::get()->session->remove('user');
    }

    public static function updateUserById($id, $newData)
    {
        Core::get()->db->update(self::$tableName, $newData, ['id' => $id]);
    }

    public static function RegisterUser($login, $password, $lastName, $firstName)
    {
        $user = new Users();
        $user->login = $login;
        $user->password = $password;
        $user->lastName = $lastName;
        $user->firstName = $firstName;
        $user->save();
    }
}
