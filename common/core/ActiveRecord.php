<?php

namespace common\core;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @return mixed
     */
    public static function getRepository()
    {
        $reflect = new \ReflectionClass(parent::className());
        $className = "common\\repositories\\" . $reflect->getShortName() . 'Repository';
        return new $className(self::find());
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        TagDependency::invalidate(\Yii::$app->getCache(), parent::className());
    }

    /**
     * After delete event
     */
    public function afterDelete()
    {
        parent::afterDelete();
        TagDependency::invalidate(\Yii::$app->getCache(), parent::className());
    }

    /**
     * @return object|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return \Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }


}