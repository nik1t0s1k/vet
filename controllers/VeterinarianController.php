<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Veterinarian;
use yii\data\ActiveDataProvider;

class VeterinarianController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Veterinarian::find()->with('user'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}