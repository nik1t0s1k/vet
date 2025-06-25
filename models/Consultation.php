<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "consultation".
 *
 * @property int $id
 * @property int $user_id
 * @property int $pet_id
 * @property int $veterinarian_id
 * @property string $date
 * @property string $time
 * @property string $type
 * @property string|null $status
 * @property string|null $notes
 * @property int $created_at
 *
 * @property Pet $pet
 * @property User $user
 * @property Veterinarian $veterinarian
 */
class Consultation extends \yii\db\ActiveRecord
{
    public $date;
    public $time;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }
    public $datetime; // временное свойство

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'required'],
            [['date', 'time'], 'safe'],
            [['notes'], 'string'],
            [['type'], 'in', 'range' => ['video', 'audio', 'chat']],
            [['status'], 'in', 'range' => ['scheduled', 'completed', 'canceled']],

            // Проверка что питомец принадлежит пользователю
            ['pet_id', 'validatePetOwnership'],
        ];
    }

    public function validateFutureDate($attribute)
    {
        if (strtotime($this->date) < strtotime(date('Y-m-d'))) {
            $this->addError($attribute, 'Дата консультации должна быть в будущем');
        }
    }
    public function validatePetOwnership($attribute, $params)
    {
        $pet = Pet::findOne($this->$attribute);
        if (!$pet || $pet->user_id !== Yii::$app->user->id) {
            $this->addError($attribute, 'Выбранный питомец не принадлежит вам');
        }
    }
    public function validateWorkingHours($attribute)
    {
        $hour = date('H', strtotime($this->time));
        if ($hour < 9 || $hour > 18) {
            $this->addError($attribute, 'Консультации проводятся с 9:00 до 18:00');
        }
    }
    public function getDatetime()
    {
        if ($this->date && $this->time) {
            return $this->date . ' ' . $this->time;
        }
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',

            'date' => 'День',
            'time' => 'Время',

            'created_at' => 'Created At',
            'veterinarian_id' => 'Ветеринар',
            'pet_id' => 'Питомец',
            'type' => 'Тип консультации',
            'status' => 'Статус',
            'notes' => 'Заметки',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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

    public function getTypeLabel()
    {
        $types = [
            'video' => 'Видео',
            'audio' => 'Аудио',
            'text' => 'Текстовая',
        ];
        return $types[$this->type] ?? $this->type;
    }

    public function getStatusLabel()
    {
        $statuses = [
            'pending' => 'Ожидает подтверждения',
            'confirmed' => 'Подтверждена',
            'canceled' => 'Отменена',
            'completed' => 'Завершена',
        ];
        return $statuses[$this->status] ?? $this->status;
    }
}
