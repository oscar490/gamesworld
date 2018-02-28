<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

?>


<h1>Gestionar</h1>


    <div >
        <?php $form = ActiveForm::begin([
            'method'=>'get',
            'action'=>['compras/gestionar'],
        ]) ?>

            <?= $form->field($modelo, 'codigo')->textinput([
                'placeholder'=>'Código de videojuego ...'
            ])?>

            <?= Html::submitButton('Buscar', ['class'=>'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>
    <div>
        <?php if (isset($dataProvider)): ?>
            <h3>Videojuego</h3>
            <?= GridView::widget([
                'dataProvider'=>$dataProvider,
                'columns'=>[
                    'codigo',
                    'titulo',
                    'precio:currency',
                    'unidades',
                    [
                        'class'=>'yii\grid\ActionColumn',
                        'template'=>'{comprar}',
                        'header'=>'Acciones',
                        'buttons'=>[
                            'comprar'=> function ($url, $model, $key) {
                                return Html::beginForm(['compras/create'])
                                . Html::hiddeninput('usuario_id', \Yii::$app->user->id)
                                . Html::hiddeninput('videojuego_id', $model->id)
                                . Html::submitButton('Comprar', ['class'=>'btn-xs btn-primary'])
                                . Html::endForm();
                            }
                        ]
                    ],
                ],
            ]) ?>
        <?php endif; ?>
    </div>
    <div >
        <h3>Compras</h3>
        <?= GridView::widget([
            'dataProvider'=>$compras,
            'columns'=>[
                'videojuego.codigo',
                [
                    'attribute'=>'videojuego.enlace',
                    'format'=>'html',
                    'label'=>'Titulo',
                ],
                'created_at:datetime',
            ]
        ]) ?>
    </div>

</div>
