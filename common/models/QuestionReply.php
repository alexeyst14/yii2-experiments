<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "question_reply".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $reply_id
 * @property double $reply_index
 * @property integer $reply_cnt
 *
 * @property Question $question
 * @property Reply $reply
 */
class QuestionReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'reply_id', 'reply_cnt'], 'integer'],
            [['reply_index'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'reply_id' => 'Reply ID',
            'reply_index' => 'Reply Index',
            'reply_cnt' => 'Reply Cnt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReply()
    {
        return $this->hasOne(Reply::className(), ['id' => 'reply_id']);
    }
}
