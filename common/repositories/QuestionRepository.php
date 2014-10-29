<?php

namespace common\repositories;

use common\core\Repository;

class QuestionRepository extends Repository
{
    /**
     * @return $this
     */
    public function getWeightedQuestions()
    {
        $this->query->where(['weight' => 1]);
        return $this;
    }

    public function excludeIds(array $ids)
    {
        $this->query->andWhere(['not in', 'id',  $ids]);
        return $this;
    }


}