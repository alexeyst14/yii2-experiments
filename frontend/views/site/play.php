<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-5">
                <?= $question->question ?>?
            </div>
        </div>

        <?= Html::beginForm(['site/reply']); ?>
            <?= Html::hiddenInput('questionId', $question->id) ?>
            <div class="row">
                <div class="col-lg-5">
                    <?= Html::radioList('reply', null, ['1' => 'Да', '2' => 'Нет', '3' => 'Не знаю']) ?>
                    <?= Html::submitButton('Ответить'); ?>
                </div>
            </div>
        <?= Html::endForm(); ?>

    </div>
</div>
