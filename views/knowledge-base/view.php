<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'База знаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$categoryIcons = [
    'care' => 'fas fa-bath',
    'education' => 'fas fa-graduation-cap',
    'nutrition' => 'fas fa-utensils',
    'health' => 'fas fa-heartbeat',
];
?>

<div class="knowledge-base-view">
    <div class="container py-4">
        <article class="kb-article">
            <div class="text-center mb-5">
                <h1 class="display-5 mb-3"><?= Html::encode($model->title) ?></h1>

                <div class="d-flex justify-content-center flex-wrap gap-3 mb-3">
                    <span class="badge bg-primary">
                        <i class="<?= $model->type === 'article' ? 'fas fa-file-alt' : 'fas fa-video' ?> me-1"></i>
                        <?= $model->getTypeLabel() ?>
                    </span>

                    <span class="badge bg-light text-dark">
                        <i class="<?= $categoryIcons[$model->category] ?? 'fas fa-paw' ?> me-1"></i>
                        <?= $model->getCategoryLabel() ?>
                    </span>

                    <span class="text-muted">
                        <i class="far fa-calendar me-1"></i>
                        <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
                    </span>
                </div>
            </div>

            <?php if ($model->cover_image): ?>
                <div class="mb-5 text-center">
                    <?= Html::img(
                        Yii::getAlias('@web/uploads/knowledge/') . $model->cover_image,
                        [
                            'class' => 'img-fluid rounded shadow',
                            'alt' => $model->title,
                            'style' => 'max-height: 500px;'
                        ]
                    ) ?>
                </div>
            <?php endif; ?>

            <div class="kb-content mb-5">
                <?php if ($model->type === 'video' && $model->getVideoEmbedUrl()): ?>
                    <div class="ratio ratio-16x9 mb-5">
                        <iframe
                            src="<?= $model->getVideoEmbedUrl() ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                <?php endif; ?>

                <div class="kb-text-content">
                    <?= $model->content ?>
                </div>
            </div>

            <div class="kb-share mt-5 pt-4 border-top">
                <h4 class="h5 mb-3">Поделиться статьей:</h4>
                <div class="d-flex gap-2">
                    <a href="https://vk.com/share.php?url=<?= Url::to(['view', 'id' => $model->id], true) ?>&title=<?= $model->title ?>"
                       target="_blank" class="btn btn-social btn-vk">
                        <i class="fab fa-vk"></i> VKontakte
                    </a>
                    <a href="https://t.me/share/url?url=<?= Url::to(['view', 'id' => $model->id], true) ?>&text=<?= $model->title ?>"
                       target="_blank" class="btn btn-social btn-telegram">
                        <i class="fab fa-telegram-plane"></i> Telegram
                    </a>
                </div>
            </div>
        </article>

        <div class="mt-5 text-center">
            <a href="<?= Url::to(['index']) ?>" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Вернуться к базе знаний
            </a>
        </div>
    </div>
</div>