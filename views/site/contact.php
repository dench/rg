<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="container">
    <h1 class="title"><?= $this->params['page']->h1 ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div style="text-align: center;">
            Thank you for contacting us. We will reply to you as soon as possible.
        </div>

    <?php else: ?>

        <?= $this->params['page']->text ?>

        <?php $form = ActiveForm::begin(['options' => ['style' => 'max-width: 600px; min-width: 300px; margin: 0 auto;']]); ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>

            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>
