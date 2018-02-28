<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Videojuegos */

$this->title = 'Update Videojuegos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Videojuegos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="videojuegos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
