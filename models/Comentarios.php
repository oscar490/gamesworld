<?php

namespace app\models;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $texto
 * @property int $videojuego_id
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 * @property Videojuegos $videojuego
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto', 'videojuego_id', 'usuario_id'], 'required'],
            [['videojuego_id', 'usuario_id'], 'default', 'value' => null],
            [['videojuego_id', 'usuario_id'], 'integer'],
            [['texto'], 'string', 'max' => 255],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['videojuego_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videojuegos::className(), 'targetAttribute' => ['videojuego_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
            'videojuego_id' => 'Videojuego ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('comentarios');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuego()
    {
        return $this->hasOne(Videojuegos::className(), ['id' => 'videojuego_id'])->inverseOf('comentarios');
    }
}
