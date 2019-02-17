<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="guest-index">
    <h2><a href="<?= Url::to(['user/login']); ?>">Войти</a></h2>
    <h2><a href="<?= Url::to(['user/signup']); ?>">Зарегистрироваться</a></h2>
</div>