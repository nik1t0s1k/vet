<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Signup extends Model
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
                 'value' => new Expression('NOW()'),
            ],
        ];
    }
    public $username;
    public $password;
    public $email;
    public $password_repair;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password_repair', 'compare', 'compareAttribute' => 'password'],
            ['email', 'email'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Никнейм',
            'email' => 'Почта',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',

            'password' => 'Пароль',
            'password_repair' => 'Повтор пароля',
        ];
    }
}