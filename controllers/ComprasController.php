<?php

namespace app\controllers;

use app\models\Compras;
use app\models\ComprasSearch;
use app\models\GestionarForm;
use app\models\Videojuegos;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ComprasController implements the CRUD actions for Compras model.
 */
class ComprasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Compras models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComprasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compras model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compras();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['compras/gestionar', 'codigo' => $model->videojuego->codigo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionGestionar($codigo = null)
    {
        $datos = [];
        $datos['modelo'] = new GestionarForm([
            'codigo' => $codigo,
        ]);

        $datos['compras'] = new ActiveDataProvider([
            'query' => Compras::find()
                ->where(['usuario_id' => \Yii::$app->user->id]),
            'pagination' => [
                'pagesize' => 5,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        if ($codigo !== null && $datos['modelo']->validate()) {
            $datos['dataProvider'] = new ActiveDataProvider([
                'query' => Videojuegos::find()
                    ->where(['codigo' => $codigo]),
            ]);
        }

        return $this->render('gestionar', $datos);
    }



    /**
     * Updates an existing Compras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Compras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Compras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Compras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compras::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
