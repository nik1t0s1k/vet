<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Service extends ActiveRecord
{
    public function search($params)
    {
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6, // Уменьшил для лучшего соответствия дизайну
            ],
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Фильтрация по названию
        $query->andFilterWhere(['like', 'name', $this->name]);

        // Фильтрация по категории
        $query->andFilterWhere(['category' => $this->category]);

        // Фильтрация по цене
        $query->andFilterWhere(['>=', 'price', $this->price_min])
            ->andFilterWhere(['<=', 'price', $this->price_max]);

        return $dataProvider;
    }
    const CATEGORY_WALKING = 'walking';
    const CATEGORY_GROOMING = 'grooming';
    const CATEGORY_BOARDING = 'boarding';

    public static function tableName()
    {
        return '{{%service}}';
    }

    // Добавляем метод для получения текстового названия категории
    public function getCategoryLabel()
    {
        return self::getCategories()[$this->category] ?? $this->category;
    }

    // Добавляем метод для форматирования цены
    public function getFormattedPrice()
    {
        return Yii::$app->formatter->asCurrency($this->price, 'RUB');
    }

    // Метод для получения всех возможных категорий
    public static function getCategories()
    {
        return [
            self::CATEGORY_WALKING => 'Выгул',
            self::CATEGORY_GROOMING => 'Груминг',
            self::CATEGORY_BOARDING => 'Передержка',
        ];
    }

    // Правила валидации
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'category'], 'required'],
            ['price', 'number'],
            ['category', 'in', 'range' => array_keys(self::getCategories())],
        ];
    }
    public function upload($image)
    {
        if ($image) {
            $fileName = Yii::$app->security->generateRandomString(12) . '.' . $image->extension;
            $image->saveAs(Yii::getAlias('@webroot/uploads/services/') . $fileName);
            return $fileName;
        }
        return false;
    }


// Добавим временные атрибуты для фильтрации
    public $price_min;
    public $price_max;

}
