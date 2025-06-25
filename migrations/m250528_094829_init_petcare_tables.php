<?php

use yii\db\Migration;

class m250528_094829_init_petcare_tables extends Migration
{
    public function safeUp()
    {
        // Таблица пользователей (Yii2 уже имеет свою, но дополним)
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Профили пользователей
        $this->createTable('{{%profile}}', [
            'user_id' => $this->integer()->notNull(),
            'full_name' => $this->string(),
            'phone' => $this->string(20),
            'address' => $this->text(),
            'PRIMARY KEY (user_id)',
        ]);
        $this->addForeignKey(
            'fk_profile_user',
            '{{%profile}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Питомцы
        $this->createTable('{{%pet}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(), // собака, кошка, птица и т.д.
            'breed' => $this->string(),
            'age' => $this->integer(),
            'weight' => $this->float(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_pet_user',
            '{{%pet}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Ветеринары
        $this->createTable('{{%veterinarian}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'qualification' => $this->text()->notNull(),
            'specialization' => $this->text()->notNull(),
            'experience' => $this->integer(),
            'rating' => $this->float()->defaultValue(0),
            'is_available' => $this->boolean()->defaultValue(true),
        ]);
        $this->addForeignKey(
            'fk_veterinarian_user',
            '{{%veterinarian}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Услуги по уходу
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'category' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Записи на консультации
        $this->createTable('{{%consultation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'pet_id' => $this->integer()->notNull(),
            'veterinarian_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'time' => $this->time()->notNull(),
            'type' => $this->string()->notNull(), // видео, аудио, текст
            'status' => $this->string()->defaultValue('pending'), // pending, completed, canceled
            'notes' => $this->text(),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_consultation_user',
            '{{%consultation}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_consultation_pet',
            '{{%consultation}}',
            'pet_id',
            '{{%pet}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_consultation_vet',
            '{{%consultation}}',
            'veterinarian_id',
            '{{%veterinarian}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Медицинская история питомцев
        $this->createTable('{{%medical_record}}', [
            'id' => $this->primaryKey(),
            'pet_id' => $this->integer()->notNull(),
            'record_date' => $this->date()->notNull(),
            'description' => $this->text()->notNull(),
            'treatment' => $this->text(),
            'veterinarian_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_medical_pet',
            '{{%medical_record}}',
            'pet_id',
            '{{%pet}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_medical_vet',
            '{{%medical_record}}',
            'veterinarian_id',
            '{{%veterinarian}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->addColumn('{{%consultation}}', 'datetime', $this->datetime()->after('time'));
    }

    public function safeDown()
    {
        $this->dropTable('{{%medical_record}}');
        $this->dropTable('{{%consultation}}');
        $this->dropTable('{{%service}}');
        $this->dropTable('{{%veterinarian}}');
        $this->dropTable('{{%pet}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%user}}');
    }
}