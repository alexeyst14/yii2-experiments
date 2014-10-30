<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <p>
                <?= Html::a('Start', ['site/play'], ['class' => 'btn btn-lg btn-success']); ?>
            </p>
        </div>
    </div>
</div>
