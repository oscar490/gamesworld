<?php

use yii\helpers\Html;

?>
<div class="panel panel-primary">
    <div class='panel-heading'>
        <?=Html::encode($model->usuario->nombre) ?>
        <?= \Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </div>
    <div class='panel-body'>
        <?= Html::encode($model->texto)?>
    </div>
</div>
