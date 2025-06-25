<?php

namespace app\controllers;

use app\models\UserProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use app\models\Pet;
use app\models\Consultation;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        // Получаем питомцев пользователя
        $pets = Pet::find()
            ->where(['user_id' => $user->id])
            ->all();

        // Получаем предстоящие консультации
        $consultationsProvider = new ActiveDataProvider([
            'query' => Consultation::find()
                ->where(['user_id' => $user->id])
                ->andWhere(['>=', 'date', date('Y-m-d')])
                ->orderBy('date ASC'),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('index', [
            'user' => $user,
            'pets' => $pets,
            'consultationsProvider' => $consultationsProvider,
        ]);
    }

    public function actionAddPet()
    {
        $model = new Pet();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            // Добавьте отладочный вывод
            Yii::debug('Данные модели: ' . print_r($model->attributes, true));

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Питомец добавлен!');
                return $this->redirect(['index']);
            } else {
                // Вывод ошибок валидации
                Yii::error('Ошибки сохранения: ' . print_r($model->errors, true));
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении питомца: ' . Html::errorSummary($model));
            }
        }

        return $this->render('add-pet', ['model' => $model]);
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionUpdate()
    {
        // Получаем текущего авторизованного пользователя
        $user = User::findOne(Yii::$app->user->id); // Исправлено: Yii вместо Vii
        if (!$user) {
            throw new NotFoundHttpException('Пользователь не найден'); // Исправлено
        }

        // Создаем форму и заполняем данными пользователя
        $model = new UserProfileForm();
        $model->attributes = $user->attributes;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // Обновляем только разрешенные поля (исправлены имена переменных!)
                $user->username = $model->username;
                $user->email = $model->email; // Английские буквы!


                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Профиль успешно обновлен!');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения данных: ' . implode(' ', $user->getFirstErrors()));
                }
            } else {
                Yii::$app->session->setFlash('error', 'Пожалуйста, исправьте ошибки в форме');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
