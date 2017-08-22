<?php
/* @var $this yii\web\View */
use app\assets\PhotoSwipe;
?>
<div class="container">
    <h1><?= $this->params['page']->h1 ?></h1>
    <?= $this->params['page']->text ?>
</div>
<?php
if (strpos($this->params['page']->text, 'class="images"')) {
    PhotoSwipe::register($this);
    Yii::$app->view->registerJsFile('@web/js/photoswipe.min.js', ['depends' => 'app\assets\PhotoSwipe']);
$script = <<< JS
    initPhotoSwipeFromDOM('.images');
JS;
    Yii::$app->view->registerJs($script, yii\web\View::POS_READY);
    echo Yii::$app->view->render('_photoswipe');
}