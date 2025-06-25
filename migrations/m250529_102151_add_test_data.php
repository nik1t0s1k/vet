<?php

use yii\db\Migration;

/**
 * Class m250529_102151_add_test_data
 */
class m250529_102151_add_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Сначала создадим тестовых пользователей
        $this->batchInsert('{{%user}}', [
            'username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'
        ], [
            [
                'vet1',
                'vet1@example.com',
                Yii::$app->security->generatePasswordHash('vet123'),
                Yii::$app->security->generateRandomString(),
                time(),
                time()
            ],
            [
                'vet2',
                'vet2@example.com',
                Yii::$app->security->generatePasswordHash('vet456'),
                Yii::$app->security->generateRandomString(),
                time(),
                time()
            ],
        ]);

        // Затем создадим профили для этих пользователей
        $this->batchInsert('{{%profile}}', [
            'user_id', 'full_name', 'phone'
        ], [
            [1, 'Иванов Иван Иванович', '+79991234567'],
            [2, 'Петрова Мария Сергеевна', '+79997654321'],
        ]);

        // Тестовые услуги
        $this->batchInsert('{{%service}}', [
            'name', 'description', 'price', 'category'
        ], [
            ['Выгул собак', 'Прогулка с вашей собакой в парке', 500, 'walking'],
            ['Груминг', 'Комплексный уход за шерстью', 1500, 'grooming'],
            ['Передержка', 'Дневная передержка вашего питомца', 1000, 'boarding'],
        ]);

        // Теперь можно добавлять ветеринаров
        $this->batchInsert('{{%veterinarian}}', [
            'user_id', 'qualification', 'specialization', 'experience', 'rating'
        ], [
            [1, 'Доктор ветеринарных наук', 'Хирургия, терапия', 10, 4.8],
            [2, 'Ветеринарный врач', 'Дерматология', 5, 4.5],
        ]);
    }

    public function safeDown()
    {
        // Удаляем в обратном порядке
        $this->delete('{{%veterinarian}}', ['user_id' => [1, 2]]);
        $this->delete('{{%service}}');
        $this->delete('{{%profile}}', ['user_id' => [1, 2]]);
        $this->delete('{{%user}}', ['id' => [1, 2]]);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250529_102151_add_test_data cannot be reverted.\n";

        return false;
    }
    */
}
