<?php

namespace app\models;


use yii\base\Model;

class UserProfileForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $last_name;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class, 'filter' => ['not', ['id' => \Yii::$app->user->id]]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Email',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }
}