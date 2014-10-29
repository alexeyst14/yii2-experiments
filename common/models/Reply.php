<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reply".
 *
 * @property integer $id
 * @property string $reply
 *
 * @property QuestionReply[] $questionReplies
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reply' => 'Reply',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionReplies()
    {
        return $this->hasMany(QuestionReply::className(), ['reply_id' => 'id']);
    }
}
