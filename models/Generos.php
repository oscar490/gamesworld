<?php

namespace app\models;

/**
 * This is the model class for table "generos".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Videojuegos[] $videojuegos
 */
class Generos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Género',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuegos()
    {
        return $this->hasMany(Videojuegos::className(), ['genero_id' => 'id'])->inverseOf('genero');
    }
}
