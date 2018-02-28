<?php

use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?= ListView::widget([
    'dataProvider'=>$dataProvider,
    'itemView'=>'_videojuego',
    'summary'=>'',
]) ?>
