<?php

namespace app\models;

use Yii;

class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    public static function tableName()
    {
        return '{{%order}}';
    }

    public function rules()
    {
        return [
            [['service_id', 'pet_id', 'requested_date'], 'required'],
            [['user_id', 'service_id', 'pet_id'], 'integer'],
            [['address'], 'string'],
            [['requested_date'], 'date', 'format' => 'php:Y-m-d'],
            [['requested_time'], 'string'],
            ['status', 'in', 'range' => array_keys(self::getStatuses())],
            ['status', 'default', 'value' => self::STATUS_NEW],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Услуга',
            'pet_id' => 'Питомец',
            'status' => 'Статус',
            'address' => 'Адрес',
            'requested_date' => 'Дата оказания услуги',
            'requested_time' => 'Время оказания услуги',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_IN_PROGRESS => 'В процессе',
            self::STATUS_COMPLETED => 'Завершен',
            self::STATUS_CANCELED => 'Отменен',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getPet()
    {
        return $this->hasOne(Pet::class, ['id' => 'pet_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = Yii::$app->user->id;
                $this->created_at = time();
            }
            $this->updated_at = time();
            return true;
        }
        return false;
    }
}