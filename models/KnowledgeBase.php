<?php
// models/KnowledgeBase.php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "knowledge_base".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $category
 * @property string|null $cover_image
 * @property string|null $video_url
 * @property int $created_at
 * @property int $updated_at
 */
class KnowledgeBase extends \yii\db\ActiveRecord
{
    const TYPE_ARTICLE = 'article';
    const TYPE_VIDEO = 'video';

    const CATEGORY_CARE = 'care';
    const CATEGORY_EDUCATION = 'education';
    const CATEGORY_NUTRITION = 'nutrition';
    const CATEGORY_HEALTH = 'health';

    public static function tableName()
    {
        return 'knowledge_base';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content', 'type', 'category'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'cover_image', 'video_url'], 'string', 'max' => 255],
            [['type'], 'in', 'range' => [self::TYPE_ARTICLE, self::TYPE_VIDEO]],
            [['category'], 'in', 'range' => array_keys(self::getCategories())],
            ['video_url', 'url', 'defaultScheme' => 'https'],
            [['views_count'], 'integer'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'type' => 'Тип',
            'category' => 'Категория',
            'cover_image' => 'Обложка',
            'video_url' => 'Ссылка на видео',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'views_count' => 'Количество просмотров',

        ];
    }

    public static function getTypes()
    {
        return [
            self::TYPE_ARTICLE => 'Статья',
            self::TYPE_VIDEO => 'Видеоурок',
        ];
    }

    public static function getCategories()
    {
        return [
            self::CATEGORY_CARE => 'Уход за животными',
            self::CATEGORY_EDUCATION => 'Воспитание',
            self::CATEGORY_NUTRITION => 'Питание',
            self::CATEGORY_HEALTH => 'Здоровье',
        ];
    }

    public function getTypeLabel()
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    public function getCategoryLabel()
    {
        return self::getCategories()[$this->category] ?? $this->category;
    }

    public function getVideoEmbedUrl()
    {
        if ($this->type !== self::TYPE_VIDEO || empty($this->video_url)) {
            return null;
        }

        // Поддержка YouTube
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return "https://www.youtube.com/embed/{$matches[1]}";
        }

        // Поддержка Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return "https://player.vimeo.com/video/{$matches[1]}";
        }

        return $this->video_url;
    }
}