<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_record".
 *
 * @property int $id
 * @property int $pet_id
 * @property string $record_date
 * @property string $description
 * @property string|null $treatment
 * @property int|null $veterinarian_id
 * @property int $created_at
 *
 * @property Pet $pet
 * @property Veterinarian $veterinarian
 */
class MedicalRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['record_date', 'description'], 'required'], // Обязательные поля
            [['record_date'], 'date', 'format' => 'php:Y-m-d'],
            [['veterinarian_id', 'pet_id'], 'integer'],
            [['description', 'treatment'], 'string'],
            [['record_date'], 'safe'],
            [['description', 'treatment'], 'string'],
            [['pet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pet::class, 'targetAttribute' => ['pet_id' => 'id']],
            [['veterinarian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Veterinarian::class, 'targetAttribute' => ['veterinarian_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pet_id' => 'ID питомца',
            'record_date' => 'Дата записи',
            'description' => 'Описание',
            'treatment' => 'Лечение',
            'veterinarian_id' => 'ID ветеринара',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Pet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPet()
    {
        return $this->hasOne(Pet::class, ['id' => 'pet_id']);
    }

    /**
     * Gets query for [[Veterinarian]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarian()
    {
        return $this->hasOne(Veterinarian::class, ['id' => 'veterinarian_id']);
    }
}
