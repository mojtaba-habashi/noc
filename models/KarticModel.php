<?php
namespace app\models;

use yii\web\NotFoundHttpException;

Interface KarticModel
{
    /**
     * @param integer $id
     * @return KarticModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id): KarticModel;
}