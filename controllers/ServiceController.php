<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Service;

class ServiceController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new Service();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $service = Service::findOne($id);
        return $this->render('view', ['service' => $service]);
    }

    public function actionCreate()
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = time();
            $model->updated_at = time();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}