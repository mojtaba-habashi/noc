<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Service as service;
/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(['options' => [
        'class' => 'comment-form',
    ]]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_type')->dropDownList(
            [service::ADSL => service::ADSL, service::WIRELESS => service::WIRELESS],['id' => 'searchname']);?>

    <?= $form->field($model, 'station_id' )->dropDownList([])->label('station');?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
