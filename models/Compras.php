<?php

namespace app\models;

/**
 * This is the model class for table "compras".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $videojuego_id
 * @property string $created_at
 *
 * @property Usuarios $usuario
 * @property Videojuegos $videojuego
 */
class Compras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'videojuego_id'], 'required'],
            [['usuario_id', 'videojuego_id'], 'default', 'value' => null],
            [['usuario_id', 'videojuego_id'], 'integer'],
            [['created_at'], 'safe'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['videojuego_id'], 'exist', 'skipOnError' => true, 'targetClass' => Videojuegos::className(), 'targetAttribute' => ['videojuego_id' => 'id']],
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'videojuego_id' => 'Videojuego ID',
            'created_at' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('compras');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideojuego()
    {
        return $this->hasOne(Videojuegos::className(), ['id' => 'videojuego_id'])->inverseOf('compras');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $videojuego = $this->videojuego;
                if ($videojuego->unidades != 0) {
                    $videojuego->unidades = $videojuego->unidades - 1;
                    $videojuego->save();
                } else {
                    \Yii::$app->session->setFlash('error', 'Ya no quedan más unidades');
                }
            }
            return true;
        }
        return false;
    }
}
