<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gift".
 *
 * @property int $id
 * @property string $name
 * @property int $min_value
 * @property int $max_value
 */
class Gift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'max_value'], 'required'],
            [['min_value', 'max_value'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'min_value' => 'Минимальное значение',
            'max_value' => 'Максимальное значение',
        ];
    }



    public static function userStats($id) {
        return UserGift::find()
            ->select([
                'gift_value' => 'sum(gift_value)'
            ])
            ->where([
                'user_id' => Yii::$app->user->id,
                'gift_id' => $id
            ])
            ->one();
    }

    public static function rand() {
        return self::find()
            ->orderBy('rand()')
            ->limit(1)
            ->one();
    }
}
