<?php
function russianDate($date) {
    $months = [
        'January' => 'января',
        'February' => 'февраля',
        'March' => 'марта',
        'April' => 'апреля',
        'May' => 'мая',
        'June' => 'июня',
        'July' => 'июля',
        'August' => 'августа',
        'September' => 'сентября',
        'October' => 'октября',
        'November' => 'ноября',
        'December' => 'декабря'
    ];

    $englishDate = date('d F Y H:i', strtotime($date));
    return str_replace(array_keys($months), array_values($months), $englishDate);
}
?>

<h1>Мои консультации</h1>

<div class="consultation-list">
    <?php use yii\helpers\Html;
    use yii\helpers\StringHelper;

    foreach ($veterinarians as $consult): ?>

        <div class="card mb-3">
            <div class="card-header">
                <div class="card-header">
                    <?php if (!empty($consult->date) && !empty($consult->time)): ?>
                        <strong>Дата:</strong> <?= Yii::$app->formatter->asDate($consult->date) ?>
                        в <?= $consult->time ?>
                    <?php else: ?>
                        Дата не указана
                    <?php endif; ?>

                    <span class="badge bg-<?= $consult->status == 'completed' ? 'success' : 'warning' ?>">
                        <?= $consult->status == 'completed' ? 'Завершена' : 'Запланирована' ?>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    Ветеринар: <?= isset($consult->veterinarian->user->username)
                        ? Html::encode($consult->veterinarian->user->username)
                        : 'Не указан' ?>
                </h5>
                <p class="card-text">
                    Питомец: <?= isset($consult->pet->name)
                        ? Html::encode($consult->pet->name)
                        : 'Не указан' ?><br>
                    Тип: <?= $consult->type == 'video' ? 'Видео' :
                        ($consult->type == 'audio' ? 'Аудио' :
                            (!empty($consult->type) ? $consult->type : 'Не указан')) ?>
                </p>

                <!-- Блок для вывода жалобы клиента -->
                <?php if (!empty($consult->notes)): ?>
                    <div class="complaint-block mt-3">
                        <h6>Жалоба клиента:</h6>
                        <div class="complaint-text bg-light p-3 rounded">
                            <?= Html::encode($consult->notes) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?= Html::a('Подробнее', ['view', 'id' => $consult->id],
                    ['class' => 'btn btn-primary mt-3']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>