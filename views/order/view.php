<?php

use app\models\Order;
use yii\helpers\Html;

?>
<div class="order-view">
    <h1>Заказ #<?= $model->id ?></h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= Html::encode($model->service->name) ?></h4>
            <p class="card-text">
                <strong>Статус:</strong>
                <span class="badge bg-<?= $model->status == Order::STATUS_COMPLETED ? 'success' : 'warning' ?>">
                    <?= Order::getStatuses()[$model->status] ?>
                </span><br>

                <strong>Питомец:</strong> <?= Html::encode($model->pet->name) ?><br>
                <strong>Дата:</strong> <?= Yii::$app->formatter->asDate($model->requested_date) ?><br>
                <strong>Время:</strong> <?= $model->requested_time ?><br>
                <strong>Адрес:</strong> <?= nl2br(Html::encode($model->address)) ?><br>
                <strong>Цена:</strong> <?= $model->service->formattedPrice ?>
            </p>

            <?php if ($model->status == Order::STATUS_NEW): ?>
                <?= Html::a('Отменить заказ', ['cancel', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите отменить заказ?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</div>