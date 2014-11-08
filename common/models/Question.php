<?php

namespace common\models;

use common\core\ActiveRecord;
use Yii;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $question
 * @property double $weight
 *
 * @property QuestionReply[] $questionReplies
 */
class Question extends ActiveRecord implements Linkable
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
            [['question'], 'required'],
            [['question'], 'string', 'max' => 255],
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


    /**
     * Returns a list of links.
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['user/view', 'id' => $this->id], true),
        ];
    }
}
