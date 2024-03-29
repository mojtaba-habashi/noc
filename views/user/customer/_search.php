<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usersearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="user-search">

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ],
]); ?>

<?= $form->field($model, 'id') ?>

<?= $form->field($model, 'username') ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'password_hash') ?>

<?= $form->field($model, 'auth_key') ?>

<?php // echo $form->field($model, 'confirmed_at') ?>

<?php // echo $form->field($model, 'unconfirmed_email') ?>

<?php // echo $form->field($model, 'blocked_at') ?>

<?php // echo $form->field($model, 'registration_ip') ?>

<?php // echo $form->field($model, 'created_at') ?>

<?php // echo $form->field($model, 'updated_at') ?>

<?php // echo $form->field($model, 'flags') ?>

<?php // echo $form->field($model, 'last_login_at') ?>

<?php // echo $form->field($model, 'is_admin') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?><?php
