<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

class DeliveryFrom extends Model
{
    public $first_name;
    public $last_name;
    public $address;

    public function rules()
    {
        return [
            ['first_name', 'trim'],
            ['first_name', 'required'],
            [['first_name'], 'string'],

            ['last_name', 'trim'],
            ['last_name', 'required'],
            [['last_name'], 'string'],

            ['address', 'required'],
            [['address'], 'string'],
        ];
    }
}