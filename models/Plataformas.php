<?php

namespace app\models;

/**
 * This is the model class for table "plataformas".
 *
 * @property int $id
 * @property string $denominacion
 *
 * @property Videojuegos[] $videojuegos
 */
class Plataformas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plataformas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion'], 'required'],
            [['denominacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Plataforma',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuegos()
    {
        return $this->hasMany(Videojuegos::className(), ['plataforma_id' => 'id'])->inverseOf('plataforma');
    }
}
