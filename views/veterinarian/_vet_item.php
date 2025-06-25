<?php // Виджет карточки ветеринара (_vet_item.php)
use yii\helpers\Html; ?>
<div class="vets-card h-100">
    <div class="vets-card-body">
        <div class="vets-card-header">
            <div class="vets-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6c757d" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </div>
            <div>
                <h5 class="vets-name"><?= Html::encode($model->user->username ?? 'Ветеринар') ?></h5>
                <span class="vets-specialization"><?= Html::encode($model->specialization) ?></span>
            </div>
        </div>

        <div class="vets-qualification">
            <p><?= Html::encode($model->qualification) ?></p>
        </div>

        <div class="vets-footer">
            <div class="vets-rating">
                <?php
                $fullStars = round($model->rating);
                for ($i = 1; $i <= 5; $i++):
                    $color = $i <= $fullStars ? 'vets-star-full' : 'vets-star-empty';
                    ?>
                    <span class="vets-star <?= $color ?>">★</span>
                <?php endfor; ?>
                <span class="vets-rating-value">(<?= $model->rating ?>)</span>
            </div>
            <?= Html::a('Записаться', ['consultation/book', 'vet_id' => $model->id], [
                'class' => 'vets-btn'
            ]) ?>
        </div>
    </div>
</div>