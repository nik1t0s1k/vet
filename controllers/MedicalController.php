<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\MedicalRecord;
use app\models\Pet;
use yii\data\ActiveDataProvider;

class MedicalController extends Controller
{
    public function actionIndex($pet_id = null)
    {
        // Если pet_id не передан, пробуем найти первого питомца пользователя
        if ($pet_id === null) {
            $pet = Pet::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->one();

            if ($pet) {
                return $this->redirect(['index', 'pet_id' => $pet->id]);
            }

            Yii::$app->session->setFlash('warning', 'У вас нет питомцев. Сначала добавьте питомца.');
            return $this->redirect(['/pet/create']);
        }

        $pet = $this->findPet($pet_id);

        // Проверяем, что питомец принадлежит текущему пользователю
        if ($pet->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('У вас нет доступа к этому питомцу');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => MedicalRecord::find()
                ->where(['pet_id' => $pet_id])
                ->orderBy(['record_date' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'pet' => $pet,
            'dataProvider' => $dataProvider,
            'userPets' => Pet::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->all(),
        ]);
    }

    public function actionAddRecord($pet_id = null)
    {
        // Если pet_id не передан, пробуем найти первого питомца пользователя
        if ($pet_id === null) {
            $pet = Pet::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->one();

            if ($pet) {
                return $this->redirect(['add-record', 'pet_id' => $pet->id]);
            }

            Yii::$app->session->setFlash('warning', 'У вас нет питомцев. Сначала добавьте питомца.');
            return $this->redirect(['/pet/create']);
        }

        $pet = $this->findPet($pet_id);

        // Проверяем, что питомец принадлежит текущему пользователю
        if ($pet->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('У вас нет доступа к этому питомцу');
        }

        $model = new MedicalRecord(['pet_id' => $pet_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно добавлена!');
            return $this->redirect(['index', 'pet_id' => $pet_id]);
        }

        return $this->render('add-record', [
            'model' => $model,
            'pet' => $pet,
            'userPets' => Pet::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pet = $model->pet;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись обновлена!');
            return $this->redirect(['index', 'pet_id' => $pet->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'pet' => $pet,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $pet_id = $model->pet_id;
        $model->delete();

        Yii::$app->session->setFlash('success', 'Запись удалена!');
        return $this->redirect(['index', 'pet_id' => $pet_id]);
    }

    protected function findModel($id)
    {
        if (($model = MedicalRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запись не найдена.');
    }

    protected function findPet($id)
    {
        if (($pet = Pet::findOne($id)) !== null) {
            return $pet;
        }

        throw new NotFoundHttpException('Питомец не найден.');
    }
}