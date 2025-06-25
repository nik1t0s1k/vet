<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\Service;
use app\models\Pet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
    public function actionCreate($service_id)
    {
        $service = Service::findOne($service_id);
        if (!$service) {
            throw new NotFoundHttpException('Услуга не найдена');
        }

        $model = new Order();
        $model->service_id = $service_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Заказ успешно создан!');
            return $this->redirect(['/order/view', 'id' => $model->id]);
        }

        $pets = Pet::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();

        return $this->render('create', [
            'model' => $model,
            'service' => $service,
            'pets' => $pets,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $orders = Order::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'orders' => $orders,
        ]);
    }

    protected function findModel($id)
    {
        $model = Order::findOne($id);
        if (!$model || ($model->user_id != Yii::$app->user->id && !Yii::$app->user->can('admin'))) {
            throw new NotFoundHttpException('Заказ не найден');
        }
        return $model;
    }
}