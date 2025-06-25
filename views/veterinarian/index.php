<?php
use yii\widgets\ListView; ?>
<div class="vets-container py-4">
    <h1 class="vets-title text-center mb-5 fw-bold">Наши ветеринары</h1>

    <div class="vets-list row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_vet_item',
            'layout' => "{items}\n<div class='vets-pagination mt-5'>{pager}</div>",
            'options' => ['class' => 'vets-list-view row g-4'],
            'itemOptions' => ['class' => 'vets-col col-lg-4 col-md-6'],
        ]) ?>
    </div>
</div>