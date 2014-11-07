<?php

namespace common\core;

use yii\caching\TagDependency;
use common\core\ActiveQuery;

class Repository
{
    /**
     * @var ActiveQuery
     */
    protected $query;

    /**
     * @param ActiveQuery $query
     */
    public function __construct(ActiveQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @return ActiveQuery
     */
    public function q()
    {
        return $this->query;
    }

} 