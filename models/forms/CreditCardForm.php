<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

class CreditCardForm extends Model
{
    public $credit_card;

    public function rules()
    {
        return [
            ['credit_card', 'trim'],
            ['credit_card', 'required'],
            [['credit_card'], 'integer', 'min' => 16],
        ];
    }
}