<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="' . Yii::getAlias('@web') . '/image/logo.png" style="display: inline; vertical-align: top; height:70px;"> ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar navbar-dark fixed-top',
        ]
    ]);

    $menuItems = [
        ['label' => 'Услуги', 'url' => ['/service/index']],
        ['label' => 'Ветеринары', 'url' => ['/veterinarian/index']],
        ['label' => 'База знаний', 'url' => ['/knowledge-base/index']],
        ['label' => 'Медкарта', 'url' => ['/medical/index'], 'visible' => !Yii::$app->user->isGuest]
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Мой профиль', 'url' => ['/profile/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link text-light']
            )
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>О клинике</h3>
                <p>VetCare — современная ветеринарная клиника с полным спектром услуг для ваших питомцев. Профессионализм, любовь и забота.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-vk"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Наши услуги</h3>
                <ul class="footer-links">
                    <li><a href="#">Консультация врача</a></li>
                    <li><a href="#">Вакцинация</a></li>
                    <li><a href="#">Хирургия</a></li>
                    <li><a href="#">Стоматология</a></li>
                    <li><a href="#">Диагностика</a></li>
                    <li><a href="#">Груминг</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Часы работы</h3>
                <ul class="footer-links">
                    <li>Понедельник-Пятница: 8:00 - 22:00</li>
                    <li>Суббота: 9:00 - 20:00</li>
                    <li>Воскресенье: 10:00 - 18:00</li>
                    <li>Экстренная помощь: 24/7</li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            &copy; 2023 VetCare Ветеринарная клиника. Все права защищены.
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
