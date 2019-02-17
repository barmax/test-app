<?php

namespace app\controllers;

use Yii;
use app\models\forms\SignupForm;
use app\models\forms\LoginForm;
use app\models\User;
use app\models\Setting;
use yii\data\ActiveDataProvider;
use app\controllers\behaviors\AccessBehavior;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessBehavior::className(),
            ],
        ];
    }

    public function actionList() {
        $this->checkAccess();

        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/');
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->save()) {
            Yii::$app->user->login($user);
            $this->redirect('/');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }


    public function actionAccount() {
        $this->checkAccess();

        $model = User::getStats(Yii::$app->user->id);

        return $this->render('account', [
            'model' => $model,
        ]);
    }


    function actionGetMoney() {
        $this->checkAccess();

        $sumMoney = User::getSumMoney(Yii::$app->user->id);
        $model = User::findOne(Yii::$app->user->id);

        if ($sumMoney === 0) {
            Yii::$app->session->setFlash('error', 'Нет денег для отправки.');
            return $this->redirect('account');
        }

        if (Yii::$app->request->post()) {
            $model->removeMoney($sumMoney);
            Yii::$app->session->setFlash('success', "Ваши деньги отправлены.");

            return $this->redirect('account');
        }
        return $this->render('get-money', [
            'sumMoney' => $sumMoney,
            'model' => $model,
        ]);
    }

    function actionPost() {
        $this->checkAccess();

        $sumGoods = User::getSumGoods(Yii::$app->user->id);
        $model = User::findOne(Yii::$app->user->id);

        if ($sumGoods === 0) {
            Yii::$app->session->setFlash('error', 'Нечего отправлять.');
            return $this->redirect('account');
        }

        if (Yii::$app->request->post()) {
            Yii::$app->session->setFlash('success', "Ваши товары переданы в доставку.");
            $model->removeGoods($sumGoods);

            return $this->redirect('account');
        }

        return $this->render('post', [
            'sumGoods' => $sumGoods,
            'model' => $model,
        ]);
    }

    function actionExchange() {
        $this->checkAccess();

        $exchange = Setting::findOne(1);
        $sumMoney = User::getSumMoney(Yii::$app->user->id);
        $model = User::findOne(Yii::$app->user->id);


        if ($sumMoney === 0) {
            Yii::$app->session->setFlash('error', 'Нет денег для обмена.');
            return $this->redirect('account');
        }

        if (Yii::$app->request->post()) {
            $money = Yii::$app->request->post('User')['sum_money'];

            if ($money > $sumMoney) {
                Yii::$app->session->setFlash('error', 'Недосаточно денег');
                return $this->render('exchange', [
                    'exchange' => $exchange->value,
                    'sumMoney' => $sumMoney,
                    'model' => $model,
                ]);
            }

            $model->removeMoney($money);
            $model->addPoints($money, $exchange->value);

            return $this->redirect('account');
        }

        return $this->render('exchange', [
            'exchange' => $exchange->value,
            'sumMoney' => $sumMoney,
            'model' => $model,
        ]);
    }
}
