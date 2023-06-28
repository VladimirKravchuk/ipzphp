<?php


namespace frontend\models;


use yii\base\Model;

class FileSystem extends Model
{
    public static function deleteFile($file)
    {
        if (!empty($file) && is_file($file)) {
            unlink($file);
        }
    }
}