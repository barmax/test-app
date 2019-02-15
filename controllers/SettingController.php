<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use yii\data\ActiveDataProvider;

class SettingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Setting::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
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
