<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Consultation;
?>

<div class="consultation-item mb-3 p-3 border rounded">
    <div class="d-flex justify-content-between">
        <div>
            <h5><?= Html::encode($model->veterinarian->user->username) ?></h5>
            <p class="mb-1">
                <strong>Дата:</strong> <?= Yii::$app->formatter->asDate($model->date) ?>
                в <?= $model->time ?>
            </p>
            <p class="mb-1">
                <strong>Питомец:</strong> <?= Html::encode($model->pet->name) ?>
            </p>
            <p class="mb-1">
                <strong>Тип:</strong>
                <?= $model->getTypeLabel() ?>
            </p>
        </div>
        <div class="text-right">
            <span class="badge badge-<?= $model->status == 'confirmed' ? 'success' : 'warning' ?>">
                <?= $model->getStatusLabel() ?>
            </span>
            <div class="mt-2">
                <?= Html::a('Подробнее', ['consultation/index', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-outline-primary']) ?>
                <?php if ($model->status == 'pending'): ?>
                    <?= Html::a('Отменить', ['consultation/cancel', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите отменить консультацию?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>