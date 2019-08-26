<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string $service_type
 * @property string $address
 * @property int $user_id
 * @property string $tel
 * @property int $station_id
 * @property int $is_deleted
 *
 * @property Station $station
 * @property User $user
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    CONST ADSL = 'adsl';
    CONST WIRELESS = 'wireless';
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'station_id', 'is_deleted'], 'integer'],
            [['service_type', 'address', 'tel'], 'string', 'max' => 255],
            [['station_id'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['station_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_type' => Yii::t('app', 'Service Type'),
            'address' => Yii::t('app', 'Address'),
            'user_id' => Yii::t('app', 'User ID'),
            'tel' => Yii::t('app', 'Tel'),
            'station_id' => Yii::t('app', 'Station ID'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['id' => 'station_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
