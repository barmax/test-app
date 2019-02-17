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
            <?php switch ($gift['id']) :
                case 1: ?>
                    <div class="gift__item gift-active" id="1">
                        <span class="glyphicon glyphicon-rub gift__item--icon"></span>
                        <p class="gift__item--title">Деньги</p>
                        <p class="gift__item--sum"><?= $gift['value']; ?></p>
                    </div>
                    <?php break; ?>
                <?php case 2: ?>
                    <div class="gift__item gift-active" id="2">
                        <span class="glyphicon glyphicon-shopping-cart fa-3x gift__item--icon"></span>
                        <p class="gift__item--title">Товар</p>
                        <p class="gift__item--sum"><?= $gift['value']; ?></p>
                    </div>
                    <?php break; ?>
                <?php case 3: ?>
                    <div class="gift__item gift-active" id="3">
                        <span class="glyphicon glyphicon-bitcoin fa-3x gift__item--icon"></span>
                        <p class="gift__item--title">Баллы</p>
                        <p class="gift__item--sum"><?= $gift['value']; ?></p>
                    </div>
                    <?php break; ?>
                <?php endswitch; ?>
        </div>
    </div>

    <div class="container gift gift__btns">
        <a href="<?= Url::to(['user/account']) ?>" class="btn btn-lg btn-success gift__btn" id="gift-get">Получить приз</a>

        <?php if($gift['id'] === 2) : ?>
            <a href="#" class="btn btn-lg btn-danger gift__btn" id="gift-cancel">Отказаться</a>
        <?php endif; ?>
    </div>

</div>
