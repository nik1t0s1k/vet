<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
            <?= Yii::$app->formatter->asDate($model->record_date) ?>
        </h3>
        <div>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id],
                ['class' => 'btn btn-sm btn-outline-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-sm btn-outline-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту запись?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Описание</h5>
                <p><?= nl2br(Html::encode($model->description)) ?></p>
            </div>
            <div class="col-md-6">
                <h5>Лечение</h5>
                <p><?= nl2br(Html::encode($model->treatment)) ?></p>
            </div>
        </div>
        <?php if ($model->veterinarian): ?>
            <div class="mt-3">
                <small class="text-muted">
                    Ветеринар: <?= Html::encode($model->veterinarian->user->username) ?>
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>