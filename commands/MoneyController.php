<?php

namespace app\commands;

use app\commands\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class MoneyController extends Controller
{

    function actionSend($limit = 100) {
        $usersList = User::getList($limit);
        $countUsers = count($usersList );
        $i = 0;

        if ($countUsers !== 0) {
            foreach ($usersList as $user) {
                $res = User::removeMoney($user['id'], $user['money']);

                if ($res) {
                    $i++;
                }
            }

            $msg = 'Count users: '. $countUsers. '. Successfully sent: ' . $i;
        } else {
            $msg = 'No users to sent';
        }
        print(date('Y-m-d H:i:s') .': ' . $msg);
        return ExitCode::OK;
    }
}