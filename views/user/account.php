<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-account">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Получить деньги', ['user/get-money'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обмен денег на баллы', ['user/exchange'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Отправить товар', ['user/post'], ['class' => 'btn btn-default']) ?>
    </p>


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sum_money',
            'sum_goods',
            'sum_points',
        ]
    ]) ?>


</div>