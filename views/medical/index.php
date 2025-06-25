<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<div class="medical-index">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Медицинская история</h1>

            <?php if (count($userPets) > 1): ?>
                <div class="btn-group mt-2">
                    <?php foreach ($userPets as $userPet): ?>
                        <a href="<?= Url::to(['index', 'pet_id' => $userPet->id]) ?>"
                           class="btn btn-sm btn-<?= $pet->id == $userPet->id ? 'primary' : 'outline-secondary' ?>">
                            <?= Html::encode($userPet->name) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <?= Html::a('Добавить запись', ['add-record', 'pet_id' => $pet->id],
                ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><?= Html::encode($pet->name) ?></h2>
        </div>
        <div class="card-body">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_record',
                'layout' => "{items}\n{pager}",
                'emptyText' => 'Нет медицинских записей.',
                'emptyTextOptions' => ['class' => 'alert alert-info'],
                'options' => ['class' => 'medical-records'],
                'itemOptions' => ['class' => 'record-item'],
            ]) ?>
        </div>
    </div>
</div>