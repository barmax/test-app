<?php

namespace app\commands\models;

use Yii;
use yii\base\Model;

class User extends Model
{
    const MONEY_ID = 1;

    public function getList()
    {
        $sql = "SELECT u.`id`, u.`username`, sum(ug.`gift_value`) as money FROM `user_gift` AS ug JOIN `user` AS u ON u.id = ug.user_id WHERE gift_id = :money HAVING money > 0";
        return Yii::$app->db
            ->createCommand($sql)
            ->bindValue(':money', self::MONEY_ID)
            ->queryAll();
    }

    public function removeMoney($userId, $sum)
    {
        $sql = "INSERT INTO `user_gift` (`user_id`, `gift_id`, `gift_value`, `timestamp`) VALUES (:user, :gift, :value, :timestamp)";

        return Yii::$app->db
            ->createCommand($sql)
            ->bindValue(':user', $userId)
            ->bindValue(':gift', self::MONEY_ID)
            ->bindValue(':value', -$sum)
            ->bindValue(':timestamp', date('Y-m-d H:i:s'))
            ->query();
    }
}