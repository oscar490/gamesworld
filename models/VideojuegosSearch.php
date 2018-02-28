<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VideojuegosSearch represents the model behind the search form of `app\models\Videojuegos`.
 */
class VideojuegosSearch extends Videojuegos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plataforma_id', 'genero_id'], 'integer'],
            [['codigo', 'precio'], 'number'],
            [['titulo', 'descripcion', 'plataforma.denominacion', 'genero.nombre'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'plataforma.denominacion',
            'genero.nombre',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Videojuegos::find()
            ->joinWith(['plataforma', 'genero']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['plataforma.denominacion'] = [
            'asc' => ['plataformas.denominacion' => SORT_ASC],
            'desc' => ['plataformas.denominacion' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['genero.nombre'] = [
            'asc' => ['generos.nombre' => SORT_ASC],
            'desc' => ['generos.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'codigo' => $this->codigo,
            'plataforma_id' => $this->plataforma_id,
            'genero_id' => $this->genero_id,
            'precio' => $this->precio,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere([
                'like',
                'lower(plataformas.denominacion)',
                $this->getAttribute('plataforma.denominacion'),
            ])
            ->andFilterWhere([
                'like',
                'lower(generos.nombre)',
                $this->getAttribute('genero.nombre'),
            ]);

        return $dataProvider;
    }
}
