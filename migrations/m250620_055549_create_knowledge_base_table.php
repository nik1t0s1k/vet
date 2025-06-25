<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%knowledge_base}}`.
 */
class m250620_055549_create_knowledge_base_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('knowledge_base', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'type' => $this->string(20)->notNull()->defaultValue('article'), // article или video
            'category' => $this->string(100)->notNull(), // уход, воспитание, питание, здоровье
            'cover_image' => $this->string(255),
            'video_url' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Индексы для быстрого поиска
        $this->createIndex('idx_knowledge_type', 'knowledge_base', 'type');
        $this->createIndex('idx_knowledge_category', 'knowledge_base', 'category');
    }

    public function safeDown()
    {
        $this->dropTable('knowledge_base');
    }
}
