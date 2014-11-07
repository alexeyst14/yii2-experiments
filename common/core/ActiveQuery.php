<?php

namespace common\core;

use yii\caching\TagDependency;

class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * @var \yii\caching\Cache
     */
    protected $cache;

    /**
     * Cache dependency tags
     * @var array
     */
    protected $dependencyTags = [];


    public function __construct($modelClass, $config = [])
    {
        parent::__construct($modelClass, $config);
        $this->cache = \Yii::$app->getCache();
        $this->dependencyTags[] = $this->modelClass;
    }

    public function all($db = null)
    {
        return $this->fetchData('all');
    }

    public function one($db = null)
    {
        return $this->fetchData('one');
    }

    private function fetchData($method)
    {
        $key = $this->createCommand()->getRawSql();
        if (!$data = $this->cache->get($key)) {
            $data = parent::$method();
            $this->cache->set($key, $data, 0, new TagDependency(['tags' => $this->dependencyTags]));
        }
        return $data;
    }


} 