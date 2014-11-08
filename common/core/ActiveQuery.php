<?php

namespace common\core;

use yii\caching\TagDependency;

/**
 * Class ActiveQuery
 * @package common\core
 * @method getOne
 * @method getAll
 * @method getCount
 * @method getSum
 * @method getAverage
 * @method getMin
 * @method getMax
 * @method getScalar
 * @method getColumn
 * @method getExists
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * Cache dependency tags
     * @var array
     */
    protected $dependencyTags = [];

    /**
     * @param array $modelClass
     * @param array $config
     */
    public function __construct($modelClass, $config = [])
    {
        parent::__construct($modelClass, $config);
        $this->dependencyTags[] = $this->modelClass;
    }

    /**
     * Fetch data from DB or Cache
     * @param string $method
     * @param $db
     * @return mixed
     */
    private function fetchData($method, $db = null)
    {
        $cache = \Yii::$app->getCache();
        $key = $this->createCommand()->getRawSql();
        if (!$data = $cache->get($key)) {
            $data = parent::$method($db);
            $cache->set($key, $data, 0, new TagDependency(['tags' => $this->dependencyTags]));
        }
        return $data;
    }

    public function all($db = null)
    {
        return $this->fetchData('all', $db);
    }

    public function one($db = null)
    {
        return $this->fetchData('one', $db);
    }


    /**
     * @param string $method
     * @param array $args
     * @return mixed
     * @throws \LogicException
     */
    public function __call($method, $args)
    {
        static $resultMethods = [
            'one','all','count','sum','average',
            'min','max','scalar','column','exists',
        ];
        $prefix = substr($method, 0, 3);
        $name = strtolower(substr($method, 3));
        if ($prefix == 'get' && in_array($name, $resultMethods)) {
            return $this->fetchData($name);
        }
        throw new \LogicException('Unknown method: ' . __CLASS__ .'::'.$method . '()');
    }

}
