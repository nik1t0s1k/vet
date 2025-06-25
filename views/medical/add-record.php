<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="medical-record-form">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Добавить медицинскую запись</h1>

        <?php if (count($userPets) > 1): ?>
            <div class="btn-group">
                <?php foreach ($userPets as $userPet): ?>
                    <a href="<?= Url::to(['add-record', 'pet_id' => $userPet->id]) ?>"
                       class="btn btn-sm btn-<?= $pet->id == $userPet->id ? 'primary' : 'outline-secondary' ?>">
                        <?= Html::encode($userPet->name) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Для питомца: <?= Html::encode($pet->name) ?></h2>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'record_date')->input('date') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'veterinarian_id')->dropDownList(
                        \app\models\Veterinarian::getList(),
                        ['prompt' => 'Выберите ветеринара']
                    ) ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'treatment')->textarea(['rows' => 4]) ?>

            <div class="form-group mt-4">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Отмена', ['index', 'pet_id' => $pet->id], ['class' => 'btn btn-outline-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>