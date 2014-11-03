<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.10.14
 * Time: 23:59
 */

namespace common\core;

use yii\db\AfterSaveEvent;
use yii\db\BaseActiveRecord;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @return mixed
     */
    public static function getRepository()
    {
        $reflect = new \ReflectionClass(parent::className());
        $className = "common\\repositories\\" . $reflect->getShortName() . 'Repository';
        return new $className(parent::find());
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        parent::afterDelete();
    }


}