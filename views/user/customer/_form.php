<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="user-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>


<?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

<?= $form->field($user, 'email')->input(['maxlength' => true]) ?>

<?= $form->field($profile, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($profile, 'family')->textInput(['maxlength' => true]) ?>

<?= $form->field($profile, 'number')->textInput(['maxlength' => true]) ?>


<?= $form->field($user, 'is_admin')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

    </div><?php
