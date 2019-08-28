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
    const POPSITE = 'popsite';
    const POINT = 'point';

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
//            [['name', 'address','station_type',], 'required'],
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
    public function getStations()
    {
        return $this->hasMany(Service::className(), ['station_id' => 'id']);
    }

    /**
     * @param $serviceType
     * @return array|\yii\db\ActiveRecord[]|null
     */
    public function getAjaxStations($serviceType)
    {
        $stations = null;
        if ($serviceType == Service::ADSL) {
            $stations = Station::find()
                ->where(['and',
                    ['station_type' => Station::POPSITE],
                    ['is_used' => 0]])
                ->orWhere(['station_type' => Station::POINT])
                ->all();
        } else {
            $stations = Station::find()
                ->where(['and',
                    ['station_type' => Station::POPSITE],
                    ['is_used' => 0]])
                ->all();
        }
        return $stations;
    }
}
