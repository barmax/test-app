<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\models\UserGift;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_token
 * @property string $password_hash
 * @property int $is_active
 * @property date $created_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $credit_card;
    public $first_name;
    public $last_name;
    public $addresses;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'auth_token' => 'Auth Token',
            'password_hash' => 'Password Hash',
            'created_at' => 'Дата регистрации',
        ];
    }


    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function getStats($id)
    {

        return UserGift::find()
            ->select([
                'user_id' => 'user_id',
                'sum_money' => '(select sum(gift_value) from user_gift where gift_id = 1)',
                'sum_goods' => '(select sum(gift_value) from user_gift where gift_id = 2)',
                'sum_points' => '(select sum(gift_value) from user_gift where gift_id = 3)',
            ])
            ->where([
                'user_id' => $id,
            ])
            ->one();
    }

    public static function getSumMoney($id)
    {
        $result = UserGift::find()
            ->select([
                'sum_money' => 'sum(gift_value)',
            ])
            ->where([
                'user_id' => $id,
                'gift_id' => 2,
            ])
            ->one();

        return (int)$result->sum_money;
    }

    public static function getSumGoods($id)
    {
        $result = UserGift::find()
            ->select([
                'sum_goods' => 'sum(gift_value)',
            ])
            ->where([
                'user_id' => $id,
                'gift_id' => 2,
            ])
            ->one();

        return (int)$result->sum_goods;
    }

    public static function removeMoney($sum)
    {

        $stats = new UserGift();
        $stats->user_id = Yii::$app->user->id;
        $stats->gift_id = 1;
        $stats->gift_value = -$sum;
        $stats->timestamp = date('Y-m-d H:i:s');

        return $stats->save();
    }

    public function addPoints($sum, $exchange)
    {
        $stats = new UserGift();
        $stats->user_id = Yii::$app->user->id;
        $stats->gift_id = 3;
        $stats->gift_value = $sum * $exchange;
        $stats->timestamp = date('Y-m-d H:i:s');

        return $stats->save();
    }

    public static function removeGoods($sum)
    {
        $stats = new UserGift();
        $stats->user_id = Yii::$app->user->id;
        $stats->gift_id = 2;
        $stats->gift_value = -$sum;
        $stats->timestamp = date('Y-m-d H:i:s');

        return $stats->save();
    }

    public static function gift()
    {
        $gift = Gift::rand();
        $result['id'] = $gift->id;

        if ($gift->id !== 3) {
            $userStats = UserGift::findStatsByGiftId($gift->id);
            $limit = Setting::findOne($gift->id);

            $userMaxGift = $limit->value - $userStats->gift_value;
            if ($userMaxGift < $gift->max_value) {
                $result['value'] = mt_rand($gift->min_value, $userMaxGift);
            }
        }

        $result['value'] = mt_rand($gift->min_value, $gift->max_value);

        return $result;
    }
}
