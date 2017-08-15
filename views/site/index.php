<?php

use dench\image\helpers\ImageHelper;

/* @var $this yii\web\View */
/* @var $members app\models\Team[] */

?>
<?= $this->params['page']->text ?>

<section class="b5 invert">
    <hr>
    <div class="container">
        <h2>{lang_our_team}</h2>
        <div class="row">
            <?php foreach ($members as $member): ?>
            <div class="col">
                <?php if ($member->image_id): ?>
                    <img src="<?= ImageHelper::thumb($member->image_id, 'member') ?>" alt="<?= $member->name ?>">
                <?php else: ?>
                    <img src="<?= Yii::$app->params['image']['none'] ?>" alt="">
                <?php endif; ?>
                <hr>
                <div class="name"><?= $member->name ?></div>
                <div class="type"><?= $member->description ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>