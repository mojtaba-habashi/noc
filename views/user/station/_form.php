<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Station as station;
/* @var $this yii\web\View */
/* @var $model app\models\Station */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'station_type')->dropDownList( ['popsite' => station::POPSITE, 'point' => station::POINT]) ?>

    <?= $form->field($model, 'is_used')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
