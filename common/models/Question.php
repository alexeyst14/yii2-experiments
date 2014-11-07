<?php

namespace common\models;

use common\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $question
 * @property double $weight
 *
 * @property QuestionReply[] $questionReplies
 */
class Question extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weight'], 'number'],
            [['question'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'weight' => 'Weight',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionReplies()
    {
        return $this->hasMany(QuestionReply::className(), ['question_id' => 'id']);
    }


}
