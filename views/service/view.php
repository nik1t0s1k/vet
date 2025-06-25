<?php
use yii\helpers\Html;
?>

<style>
    .service-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .service-header {
        background: linear-gradient(135deg, #1a4580 0%, #2c6fd1 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 90, 180, 0.2);
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .service-header:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' opacity='0.1'%3E%3Cpath d='M20,20 Q40,5 50,30 T90,30' fill='none' stroke='white' stroke-width='2'/%3E%3Ccircle cx='30' cy='70' r='5' fill='white'/%3E%3Ccircle cx='70' cy='50' r='3' fill='white'/%3E%3C/svg%3E");
        background-size: 300px;
        opacity: 0.3;
    }

    .service-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }

    .service-category-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 1rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }

    .service-content {
        display: flex;
        gap: 40px;
        margin-bottom: 40px;
    }

    .service-info {
        flex: 1;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
        padding: 30px;
        position: relative;
        z-index: 2;
    }

    .service-info-section {
        margin-bottom: 30px;
    }

    .info-label {
        display: block;
        color: #2c6fd1;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 8px;
        position: relative;
        padding-left: 30px;
    }

    .info-label:before {
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

    .info-label:after {
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

    .info-value {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #2a4a75;
        padding-left: 30px;
    }

    .service-price {
        background: linear-gradient(to right, #1a4580, #2c6fd1);
        color: white;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        margin-top: 20px;
    }

    .price-label {
        font-size: 1.2rem;
        margin-bottom: 10px;
        opacity: 0.9;
    }

    .price-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .service-image {
        flex: 1;
        background: #f0f7ff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
        min-height: 400px;
        overflow: hidden;
        position: relative;
    }

    .service-image-placeholder {
        text-align: center;
        color: #a0b6e0;
        padding: 20px;
    }

    .service-image-placeholder i {
        font-size: 6rem;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .service-image-placeholder p {
        font-size: 1.2rem;
        max-width: 300px;
        margin: 0 auto;
    }

    .action-section {
        text-align: center;
        margin-top: 40px;
        position: relative;
        z-index: 2;
    }

    .btn-order {
        background: linear-gradient(to right, #ff8e4d, #ff6b6b);
        color: white;
        border: none;
        padding: 16px 40px;
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

    .btn-order:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(255, 111, 107, 0.5);
    }

    .btn-order:active {
        transform: translateY(-2px);
    }

    .watermark {
        position: absolute;
        bottom: 40px;
        right: 40px;
        opacity: 0.05;
        font-size: 120px;
        z-index: 1;
        transform: rotate(-15deg);
        pointer-events: none;
        color: #1a4580;
        font-weight: 700;
        font-family: 'Montserrat', sans-serif;
    }

    @media (max-width: 992px) {
        .service-content {
            flex-direction: column-reverse;
        }

        .service-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .service-header {
            padding: 40px 20px;
        }

        .service-title {
            font-size: 1.8rem;
        }

        .price-value {
            font-size: 2rem;
        }
    }
</style>

<div class="service-detail-container">
    <div class="service-header">
        <div class="watermark">VetCare</div>
        <h1 class="service-title"><?= Html::encode($service->name) ?></h1>
        <div class="service-category-badge"><?= Html::encode($service->getCategoryLabel()) ?></div>
    </div>

    <div class="service-content">
        <div class="service-info">
            <div class="service-info-section">
                <span class="info-label">Описание услуги</span>
                <p class="info-value"><?= nl2br(Html::encode($service->description)) ?></p>
            </div>

            <div class="service-info-section">
                <span class="info-label">Категория</span>
                <p class="info-value"><?= Html::encode($service->getCategoryLabel()) ?></p>
            </div>

            <div class="service-info-section">
                <span class="info-label">Длительность</span>
                <p class="info-value">30-60 минут (в зависимости от сложности)</p>
            </div>

            <div class="service-info-section">
                <span class="info-label">Для каких животных</span>
                <p class="info-value">Собаки, кошки, грызуны, птицы</p>
            </div>

            <div class="service-price">
                <div class="price-label">Стоимость услуги</div>
                <div class="price-value"><?= number_format($service->price, 0, ',', ' ') ?> ₽</div>
                <p>Включен первичный осмотр и консультация</p>
            </div>
        </div>

        <div class="service-image">
            <div class="service-image-placeholder">
                <i class="fas fa-paw"></i>
                <p>Изображение услуги</p>
            </div>
        </div>
    </div>

    <div class="action-section">
        <?= Html::a('<i class="fas fa-calendar-check"></i> Заказать услугу', ['/order/create', 'service_id' => $service->id], [
            'class' => 'btn-order',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>