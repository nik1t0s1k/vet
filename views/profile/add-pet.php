<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<style>
    .add-pet-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
    }

    .add-pet-header {
        background: linear-gradient(135deg, #1a4580 0%, #2c6fd1 100%);
        color: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 90, 180, 0.2);
        margin-bottom: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .add-pet-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .add-pet-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    .pet-form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
        padding: 40px;
        margin-bottom: 40px;
        position: relative;
    }

    .pet-form-title {
        text-align: center;
        color: #1a4580;
        font-size: 1.8rem;
        margin-bottom: 30px;
        position: relative;
    }

    .pet-form-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #2c6fd1;
        margin: 15px auto 0;
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2a4a75;
        padding-left: 30px;
    }

    .form-label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: #e6f0ff;
        border-radius: 50%;
    }

    .form-label:after {
        content: '';
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        background-color: #2c6fd1;
        border-radius: 50%;
    }

    .form-control {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #e0e8f5;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f8fafd;
    }

    .form-control:focus {
        border-color: #2c6fd1;
        box-shadow: 0 0 0 3px rgba(44, 111, 209, 0.2);
        outline: none;
        background-color: white;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232c6fd1' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
        padding-right: 45px;
    }

    .submit-container {
        text-align: center;
        margin-top: 40px;
    }

    .btn-submit {
        background: linear-gradient(to right, #2a6e49, #4caf50);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(42, 110, 73, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(42, 110, 73, 0.5);
        background: linear-gradient(to right, #2a6e49, #3d8b40);
    }

    .btn-submit:active {
        transform: translateY(-2px);
    }

    .paw-decoration {
        position: absolute;
        opacity: 0.05;
        font-size: 120px;
        z-index: 1;
        pointer-events: none;
        color: #1a4580;
    }

    .paw1 { top: 20px; left: 30px; transform: rotate(-15deg); }
    .paw2 { bottom: 50px; right: 30px; transform: rotate(25deg); }

    @media (max-width: 768px) {
        .add-pet-container {
            padding: 15px;
        }

        .add-pet-header {
            padding: 30px 20px;
        }

        .pet-form-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="add-pet-container">
    <div class="add-pet-header">
        <h1>Добавить нового питомца</h1>
        <p>Расскажите нам о вашем любимце, чтобы мы могли предоставить ему лучший уход</p>
    </div>

    <div class="pet-form-card">
        <div class="paw-decoration paw1">🐾</div>
        <div class="paw-decoration paw2">🐾</div>

        <h2 class="pet-form-title">Информация о питомце</h2>

        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'help-block text-danger']
            ]
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Введите кличку питомца']) ?>

        <?= $form->field($model, 'type')->dropDownList(
            [
                'dog' => 'Собака',
                'cat' => 'Кошка',
                'bird' => 'Птица',
                'other' => 'Другое',
            ],
            ['prompt' => 'Выберите тип питомца', 'class' => 'form-control']
        ) ?>

        <?= $form->field($model, 'breed')->textInput(['placeholder' => 'Укажите породу питомца']) ?>

        <?= $form->field($model, 'age')->textInput([
            'type' => 'number',
            'placeholder' => 'Возраст в годах',
            'min' => 0,
            'max' => 30
        ]) ?>

        <?= $form->field($model, 'weight')->textInput([
            'type' => 'number',
            'step' => '0.1',
            'placeholder' => 'Вес в кг',
            'min' => 0.1,
            'max' => 100
        ]) ?>

        <div class="submit-container">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Сохранить питомца
            </button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>























