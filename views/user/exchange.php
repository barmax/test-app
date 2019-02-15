<?php
/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Обмен денег на баллы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-exchange">
    <h1><?= Html::encode($this->title) ?></h1>
    <p> Курс: 10 баллов = <span id="'exchange-rate"><?= $exchange; ?> денег</span></p>
    <p> Сумма денег: <?= $sumMoney; ?></p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'user-exchange']); ?>
            <?= $form->field($model, 'sum_money')->textInput(['autofocus' => true, 'maxlength' => 16])->label('Введите необходимую сумму к обмену') ?>

            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-primary', 'name' => 'exchange-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
