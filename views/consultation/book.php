<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pet;
?>

    <div class="consultation-book">
        <h1>Запись на консультацию к <?= Html::encode($vet->user->username) ?></h1>

        <div class="vet-info mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?= Html::encode($vet->user->username) ?></h3>
                    <p class="card-text">
                        <strong>Специализация:</strong> <?= Html::encode($vet->specialization) ?><br>
                        <strong>Квалификация:</strong> <?= Html::encode($vet->qualification) ?><br>
                        <strong>Опыт работы:</strong> <?= $vet->experience ?> лет<br>
                        <strong>Рейтинг:</strong> <?= $vet->rating ?> ★
                    </p>
                </div>
            </div>
        </div>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'consultation-form'],
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'pet_id')->dropDownList(
                    ArrayHelper::map(Pet::find()->where(['user_id' => Yii::$app->user->id])->all(), 'id', 'name'),
                    [
                        'prompt' => 'Выберите питомца',
                        'class' => 'form-control'
                    ]
                ) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'type')->dropDownList([
                    'video' => 'Видеоконсультация',
                    'audio' => 'Аудиоконсультация',
                    'text' => 'Текстовая консультация'
                ], ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'date')->input('date', [
                    'min' => date('Y-m-d'),
                    'class' => 'form-control'
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'time')->input('time', [
                    'class' => 'form-control'
                ]) ?>
            </div>
        </div>

        <?= $form->field($model, 'notes')->textarea(['rows' => 4]) ?>

        <div class="form-group">
            <?= Html::submitButton('Записаться', ['class' => 'btn btn-primary btn-lg']) ?>
            <?= Html::a('Отмена', ['veterinarian/index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <style>
        .consultation-book {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 100px;
        }

        .vet-info .card {
            border-left: 4px solid #4e73df;
        }

        .consultation-form {
            margin-top: 30px;
        }

        .btn-lg {
            padding: 10px 30px;
        }
    </style>

<?php
$this->registerJs(<<<JS
// Автоматическая валидация даты
$('#consultation-date').change(function() {
    let selectedDate = new Date($(this).val());
    let today = new Date();
    today.setHours(0,0,0,0);
    
    if (selectedDate < today) {
        alert('Выберите дату в будущем');
        $(this).val('');
    }
});
JS
);
?>