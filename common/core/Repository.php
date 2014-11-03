<?php

namespace common\core;

use yii\caching\TagDependency;
use yii\db\ActiveQuery;

class Repository
{
    /**
     * @var \yii\db\ActiveQuery
     */
    protected $query;

    /**
     * @var \yii\caching\Cache
     */
    protected $cache;

    /**
     * Cache dependency tags
     * @var array
     */
    protected $tags = [];

    /**
     * @param ActiveQuery $query
     */
    public function __construct(ActiveQuery $query)
    {
        $this->query = $query;
        $this->cache = \Yii::$app->getCache();
    }

    public function q()
    {
        return $this->query;
    }

    public function all()
    {
        return $this->q()->all();
    }

    public function one()
    {
        $key = $this->q()->createCommand()->getRawSql();
        if (!$data = $this->cache->get($key)) {
            $data = $this->q()->one();
            $this->cache->set($key, $data, 0);
        }
        return $data;
    }

    public function max($q)
    {
        return $this->q()->max($q);
    }

} 