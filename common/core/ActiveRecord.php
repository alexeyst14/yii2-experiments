<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.10.14
 * Time: 23:59
 */

namespace common\core;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function getRepository()
    {
        $reflect = new \ReflectionClass(parent::className());
        $className = "common\\repositories\\" . $reflect->getShortName() . 'Repository';
        return new $className(parent::find());
    }
} 