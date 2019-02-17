<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use yii\data\ActiveDataProvider;
use app\controllers\behaviors\AccessBehavior;

class SettingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessBehavior::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        $this->checkAccess();

        $dataProvider = new ActiveDataProvider([
            'query' => Setting::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $this->checkAccess();

        $model = Setting::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
