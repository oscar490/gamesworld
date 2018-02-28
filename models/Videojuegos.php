<?php

namespace app\models;

use yii\helpers\Html;

/**
 * This is the model class for table "videojuegos".
 *
 * @property int $id
 * @property string $codigo
 * @property string $titulo
 * @property string $descripcion
 * @property int $plataforma_id
 * @property int $genero_id
 * @property string $precio
 *
 * @property Compras[] $compras
 * @property Generos $genero
 * @property Plataformas $plataforma
 */
class Videojuegos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videojuegos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'titulo', 'plataforma_id', 'genero_id', 'precio'], 'required'],
            [['codigo', 'precio'], 'number'],
            [['plataforma_id', 'genero_id'], 'default', 'value' => null],
            [['plataforma_id', 'genero_id'], 'integer'],
            [['titulo', 'descripcion'], 'string', 'max' => 255],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generos::className(), 'targetAttribute' => ['genero_id' => 'id']],
            [['plataforma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plataformas::className(), 'targetAttribute' => ['plataforma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'plataforma_id' => 'Plataforma ID',
            'genero_id' => 'Genero ID',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compras::className(), ['videojuego_id' => 'id'])->inverseOf('videojuego');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('videojuegos');
    }

    public function getEnlace()
    {
        return Html::a($this->titulo, ['videojuegos/view', 'id' => $this->id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlataforma()
    {
        return $this->hasOne(Plataformas::className(), ['id' => 'plataforma_id'])->inverseOf('videojuegos');
    }
}
