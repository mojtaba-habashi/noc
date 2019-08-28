<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class Profile extends \dektrium\user\models\Profile
{

    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('user', 'Name'),
            'family' => \Yii::t('user', 'Family'),
            'public_email' => \Yii::t('user', 'Email (public)'),
            'gravatar_email' => \Yii::t('user', 'Gravatar email'),
            'location' => \Yii::t('user', 'Location'),
            'website' => \Yii::t('user', 'Website'),
            'bio' => \Yii::t('user', 'Bio'),
            'timezone' => \Yii::t('user', 'Time zone'),
        ];
    }

    public function rules()
    {
        return [
            [['family', 'number'], 'required'],
            [['family', 'number'], 'string'],
            'bioString' => ['bio', 'string'],
            'timeZoneValidation' => ['timezone', 'validateTimeZone'],
            'publicEmailPattern' => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl' => ['website', 'url'],
            'nameLength' => ['name', 'string', 'max' => 255],
            'numberLength' => ['number', 'string', 'max' => 255],
            'publicEmailLength' => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength' => ['gravatar_email', 'string', 'max' => 255],
            'locationLength' => ['location', 'string', 'max' => 255],
            'websiteLength' => ['website', 'string', 'max' => 255],
        ];
    }
}
