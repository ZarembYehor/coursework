<?php

namespace models;

use core\Model;
use core\Core;


/**
* @property string $title Заголовок новини
* @property string $text Текст новини
* @property string $short_text Короткий текст новини
* @property string $date Дата новини
* @property int $id ID новини
*/

class News extends Model
{
    public static $tableName = 'news';
}
