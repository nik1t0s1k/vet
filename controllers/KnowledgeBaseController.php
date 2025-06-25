<?php
// controllers/KnowledgeBaseController.php

namespace app\controllers;

use Yii;
use app\models\KnowledgeBase;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class KnowledgeBaseController extends Controller
{
    public function actionIndex()
    {
        $categories = KnowledgeBase::getCategories();
        $types = KnowledgeBase::getTypes();

        // Фильтры из GET-параметров
        $category = Yii::$app->request->get('category');
        $type = Yii::$app->request->get('type');

        $query = KnowledgeBase::find()
            ->orderBy(['created_at' => SORT_DESC]);

        if ($category && array_key_exists($category, $categories)) {
            $query->andWhere(['category' => $category]);
        }

        if ($type && array_key_exists($type, $types)) {
            $query->andWhere(['type' => $type]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'types' => $types,
            'currentCategory' => $category,
            'currentType' => $type,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Увеличиваем счетчик просмотров (можно реализовать через behavior)
        if ($model->hasAttribute('views_count')) {
            $model->updateCounters(['views_count' => 1]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = KnowledgeBase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}