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
        $this->q()->limit(1)->orderBy(['weight' => SORT_DESC]);
        return $this->one();
    }

    /**
     * @param array $ids
     * @return $this
     */
    public function excludeIds(array $ids)
    {
        $this->query->andWhere(['not in', 'question.id',  $ids]);
        return $this;
    }

    /**
     * @param int $prevReplyId
     * @return $this
     */
    public function getNextQuestion($prevReplyId)
    {
        $this->query
            ->select('question.*')
            ->innerJoin('question_reply rs', 'question.id = rs.question_id')
            ->orderBy('qr.reply_index DESC')
            ->limit(1)
            ->andWhere(['qr.reply_id' => $prevReplyId ]);
        return $this;
    }


}