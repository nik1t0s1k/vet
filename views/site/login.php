<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход в VetCare';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #e6f0ff 0%, #f0f7ff 100%);
        padding: 20px;
    }

    .login-form {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 70, 150, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 500px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .login-form:hover {
        box-shadow: 0 15px 40px rgba(0, 90, 180, 0.15);
    }

    .form-title {
        color: #1a4580;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        position: relative;
        z-index: 2;
    }

    .form-title:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: #2c6fd1;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2a4a75;
    }

    .form-input {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid #e0e8f5;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s;
        background-color: #f8fafd;
    }

    .form-input:focus {
        border-color: #2c6fd1;
        box-shadow: 0 0 0 3px rgba(44, 111, 209, 0.2);
        outline: none;
        background-color: white;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 40px;
        color: #2c6fd1;
        font-size: 20px;
        z-index: 3;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        margin: 20px 0 30px;
        position: relative;
        z-index: 2;
    }

    .custom-checkbox {
        width: 22px;
        height: 22px;
        border: 2px solid #2c6fd1;
        border-radius: 5px;
        margin-right: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: white;
    }

    .custom-checkbox.checked:after {
        content: '✓';
        color: #2c6fd1;
        font-weight: bold;
        font-size: 16px;
    }

    .checkbox-label {
        color: #2a4a75;
        line-height: 1.5;
        font-size: 16px;
        cursor: pointer;
    }

    .submit-btn {
        background: linear-gradient(to right, #1a4580, #2c6fd1);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 16px;
        font-size: 18px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(26, 69, 128, 0.3);
        position: relative;
        z-index: 2;
        margin-bottom: 20px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(26, 69, 128, 0.4);
        background: linear-gradient(to right, #1a4580, #3a7af0);
    }

    .submit-btn:active {
        transform: translateY(-1px);
    }

    .paw-decoration {
        position: absolute;
        opacity: 0.05;
        font-size: 120px;
        z-index: 1;
        pointer-events: none;
        color: #1a4580;
    }

    .paw1 { top: 20px; right: 30px; transform: rotate(25deg); }
    .paw2 { bottom: 50px; left: 30px; transform: rotate(-15deg); }

    .watermark {
        position: absolute;
        bottom: 20px;
        right: 20px;
        opacity: 0.1;
        font-size: 100px;
        z-index: 1;
        transform: rotate(-15deg);
        pointer-events: none;
        color: #1a4580;
    }

    .links-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        text-align: center;
        margin-top: 20px;
        position: relative;
        z-index: 2;
    }

    .link {
        color: #2c6fd1;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }

    .link:hover {
        text-decoration: underline;
        color: #1a4580;
    }

    @media (max-width: 576px) {
        .login-form {
            padding: 30px 20px;
        }

        .watermark {
            font-size: 70px;
            bottom: 10px;
            right: 10px;
        }
    }
</style>

<div class="login-container">
    <div class="login-form">
        <div class="paw-decoration paw1">🐾</div>
        <div class="paw-decoration paw2">🐾</div>
        <div class="watermark">VetCare</div>

        <h2 class="form-title">Вход в VetCare</h2>

        <p style="text-align: center; color: #2a4a75; margin-bottom: 30px; position: relative; z-index: 2;">
            Пожалуйста, заполните поля ниже для входа в систему
        </p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['autocomplete' => 'off'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group'],
            ]
        ]); ?>

        <div class="form-group">
            <label class="form-label">Имя пользователя</label>
            <div class="input-icon">👤</div>
            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'class' => 'form-input',
                    'placeholder' => 'Введите ваше имя'
                ]
            ])->textInput(['autofocus' => true])->label(false) ?>
        </div>

        <div class="form-group">
            <label class="form-label">Пароль</label>
            <div class="input-icon">🔒</div>
            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'class' => 'form-input',
                    'placeholder' => 'Введите ваш пароль'
                ]
            ])->passwordInput()->label(false) ?>
        </div>

        <div class="checkbox-container">
            <div class="custom-checkbox" id="rememberCheckbox"></div>
            <?= $form->field($model, 'rememberMe', [
                'options' => ['class' => 'd-none'],
                'template' => "{input}"
            ])->checkbox([
                'id' => 'rememberMe',
                'class' => 'd-none'
            ]) ?>
            <label class="checkbox-label" for="rememberCheckbox">
                Запомнить меня
            </label>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Войти', [
                'class' => 'submit-btn',
                'name' => 'login-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="links-container">
            <a href="#" class="link">Забыли пароль?</a>
            <a href="../site/signup" class="link">Регистрация нового аккаунта</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Кастомный чекбокс "Запомнить меня"
        const rememberCheckbox = document.getElementById('rememberMe');
        const customCheckbox = document.getElementById('rememberCheckbox');

        customCheckbox.addEventListener('click', function() {
            rememberCheckbox.checked = !rememberCheckbox.checked;
            customCheckbox.classList.toggle('checked', rememberCheckbox.checked);
        });

        // Инициализация состояния
        customCheckbox.classList.toggle('checked', rememberCheckbox.checked);
    });
</script>