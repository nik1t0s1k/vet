<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Consultation */

$this->title = 'Консультация #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Мои консультации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Дата и время',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->date && $model->time) {
                        $datetime = $model->date . ' ' . $model->time;
                        return Yii::$app->formatter->asDatetime($datetime, 'php:d.m.Y H:i');
                    }
                    return 'Дата не указана';
                },
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $class = $model->status == 'completed' ? 'success' : 'warning';
                        $text = $model->status == 'completed' ? 'Завершена' : 'Запланирована';
                        return "<span class='badge bg-$class'>$text</span>";
                    },
                ],
                [
                    'label' => 'Ветеринар',
                    'value' => function ($model) {
                        return $model->veterinarian->user->username ?? 'Не указан';
                    },
                ],
                [
                    'label' => 'Питомец',
                    'value' => function ($model) {
                        return $model->pet->name ?? 'Не указан';
                    },
                ],
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        return match ($model->type) {
                            'video' => 'Видео',
                            'audio' => 'Аудио',
                            default => $model->type ?: 'Не указан',
                        };
                    },
                ],
                // Добавьте другие поля при необходимости
            ],
        ]) ?>

    <div class="mt-3">
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-secondary']) ?>

        <?php if ($model->user_id == Yii::$app->user->id): ?>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

</div>