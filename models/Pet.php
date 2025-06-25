<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pet".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $type
 * @property string|null $breed
 * @property int|null $age
 * @property float|null $weight
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Consultation[] $consultations
 * @property MedicalRecord[] $medicalRecords
 * @property User $user
 */
class Pet extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Удалите created_at и updated_at из обязательных полей
            [['user_id', 'name', 'type'], 'required'], // Было: [['user_id', 'name', 'type', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'age', 'created_at', 'updated_at'], 'integer'],
            [['weight'], 'number'],
            [['name', 'type', 'breed'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'type' => 'Type',
            'breed' => 'Breed',
            'age' => 'Age',
            'weight' => 'Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Consultations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultations()
    {
        return $this->hasMany(Consultation::class, ['pet_id' => 'id']);
    }

    /**
     * Gets query for [[MedicalRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, ['pet_id' => 'id']);
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
    public static function getUserPets($user_id)
    {
        return self::find()
            ->where(['user_id' => $user_id])
            ->all();
    }
}
