<?php
/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отправка денег на счет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-get-money">
    <h1><?= Html::encode($this->title) ?></h1>
    <p> Отправляемая сумма: <?= $sumMoney; ?></p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'user-get-money']); ?>
            <?= $form->field($model, 'credit_card')->textInput(['autofocus' => true, 'maxlength' => 16])->label('Номер карточки') ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
