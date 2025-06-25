<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250602_073445_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'pet_id' => $this->integer()->notNull(),
            'status' => $this->string()->defaultValue('new'), // new, in_progress, completed, canceled
            'address' => $this->text(),
            'requested_date' => $this->date(),
            'requested_time' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_order_user',
            '{{%order}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_service',
            '{{%order}}',
            'service_id',
            '{{%service}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_order_pet',
            '{{%order}}',
            'pet_id',
            '{{%pet}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }

    /**
     * {@inheritdoc}
     */

}
