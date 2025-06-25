<?php
use app\models\Service;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<style>
    .order-create-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .order-header {
        background: linear-gradient(135deg, #1a4580 0%, #2c6fd1 100%);
        color: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 90, 180, 0.2);
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .order-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .service-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .service-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .service-info {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 10px;
    }

    .service-category, .service-price {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .order-form-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
        padding: 40px;
        margin-bottom: 40px;
        position: relative;
    }

    .form-title {
        text-align: center;
        color: #1a4580;
        font-size: 1.8rem;
        margin-bottom: 30px;
        position: relative;
    }

    .form-title:after {
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
        position: relative;
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

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .datetime-group {
        display: flex;
        gap: 20px;
    }

    .datetime-group .form-group {
        flex: 1;
    }

    .submit-container {
        text-align: center;
        margin-top: 40px;
    }

    .btn-submit {
        background: linear-gradient(to right, #ff8e4d, #ff6b6b);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 50px;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(255, 111, 107, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(255, 111, 107, 0.5);
        background: linear-gradient(to right, #ff7a3d, #ff5757);
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
        .order-header {
            padding: 30px 20px;
        }

        .order-header h1 {
            font-size: 1.8rem;
        }

        .datetime-group {
            flex-direction: column;
            gap: 25px;
        }

        .order-form-container {
            padding: 30px 20px;
        }
    }
</style>

<div class="order-create-container">
    <div class="order-header">
        <h1>Оформление заказа</h1>
        <div class="service-card">
            <div class="service-name"><?= Html::encode($service->name) ?></div>
            <div class="service-info">
                <div class="service-category"><?= Html::encode($service->getCategoryLabel()) ?></div>
                <div class="service-price"><?= number_format($service->price, 0, ',', ' ') ?> ₽</div>
            </div>
        </div>
    </div>

    <div class="order-form-container">
        <div class="paw-decoration paw1">🐾</div>
        <div class="paw-decoration paw2">🐾</div>

        <h2 class="form-title">Данные для записи</h2>

        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'help-block text-danger']
            ]
        ]); ?>

        <div class="form-group">
            <?= $form->field($model, 'pet_id')->dropDownList(
                ArrayHelper::map($pets, 'id', 'name'),
                ['prompt' => 'Выберите питомца']
            ) ?>
        </div>

        <div class="datetime-group">
            <div class="form-group">
                <?= $form->field($model, 'requested_date')->input('date', [
                    'min' => date('Y-m-d'),
                    'class' => 'form-control'
                ]) ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'requested_time')->dropDownList([
                    '09:00' => '09:00',
                    '10:00' => '10:00',
                    '11:00' => '11:00',
                    '12:00' => '12:00',
                    '13:00' => '13:00',
                    '14:00' => '14:00',
                    '15:00' => '15:00',
                    '16:00' => '16:00',
                    '17:00' => '17:00',
                ], ['prompt' => 'Выберите время', 'class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'address')->textarea(['rows' => 3, 'placeholder' => 'Укажите адрес, по которому будет оказана услуга']) ?>
        </div>

        <div class="submit-container">
            <?= Html::submitButton('<i class="fas fa-calendar-check"></i> Подтвердить заказ', ['class' => 'btn-submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>