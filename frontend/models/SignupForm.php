<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $re_password;
    public $permission;
    public $name;
    public $code;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['name', 'email'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Địa chỉ email đã tồn tại'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            [['email', 'name'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Địa chỉ email đã tồn tại'],

            ['password', 'required'],
            [['password', 're_password'], 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->permission = User::ROLE_USER;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
        $user->code = '#000' . $user->id;
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Tên'),
            'password' => Yii::t('app', 'Mật khẩu'),
            'rememberMe' => Yii::t('app', 'Remember Me'),
        ];
    }
}
