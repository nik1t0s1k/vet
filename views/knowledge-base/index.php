<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'База знаний для владельцев животных';
$this->params['breadcrumbs'][] = $this->title;

// Иконки для категорий (можно использовать Font Awesome)
$categoryIcons = [
    'care' => 'fas fa-bath',
    'education' => 'fas fa-graduation-cap',
    'nutrition' => 'fas fa-utensils',
    'health' => 'fas fa-heartbeat',
];
?>

<div class="knowledge-base-index">
    <div class="kb-header text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 mb-4"><?= Html::encode($this->title) ?></h1>
            <p class="lead">Полезные статьи и видеоуроки по уходу, воспитанию, питанию и здоровью ваших питомцев</p>
        </div>
    </div>

    <div class="container">
        <!-- Фильтры -->
        <div class="kb-filters mb-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h3 class="h5 mb-3">Категории</h3>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($categories as $key => $name): ?>
                                    <a href="<?= Url::current(['category' => $key]) ?>"
                                       class="btn btn-sm <?= $currentCategory == $key ? 'btn-primary' : 'btn-outline-primary' ?>">
                                        <i class="<?= $categoryIcons[$key] ?? 'fas fa-paw' ?> me-1"></i>
                                        <?= $name ?>
                                    </a>
                                <?php endforeach; ?>
                                <?php if ($currentCategory): ?>
                                    <a href="<?= Url::current(['category' => null]) ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Сбросить
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h3 class="h5 mb-3">Тип контента</h3>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($types as $key => $name): ?>
                                    <a href="<?= Url::current(['type' => $key]) ?>"
                                       class="btn btn-sm <?= $currentType == $key ? 'btn-info' : 'btn-outline-info' ?>">
                                        <i class="<?= $key == 'article' ? 'fas fa-file-alt' : 'fas fa-video' ?> me-1"></i>
                                        <?= $name ?>
                                    </a>
                                <?php endforeach; ?>
                                <?php if ($currentType): ?>
                                    <a href="<?= Url::current(['type' => null]) ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Сбросить
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Список материалов -->
        <div class="kb-items">
            <?php if ($dataProvider->getCount() > 0): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm kb-card border-0">
                                <?php if ($model->cover_image): ?>
                                    <div class="kb-card-img-container">
                                        <?= Html::img(
                                            Yii::getAlias('@web/uploads/knowledge/') . $model->cover_image,
                                            ['class' => 'card-img-top', 'alt' => $model->title]
                                        ) ?>
                                        <span class="kb-type-badge <?= $model->type === 'article' ? 'bg-primary' : 'bg-info' ?>">
                                            <i class="<?= $model->type === 'article' ? 'fas fa-file-alt' : 'fas fa-video' ?>"></i>
                                            <?= $model->getTypeLabel() ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body">
                                    <div class="kb-category mb-2">
                                        <span class="badge bg-light text-dark">
                                            <i class="<?= $categoryIcons[$model->category] ?? 'fas fa-paw' ?> me-1"></i>
                                            <?= $model->getCategoryLabel() ?>
                                        </span>
                                    </div>

                                    <h5 class="card-title"><?= Html::encode($model->title) ?></h5>

                                    <div class="card-text kb-preview">
                                        <?= strip_tags(substr($model->content, 0, 150)) ?>...
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-0 pt-0">
                                    <?= Html::a('Читать полностью', ['view', 'id' => $model->id], [
                                        'class' => 'btn btn-sm btn-outline-primary w-100'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Пагинация -->
                <div class="mt-5">
                    <?= LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                        'options' => ['class' => 'pagination justify-content-center'],
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
                    ]) ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <h3>Материалы не найдены</h3>
                    <p class="mb-0">Попробуйте изменить критерии поиска</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>