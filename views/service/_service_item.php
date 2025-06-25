<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>



    <div class="card-bo">
        <h4 class="card-title"><?= Html::encode($model->name) ?></h4>
        <span class="badge bg-primary mb-2"><?= $model->categoryLabel ?></span>
        <p class="card-text"><?= Html::encode(mb_substr($model->description, 0, 100)) ?>...</p>
        <h5 class="text-success"><?= $model->formattedPrice ?></h5>
    </div>

    <div class="card-footer bg-white d-flex justify-content-between">
        <?= Html::a(
            '<i class="fas fa-info-circle"></i> Подробнее',
            ['view', 'id' => $model->id],
            ['class' => 'btn btn-outline-primary']
        ) ?>

        <?= Html::a(
            '<i class="fas fa-shopping-cart"></i> Заказать',
            ['order/create', 'service_id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    </div>
</div>