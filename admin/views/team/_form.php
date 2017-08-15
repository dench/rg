<?php

use dench\image\widgets\ImageForm;
use dench\language\models\Language;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach (Language::suffixList() as $suffix => $name) : ?>
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'description' . $suffix)->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?= ImageForm::widget([
        'image' => $model->image,
        'modelInputName' => 'Team',
        'size' => 'member',
        'col' => 'col-sm-4 col-md-3',
        'label' => null,
    ]) ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
