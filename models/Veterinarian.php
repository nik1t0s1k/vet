<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinarian".
 *
 * @property int $id
 * @property int $user_id
 * @property string $qualification
 * @property string $specialization
 * @property int|null $experience
 * @property float|null $rating
 * @property int|null $is_available
 *
 * @property Consultation[] $consultations
 * @property MedicalRecord[] $medicalRecords
 * @property User $user
 */
class Veterinarian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'veterinarian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'qualification', 'specialization'], 'required'],
            [['user_id', 'experience', 'is_available'], 'integer'],
            [['qualification', 'specialization'], 'string'],
            [['rating'], 'number'],
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
            'qualification' => 'Qualification',
            'specialization' => 'Specialization',
            'experience' => 'Experience',
            'rating' => 'Rating',
            'is_available' => 'Is Available',
        ];
    }

    /**
     * Gets query for [[Consultations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultations()
    {
        return $this->hasMany(Consultation::class, ['veterinarian_id' => 'id']);
    }

    /**
     * Gets query for [[MedicalRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, ['veterinarian_id' => 'id']);
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
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(
            self::find()->with('user')->all(),
            'id',
            function($model) {
                return $model->user->username . ' (' . $model->specialization . ')';
            }
        );
    }
}
