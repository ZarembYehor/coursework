<?php

namespace core;
use models\News;
class Model 
{
    protected $db;
    protected $fieldsArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';
    public function __construct()
    {
        global $db;
        $this->db = $db;
        $this->fieldsArray = [];
    }

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fieldsArray[$name];
    }

    public static function getAll() {
        return Core::get()->db->select(static::$tableName);
    }

    public static function deleteById($id) {
        Core::get()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($conditionAssocArray) {
        Core::get()->db->delete(static::$tableName, $conditionAssocArray);
    }

    public static function findById($id) {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id]);
        if(count($arr) > 0) {
            return $arr[0];
        } else {
            return null;
        }
    }

    public static function findByCondition($conditionAssocArray) {
        return Core::get()->db->select(static::$tableName, '*', $conditionAssocArray);
    }

    public function save() {
        $isInsert = false;
        if(!isset($this->{static::$primaryKey})) {
            $isInsert = true;
        } else {
            $value = $this->{static::$primaryKey};
            if(empty($value)) {
                $isInsert = true;
            }
        }
        if ($isInsert)
        //insert
        {
            Core::get()->db->insert(static::$tableName, $this->fieldsArray);
        }
        else
        //update
        {
            Core::get()->db->update(static::$tableName, $this->fieldsArray,
        [
            static::$primaryKey => $this->{static::$primaryKey}
        ]);
        }
    }
}