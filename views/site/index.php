<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" id="gift-info">
        <h1>Поздравляем!</h1>

        <p class="lead">Вы получили приз.</p>

        <p><a class="btn btn-lg btn-success" id="gift-btn" href="#">Приз</a></p>
    </div>

    <div class="container" id="gift-box">
        <div class="gift">
            <div class="gift__item" id="1">
                <span class="glyphicon glyphicon-rub gift__item--icon"></span>
                <p class="gift__item--title">Деньги</p>
                <p class="gift__item--sum">0</p>
            </div>
            <div class="gift__item" id="2">
                <span class="glyphicon glyphicon-bitcoin fa-3x gift__item--icon"></span>
                <p class="gift__item--title">Баллы</p>
                <p class="gift__item--sum">0</p>
            </div>
            <div class="gift__item" id="3">
                <span class="glyphicon glyphicon-shopping-cart fa-3x gift__item--icon"></span>
                <p class="gift__item--title">Товар</p>
                <p class="gift__item--sum">0</p>
            </div>
        </div>
    </div>

    <div class="container gift">
            <a href="<?= Url::to(['user/account']) ?>" class="btn btn-lg btn-success gift__btn">Получить приз</a>

            <a href="#" class="btn btn-lg btn-danger gift__btn" id="btn-cancel">Отказаться</a>
    </div>

</div>
