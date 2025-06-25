<?php
use app\models\Pet;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<style>
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        margin-top: 50px;
    }

    .card {
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
        border: none;
        margin-bottom: 30px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 90, 180, 0.15);
    }

    .card-header {
        background: linear-gradient(to right, var(--primary-dark), var(--primary));
        color: white;
        padding: 15px 25px;
        border-bottom: none;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }

    .user-profile-card .card-header {
        background: linear-gradient(to right, #1a4580, #2c6fd1);
    }

    .pets-card .card-header {
        /*background: linear-gradient(to right, #2a6e49, #4caf50);*/
    }

    .consultations-card .card-header {
        background: linear-gradient(to right, #1a6e80, #2ca0d1);
    }

    .medical-card .card-header {
        /*background: linear-gradient(to right, #d18e2c, #ffb347);*/
    }

    .card-title {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 600;
    }

    .user-info {
        padding: 25px;
        background: white;
    }

    .user-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a4580;
        margin-bottom: 10px;
    }

    .user-email {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .btn-edit {
        background: transparent;
        border: 2px solid #2c6fd1;
        color: #2c6fd1;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-edit:hover {
        background: #2c6fd1;
        color: white;
        transform: translateY(-3px);
    }

    .pets-list {
        padding: 0;
    }

    .pet-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        text-decoration: none;
        color: #2a4a75;
        transition: all 0.2s;
    }

    .pet-item:hover {
        background: #f8fafd;
        transform: translateX(5px);
    }

    .pet-item:last-child {
        border-bottom: none;
    }

    .pet-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e6f0ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #2c6fd1;
        font-size: 1.5rem;
    }

    .pet-info {
        flex: 1;
    }

    .pet-name {
        font-weight: 600;
        margin-bottom: 3px;
        font-size: 1.1rem;
    }

    .pet-details {
        display: flex;
        gap: 15px;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .btn-add-pet {
        background: #4c74af;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
    }

    .btn-add-pet:hover {
        background: #3b7ee0;
        transform: translateY(-3px);
    }

    .btn-add-pet i {
        font-size: 1.2rem;
    }

    .empty-pets {
        text-align: center;
        padding: 30px;
        color: #6c757d;
    }

    .empty-pets i {
        font-size: 3rem;
        color: #e9ecef;
        margin-bottom: 15px;
    }

    .consultation-list {
        padding: 0;
    }

    .consultation-item {
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.2s;
    }

    .consultation-item:hover {
        background: #f8fafd;
    }

    .consultation-title {
        font-weight: 600;
        color: #1a4580;
        margin-bottom: 5px;
    }

    .consultation-details {
        display: flex;
        gap: 20px;
        color: #6c757d;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .consultation-pet {
        display: inline-block;
        background: #e6f0ff;
        color: #2c6fd1;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .medical-actions {
        padding: 20px;
    }

    .btn-medical {
        background-color: #0058e0;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
    }

    .btn-medical:hover {
        background-color: #0058e0;
        transform: translateY(-3px);
    }

    .btn-medical i {
        font-size: 1rem;
    }

    .btn-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .dropdown-menu {
        background: #0058e0;

        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: none;
        padding: 10px;
    }

    .dropdown-item {
        background-color: #0058e0;

        padding: 8px 15px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
            background: #0058e0;
        color: #2c6fd1;
    }

    .pet-type-icon {
        margin-right: 5px;
    }

    @media (max-width: 992px) {
        .row {
            flex-direction: column;
            gap: 30px;
        }

        .col-md-4, .col-md-8 {
            width: 100%;
            max-width: 100%;
        }
    }
</style>

<div class="profile-container">
    <div class="row">
        <div class="col-md-4">
            <!-- Блок информации о пользователе -->
            <div class="card user-profile-card">
                <div class="card-header">
                    <h3 class="card-title">Мой профиль</h3>
                </div>
                <div class="user-info">
                    <h4 class="user-name"><?= Html::encode($user->username) ?></h4>
                    <p class="user-email"><?= Html::encode($user->email) ?></p>
                    <?= Html::a('Редактировать профиль', ['update'], ['class' => 'btn btn-edit']) ?>
                </div>
            </div>

            <!-- Блок питомцев -->
            <div class="card pets-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Мои питомцы</h3>
                        <?= Html::a('<i class="fas fa-plus"></i>', ['profile/add-pet'], ['class' => 'btn btn-light btn-sm']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($pets): ?>
                        <div class="pets-list">
                            <?php foreach ($pets as $pet): ?>
                                <a href="<?= Url::to(['', 'id' => $pet->id]) ?>" class="pet-item">
                                    <div class="pet-avatar">
                                        <?php if ($pet->type == 'dog'): ?>
                                            <i class="fas fa-dog"></i>
                                        <?php else: ?>
                                            <i class="fas fa-cat"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pet-info">
                                        <div class="pet-name"><?= Html::encode($pet->name) ?></div>
                                        <div class="pet-details">
                                            <span><?= $pet->age ?> лет</span>
                                            <span><?= Html::encode($pet->breed) ?></span>
                                            <span>
                                                <?php if ($pet->type == 'dog'): ?>
                                                    <i class="fas fa-dog pet-type-icon"></i>Собака
                                                <?php else: ?>
                                                    <i class="fas fa-cat pet-type-icon"></i>Кошка
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-pets">
                            <i class="fas fa-paw"></i>
                            <p>У вас пока нет питомцев</p>
                            <?= Html::a('<i class="fas fa-plus"></i> Добавить питомца', ['profile/add-pet'], ['class' => 'btn btn-add-pet']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Блок предстоящих консультаций -->
            <div class="card consultations-card">
                <div class="card-header">
                    <h3 class="card-title">Ближайшие консультации</h3>
                </div>
                <div class="card-body">
                    <?= ListView::widget([
                        'dataProvider' => $consultationsProvider,
                        'itemView' => '_consultation_item',
                        'layout' => "{items}\n{pager}",
                        'emptyText' => '<div class="empty-pets"><i class="fas fa-calendar-check"></i><p>У вас нет предстоящих консультаций</p></div>',
                        'emptyTextOptions' => ['class' => 'text-center'],
                        'itemOptions' => ['class' => 'consultation-item'],
                        'options' => ['class' => 'consultation-list']
                    ]) ?>
                </div>
            </div>

            <!-- Блок медицинских записей -->
            <div class="card medical-card">
                <div class="card-header">
                    <h3 class="card-title">Медицинские записи</h3>
                </div>
                <div class="medical-actions">
                    <?php
                    $pets = Pet::find()
                        ->where(['user_id' => Yii::$app->user->id])
                        ->all();

                    if ($pets): ?>
                        <div class="btn-group">
                            <?= Html::a('<i class="fas fa-notes-medical"></i> Все записи', ['medical/index'], [
                                'class' => 'btn btn-medical'
                            ]) ?>

                            <div class="dropdown">
                                <!-- Добавляем обработчик событий для Bootstrap -->
                                <?php \yii\bootstrap5\BootstrapAsset::register($this); ?>

                                <!-- Исправленная кнопка с правильными атрибутами -->
                                <button class="btn btn-medical dropdown-toggle"
                                        type="button"
                                        id="addRecordDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <i class="fas fa-plus"></i> Добавить запись
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="addRecordDropdown">
                                    <?php if (!empty($pets)): ?>
                                        <?php foreach ($pets as $pet): ?>
                                            <li>
                                                <a class="dropdown-item" href="<?= Url::to(['medical/add-record', 'pet_id' => $pet->id]) ?>">
                                                    <?php if ($pet->type): ?>
                                                        <i class="fas fa-dog me-2"></i>
                                                    <?php else: ?>
                                                        <i class="fas fa-cat me-2"></i>
                                                    <?php endif; ?>
                                                    <?= Html::encode($pet->name) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li><span class="dropdown-item text-muted">Нет доступных питомцев</span></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="empty-pets">
                            <i class="fas fa-paw"></i>
                            <p>У вас пока нет питомцев</p>
                            <?= Html::a('<i class="fas fa-plus"></i> Добавить питомца', ['profile/add-pet'], ['class' => 'btn btn-add-pet']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>