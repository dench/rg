<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $home bool */

use app\assets\SiteAsset;
use dench\language\models\Language;
use dench\language\widgets\Lang;
use yii\helpers\Html;
use yii\helpers\Url;

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="page-container">
<?php $this->beginBody() ?>
<header>
    <nav>
        <a class="logo" href="/"><img src="img/logo.png" alt=""></a>
        <a class="brand" href="/">Remote Games</a>
        <div class="toggle">
            <ul>
                <li class="active"><a href="<?= Url::to(['site/page', 'slug' => 'areas']) ?>">Areas</a></li>
                <li><a href="<?= Url::to(['site/page', 'slug' => 'technologies']) ?>">Technologies</a></li>
            </ul>
            <ul>
                <li><a href="<?= Url::to(['site/page', 'slug' => 'business']) ?>">Business</a></li>
                <li><a href="<?= Url::to(['site/page', 'slug' => 'about']) ?>">About us</a></li>
            </ul>
        </div>
        <button><i></i><i></i><i></i></button>
        <div class="lang dropdown">
            <a><?= Language::$current->name ?></a>
            <?= Lang::widget([
                'id' => null,
                'tag' => 'div',
                'options' => [],
                'itemTag' => null,
                'linkOptions' => [],
                'current' => Language::getCurrent(),
                'langs' => Language::nameList(),
            ]) ?>
        </div>
    </nav>
</header>
<?= $content ?>
</div>
<footer>
    <div class="container">
        <a href="<?= Url::home() ?>">Remote Games</a> © 2017
    </div>
</footer>
<?= $this->render('_counters') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
