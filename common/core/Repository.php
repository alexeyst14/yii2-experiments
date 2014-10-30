<?php

namespace common\core;

use yii\db\ActiveQuery;

class Repository
{
    /**
     * @var \yii\db\ActiveQuery
     */
    protected $query;

    /**
     * @param ActiveQuery $query
     */
    public function __construct(ActiveQuery $query)
    {
        $this->query = $query;
    }

    public function q()
    {
        return $this->query;
    }

    public function all()
    {
        return $this->query->all();
    }

    public function one()
    {
        return $this->query->one();
    }

} 