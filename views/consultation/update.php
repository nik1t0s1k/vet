<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Veterinarian;
use app\models\Pet;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */
/* @var $form ActiveForm */

$this->title = 'Редактирование консультации';
$this->params['breadcrumbs'][] = ['label' => 'Мои консультации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Консультация #'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="consultation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->input('date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'time')->input('time') ?>
        </div>
    </div>
    <?= $form->field($model, 'veterinarian_id')->dropDownList(
        ArrayHelper::map($veterinarians, 'id', function($vet) {
            return $vet->user->username . ' (' . $vet->specialization . ')';
        }),
        ['prompt' => 'Выберите ветеринара']
    ) ?>

    <?= $form->field($model, 'pet_id')->dropDownList(
        ArrayHelper::map($pets, 'id', 'name'),
        ['prompt' => 'Выберите питомца']
    ) ?>

    <?= $form->field($model, 'type')->dropDownList(
        [
            'video' => 'Видео консультация',
            'audio' => 'Аудио консультация',
            'chat' => 'Чат консультация'
        ],
        ['prompt' => 'Выберите тип консультации']
    ) ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            'scheduled' => 'Запланирована',
            'completed' => 'Завершена',
            'canceled' => 'Отменена'
        ]
    ) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Отмена', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>