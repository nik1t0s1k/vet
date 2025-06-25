<?php

namespace app\controllers;

use app\models\Pet;
use Yii;
use yii\web\Controller;
use app\models\Consultation;
use app\models\Veterinarian;
use yii\web\NotFoundHttpException;

class ConsultationController extends Controller
{

    public function actionIndex()
    {
        $veterinarians = Consultation::find()->all();
        return $this->render('index', ['veterinarians' => $veterinarians]);
    }

    public function actionBook($vet_id)
    {
        $vet = Veterinarian::findOne($vet_id);
        if (!$vet) {
            throw new NotFoundHttpException('Ветеринар не найден');
        }

        $model = new Consultation();
        $model->veterinarian_id = $vet_id;
        $model->user_id = Yii::$app->user->id;
        $model->status = 'pending';

        if ($model->load(Yii::$app->request->post())) {
            // Создаем дату и время без использования несуществующего свойства datetime
            $dateTimeString = $model->date . ' ' . $model->time;

            // Вариант 1: Если в БД есть поле datetime (рекомендуемый способ)
//            $model->setAttribute('datetime', $dateTimeString);

            // Или Вариант 2: Если datetime - временное свойство
             $model->datetime = $dateTimeString; // Раскомментировать если добавили public $datetime в модель

            if ($model->save()) {
                Yii::$app->session->setFlash('success',
                    "Вы успешно записаны на консультацию к {$vet->user->username} на " . Yii::$app->formatter->asDatetime($dateTimeString));
                return $this->redirect(['/consultation/index']);
            }
        }

        return $this->render('book', [
            'model' => $model,
            'vet' => $vet,
        ]);
    }
    public function actionView($id)
    {
        $model = Consultation::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Консультация не найдена.');
        }

        // Проверка прав доступа (если нужно)
        // if ($model->user_id != Yii::$app->user->id) {...}

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Проверка прав доступа - только владелец консультации может редактировать
        if ($model->user_id !== Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Вы не можете редактировать эту консультацию');
        }

        if ($model->load(Yii::$app->request->post())) {
            // Обработка даты/времени
            if (!empty($model->datetime)) {
                $model->datetime = date('Y-m-d H:i:s', strtotime($model->datetime));
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Консультация успешно обновлена');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при обновлении консультации');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'pets' => $this->getUserPets(), // Питомцы текущего пользователя
            'veterinarians' => Veterinarian::find()->all() // Все ветеринары
        ]);
    }

    protected function getUserPets()
    {
        return Pet::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();
    }

    protected function findModel($id)
    {
        if (($model = Consultation::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Консультация не найдена');
    }
}