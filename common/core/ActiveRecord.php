<?php

namespace common\core;


class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\caching\Cache
     */
    protected $cache;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->cache = \Yii::$app->getCache();
    }

    /**
     * @return mixed
     */
    public static function getRepository()
    {
        $reflect = new \ReflectionClass(parent::className());
        $className = "common\\repositories\\" . $reflect->getShortName() . 'Repository';
        return new $className(self::find());
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        TagDependency::invalidate(\Yii::$app->getCache(), parent::className());
    }

    public function afterDelete()
    {
        parent::afterDelete();
        TagDependency::invalidate(\Yii::$app->getCache(), parent::className());
    }

    public static function find()
    {
        return \Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }


}