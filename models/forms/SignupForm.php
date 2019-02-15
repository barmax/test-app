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

/**
 * Class SignupForm
 * @package app\models\forms
 */

class SignupForm extends Model
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
            ['username', 'string', 'min' => 4, 'max' => 255],
            [['username'], 'unique', 'targetClass' => User::className()],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 4, 'max' => 255],
        ];
    }


    public function save() {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->auth_token = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $user->created_at = date('Y-m-d H:i:s');

            if ($user->save()) {
                return $user;
            }
        }
    }
}

