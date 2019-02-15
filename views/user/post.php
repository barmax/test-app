<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отправка денег на счет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-post">
    <h1><?= Html::encode($this->title) ?></h1>
    <p> Количество товаров к доставке: <?= $sumGoods; ?></p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'user-get-money']); ?>
            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true, 'maxlength' => 16])->label('Имя') ?>
            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true, 'maxlength' => 16])->label('Фамилия') ?>
            <?= $form->field($model, 'addresses')->textInput(['autofocus' => true, 'maxlength' => 16])->label('Адрес') ?>

            <div class="form-group">
                <?= Html::submitButton('Доставить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
