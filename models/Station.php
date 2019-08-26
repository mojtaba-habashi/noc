<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $station_type
 * @property int $is_used
 *
 * @property Service[] $services
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_used'], 'integer'],
            [['name', 'address', 'station_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'station_type' => Yii::t('app', 'Station Type'),
            'is_used' => Yii::t('app', 'Is Used'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['station_id' => 'id']);
    }
}
