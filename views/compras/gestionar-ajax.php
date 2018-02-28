<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use \yii\grid\GridView;
use yii\helpers\Url;

$url = Url::to(['compras/gestionar-ajax']);
$js = <<<EOT
    $('form').on('afterValidateAttribute', function(event, attribute, messages) {
        if (messages.length === 0) {
            $.ajax({
                url: '$url',
                type: 'GET',
                data: {
                    codigo: $('#codigo').val(),
                },
                success: function(data) {
                    $('#contenido').html(data);
                    let titulo = $('<h3>Videojuego</h3>');
                    $('#contenido').prepend(titulo);
                },

            });
        } else {
            $('#contenido').empty();
        }
    });
EOT;

$this->registerJs($js);
?>

<?php $form = ActiveForm::begin([
    'method'=>'get',
    'id'=>'gestionar',
    'action'=>['compras/gestionar'],
    'enableAjaxValidation'=>true,
]) ?>

    <?= $form->field($modelo, 'codigo', ['enableAjaxValidation'=>true]) ?>

<?php ActiveForm::end() ?>

<div id='contenido'>
</div>

<div id='comprar'>
    
</div>

<hr>

<h3>Mis Compras</h3>
<?= GridView::widget([
    'dataProvider'=>$compras,
    'columns'=> [
        'videojuego.codigo',
        'videojuego.titulo',
        'created_at:datetime',

    ]
]) ?>
