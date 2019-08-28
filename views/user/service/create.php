<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = Yii::t('app', 'Create Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'station' => $station
    ]) ?>
    <div id="test_div">

    </div>

</div>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $("#searchname").change(function(event) {
            var data = $("#searchname").val();
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                url: 'http://mojtaba.com/user/service/fetch-station',
                type: 'post',
                dataType: 'json',
                data: {
                    data: data,
                    _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
                }
            })
                .done(function(response) {
                    $('#service-station_id').empty();
                    $.each(response, function (index, value) {
                        $('#service-station_id').append('<option value=' + index + '>' + value + '</option>');
                    });
                    console.log(response);
                })
                .fail(function(error) {
                    console.log(data);
                    console.log(eval(error));
                });

        });
    });

</script>