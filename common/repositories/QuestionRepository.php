<?php

namespace common\repositories;

use common\core\Repository;

class QuestionRepository extends Repository
{
    /**
     * @return $this
     */
    public function getMaxWeightQuestion()
    {
        $this->query->max('weight');
        return $this;
    }

    /**
     * @param array $ids
     * @return $this
     */
    public function excludeIds(array $ids)
    {
        $this->query->andWhere(['not in', 'id',  $ids]);
        return $this;
    }


}