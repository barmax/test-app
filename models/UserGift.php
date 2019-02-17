<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_gift".
 *
 * @property int $user_id
 * @property int $gift_id
 * @property int $gift_value
 * @property int $timestamp
 */
class UserGift extends \yii\db\ActiveRecord
{
    public $sum_money;
    public $sum_points;
    public $sum_goods;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_gift';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'gift_id' => 'Gift ID',
            'gift_value' => 'Gift Value',
            'timestamp' => 'Timestamp',
            'sum_money' => 'Сумма денег',
            'sum_points' => 'Количество баллов',
            'sum_goods' => 'Количество товара',
        ];
    }

    public function findStatsByGiftId($id)
    {
        return self::find()
            ->select(['gift_value' => 'sum(gift_value)'])
            ->where(['user_id' => Yii::$app->user->id,
                'gift_id' => $id])
            ->one();
    }
}
