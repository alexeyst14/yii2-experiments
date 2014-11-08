<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class QuestionController extends ActiveController
{
    public $modelClass = 'common\models\Question';

    public function actionDocumentation()
    {
        $response = new Response();
        $response->format = $response::FORMAT_JSON;
        $response->data =array_keys($this->actions());
        return $response;
    }

}
