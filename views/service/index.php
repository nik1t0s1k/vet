<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги - VetCare Ветеринарная клиника</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c6fd1;         /* Основной синий */
            --primary-dark: #1a4580;    /* Темно-синий */
            --primary-light: #e6f0ff;   /* Светло-синий фон */
            --secondary: #ff8e4d;      /* Оранжевый для акцентов */
            --accent: #ffd166;          /* Желтый для кнопок */
            --light: #f8f9fa;
            --dark: #2a4a75;            /* Темно-синий текст */
            --gray: #6c757d;
            --light-gray: #e0e8f5;      /* Светло-синяя граница */
            --border-radius: 12px;
            --shadow: 0 8px 24px rgba(0, 70, 150, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            background-color: #f5f7fa;
            padding-top: 20px;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--dark);
        }

        .container {
            max-width: 1200px;
        }

        .page-header {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            border-radius: var(--border-radius);
            color: white;
            box-shadow: var(--shadow);
            margin-top: 100px;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }

        .page-header h1 {
            color: white;
            font-size: 2.8rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .page-header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .paw-decoration {
            position: absolute;
            opacity: 0.05;
            font-size: 120px;
            z-index: 1;
            pointer-events: none;
            color: white;
        }

        .paw1 { top: 20px; right: 30px; transform: rotate(25deg); }
        .paw2 { bottom: 50px; left: 30px; transform: rotate(-15deg); }

        .filter-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            overflow: hidden;
            transition: var(--transition);
        }

        .filter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 90, 180, 0.15);
        }

        .filter-header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .filter-header i {
            font-size: 1.5rem;
        }

        .filter-body {
            padding: 25px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid var(--light-gray);
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(44, 111, 209, 0.25);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), #3a7af0);
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(26, 69, 128, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid var(--gray);
            color: var(--gray);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-outline-secondary:hover {
            border-color: var(--dark);
            color: var(--dark);
            transform: translateY(-3px);
        }

        .service-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 100%;
            transition: var(--transition);
            position: relative;
            border: 1px solid var(--light-gray);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 90, 180, 0.2);
        }

        .service-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .service-img {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .service-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .service-card:hover .service-img img {
            transform: scale(1.05);
        }

        .service-img-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(26, 69, 128, 0.7), transparent);
            padding: 15px;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .service-body {
            padding: 25px;
        }

        .service-category {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .service-title {
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .service-description {
            color: var(--gray);
            margin-bottom: 20px;
        }

        .service-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .service-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px 25px;
        }

        .btn-book {
            background: var(--accent);
            color: var(--dark);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-book:hover {
            background: #ffc043;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .list-view-summary {
            background: white;
            padding: 15px 20px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--light-gray);
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination .page-item .page-link {
            color: var(--primary);
            border-radius: 8px;
            margin: 0 5px;
            border: none;
            transition: var(--transition);
            border: 1px solid var(--light-gray);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            border-color: var(--primary);
            color: white;
        }

        .pagination .page-item .page-link:hover {
            background: var(--light-gray);
        }

        .empty-results {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px;
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid var(--light-gray);
        }

        .empty-results i {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 20px;
        }

        .empty-results h3 {
            color: var(--gray);
            margin-bottom: 15px;
        }

        .service-features {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .feature-badge {
            background: rgba(44, 111, 209, 0.1);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.03;
            font-size: 100px;
            z-index: 1;
            transform: rotate(-15deg);
            pointer-events: none;
            color: var(--primary-dark);
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 992px) {
            .page-header h1 {
                font-size: 2.3rem;
            }

            .service-img {
                height: 180px;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 30px 15px;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .filter-body .row > div {
                margin-bottom: 20px;
            }

            .filter-actions {
                display: flex;
                gap: 10px;
            }

            .filter-actions .btn {
                flex: 1;
            }
        }

        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.8rem;
            }

            .service-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .btn-book {
                width: 100%;
            }

            .paw-decoration {
                font-size: 80px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Шапка страницы -->
    <div class="page-header">
        <div class="paw-decoration paw1">🐾</div>
        <div class="paw-decoration paw2">🐾</div>
        <div class="watermark">VetCare</div>
        <h1>Наши услуги</h1>
        <p>Профессиональная ветеринарная помощь для ваших питомцев с любовью и заботой</p>
    </div>

    <!-- Фильтры -->
    <div class="filter-card">
        <div class="filter-header">
            <i class="fas fa-filter"></i>
            <h2 class="h4 mb-0">Поиск услуг</h2>
        </div>
        <div class="filter-body">
            <?php
            use yii\widgets\ActiveForm;
            use yii\helpers\Html;
            use yii\helpers\ArrayHelper;
            use app\models\Service;

            $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['index'],
                'options' => ['class' => 'filter-form']
            ]);
            ?>

            <div class="row g-3">
                <div class="col-md-5">
                    <?= $form->field($searchModel, 'name')
                        ->textInput([
                            'placeholder' => 'Поиск по названию услуги...',
                            'class' => 'form-control'
                        ])
                        ->label('Название услуги') ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($searchModel, 'category')
                        ->dropDownList(
                            Service::getCategories(),
                            [
                                'prompt' => 'Все категории',
                                'class' => 'form-select'
                            ]
                        )
                        ->label('Категория') ?>
                </div>

                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($searchModel, 'price_min')
                                ->textInput([
                                    'placeholder' => 'От',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'min' => 0
                                ])
                                ->label('Цена от') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($searchModel, 'price_max')
                                ->textInput([
                                    'placeholder' => 'До',
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'min' => 0
                                ])
                                ->label('Цена до') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="filter-actions mt-4">
                <?= Html::submitButton('<i class="fas fa-search me-2"></i>Найти услуги', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fas fa-redo me-2"></i>Сбросить', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <!-- Результаты -->


    <!-- Список услуг -->
    <div class="row">
        <?php if ($dataProvider->totalCount > 0): ?>
            <?php foreach ($dataProvider->getModels() as $model): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <!-- Бейдж для популярных услуг -->
                        <?php if (in_array($model->category, [Service::CATEGORY_WALKING, Service::CATEGORY_BOARDING])): ?>
                            <div class="service-badge">Популярная</div>
                        <?php endif; ?>

                        <!-- Изображение услуги -->
                        <div class="service-img">
                            <?php
                            // Заглушка для изображения
                            $imageUrl = 'https://via.placeholder.com/400x300?text=' . urlencode($model->name);
                            ?>
                            <img src="<?= $imageUrl ?>" alt="<?= Html::encode($model->name) ?>">
                            <div class="service-img-overlay"><?= Html::encode($model->getCategoryLabel()) ?></div>
                        </div>

                        <div class="service-body">
                            <div class="service-category"><?= Html::encode($model->getCategoryLabel()) ?></div>
                            <h3 class="service-title"><?= Html::encode($model->name) ?></h3>
                            <p class="service-description"><?= Html::encode($model->description) ?></p>

                            <div class="service-features">
                                <span class="feature-badge"><?= $model->duration ?? '30 мин' ?></span>
                                <span class="feature-badge">Все животные</span>
                            </div>

                            <div class="service-price"><?= Yii::$app->formatter->asCurrency($model->price, 'RUB') ?></div>
                        </div>

                        <div class="service-footer">
                            <button class="btn-book" data-service-id="<?= $model->id ?>">
                                <i class="fas fa-calendar-check me-2"></i>Записаться
                            </button>
                            <?= Html::a('<i class="fas fa-info-circle"></i>', ['view', 'id' => $model->id], [
                                'class' => 'text-primary',
                                'title' => 'Подробнее'
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="empty-results">
                    <i class="fas fa-inbox"></i>
                    <h3>Услуги не найдены</h3>
                    <p>Попробуйте изменить условия поиска</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Пагинация -->
    <?php if ($dataProvider->pagination->pageCount > 1): ?>
        <div class="pagination-wrapper">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'options' => ['class' => 'pagination'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'linkOptions' => ['class' => 'page-link'],
                'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link', 'href' => '#'],
                'prevPageLabel' => '<i class="fas fa-chevron-left"></i>',
                'nextPageLabel' => '<i class="fas fa-chevron-right"></i>',
            ]); ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка кнопки "Записаться"
        document.querySelectorAll('.btn-book').forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-service-id');
                alert('Запись на услугу #' + serviceId);
                // Здесь можно добавить AJAX запрос или открыть модальное окно
            });
        });

        // Обработка фильтрации с минимумом/максимумом цены
        document.querySelectorAll('input[name="Service[price_min]"], input[name="Service[price_max]"]').forEach(input => {
            input.addEventListener('change', function() {
                const minInput = document.querySelector('input[name="Service[price_min]"]');
                const maxInput = document.querySelector('input[name="Service[price_max]"]');

                if (minInput.value && maxInput.value && parseInt(minInput.value) > parseInt(maxInput.value)) {
                    alert('Минимальная цена не может быть больше максимальной');
                    this.value = '';
                }
            });
        });
    });
</script>
</body>
</html>