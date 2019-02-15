<?php

/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property string $password
 */

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

class LoginForm extends Model
{
    public $username;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],

            ['password', 'required'],
        ];
    }


    public function login() {
        if ($this->validate()) {
            $user = User::findByUsername($this->username);

            if (!$user) {
                return Yii::$app->session->setFlash('error', 'Пользователь не найден');
            }

            if (!$user->validatePassword($this->password)) {
                return Yii::$app->session->setFlash('error', 'Неверный пароль');
            }

            return Yii::$app->user->login($user);
        }

        return false;
    }
}

