<div class="order-index">
    <h1>Мои заказы</h1>

    <div class="orders-list">
        <?php use app\models\Order;
        use yii\helpers\Html;

        foreach ($orders as $order): ?>
            <div class="card mb-3">
                <div class="card-header">
                    Заказ #<?= $order->id ?> - <?= Yii::$app->formatter->asDate($order->created_at) ?>
                    <span class="badge bg-<?= $order->status == Order::STATUS_COMPLETED ? 'success' : 'warning' ?> float-end">
                        <?= Order::getStatuses()[$order->status] ?>
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= Html::encode($order->service->name) ?></h5>
                    <p class="card-text">
                        <strong>Питомец:</strong> <?= Html::encode($order->pet->name) ?><br>
                        <strong>Дата оказания:</strong> <?= Yii::$app->formatter->asDate($order->requested_date) ?> в <?= $order->requested_time ?>
                    </p>
                    <?= Html::a('Подробнее', ['view', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>