<?php

namespace app\models;

use yii\base\Model;

class GestionarForm extends Model
{
    public $codigo;

    public function rules()
    {
        return [
            [['codigo'], 'integer'],
            [['codigo'], 'required'],
            [
                ['codigo'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Videojuegos::className(),
                'targetAttribute' => ['codigo' => 'codigo'],
            ],
        ];
    }

    public function formName()
    {
        return '';
    }
}
