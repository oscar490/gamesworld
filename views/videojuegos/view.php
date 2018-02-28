<?php

use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Videojuegos */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Videojuegos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videojuegos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'codigo',
            'titulo',
            'descripcion',
            'plataforma.denominacion',
            'genero.nombre',
            'precio:currency',
        ],
    ]) ?>

    <h3>Comentarios</h3>
    <?= ListView::widget([
        'dataProvider'=>$dataProvider,
        'itemView'=>'_comentario'
    ]) ?>

    <?php $form = ActiveForm::begin([
        'action'=>['comentarios/create'],
    ]) ?>
        <?= $form->field($comentario, 'texto')->textarea([
            'rows'=>5,
        ])?>

        <?= Html::submitButton('Añadir', ['class'=>'btn btn-success'])?>
        <?= Html::hiddeninput('usuario_id', \Yii::$app->user->id) ?>
        <?= Html::hiddeninput('videojuego_id', $model->id)?>
    <?php ActiveForm::end() ?>

</div>
