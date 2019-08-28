<?php

namespace app\models;

use dektrium\user\helpers\Password;
use dektrium\user\models\Profile;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Application as WebApplication;

class User extends \dektrium\user\models\User
{

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('auth_key', \Yii::$app->security->generateRandomString());
            if (\Yii::$app instanceof WebApplication) {
                $this->setAttribute('registration_ip', \Yii::$app->request->userIP);
            }
        }
        if (!empty($this->password)) {
            $this->setAttribute('password_hash', Password::hash($this->password));
        }

        return parent::beforeSave($insert);
    }
    public function attributeLabels()
    {
        return [
            'username'          => \Yii::t('user', 'Username'),
            'email'             => \Yii::t('user', 'Email'),
            'registration_ip'   => \Yii::t('user', 'Registration ip'),
            'unconfirmed_email' => \Yii::t('user', 'New email'),
            'password'          => \Yii::t('user', 'Password'),
            'created_at'        => \Yii::t('user', 'Registration time'),
            'last_login_at'     => \Yii::t('user', 'Last login'),
            'confirmed_at'      => \Yii::t('user', 'Confirmation time'),
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'register' => ['username', 'email', 'password', 'is_admin'],
            'connect'  => ['username', 'email'],
            'create'   => ['username', 'email', 'password'],
            'update'   => ['username', 'email', 'password'],
            'settings' => ['username', 'email', 'password'],
        ]);
    }
    public function rules()
    {
        return [
            [['is_admin'], 'required'],
            [['is_admin'], 'integer'],
            [['password'], 'required'],
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameRequired' => ['username', 'required', 'on' => ['register', 'create', 'connect', 'update']],
            'usernameMatch'    => ['username', 'match', 'pattern' => static::$usernameRegexp],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            'usernameUnique'   => [
                'username',
                'unique',
                'message' => \Yii::t('user', 'This username has already been taken')
            ],

            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailRequired' => ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            'emailPattern'  => ['email', 'email'],
            'emailLength'   => ['email', 'string', 'max' => 255],
            'emailUnique'   => [
                'email',
                'unique',
                'message' => \Yii::t('user', 'This email address has already been taken')
            ],

        ];
    }


    /**
     * @return bool
     * @throws Exception
     */
    public function checkAdminExist ()
    {
        $users = User::find()->where(['is_admin' => 1])->all();
        if (count($users) == 0) {
            return true;
        } else {
            throw new Exception('admin exist');
        }
    }

    /**
     * @param $user
     * @param $profile
     * @throws Exception
     */
    public function generateUser ($user, $profile)
    {
        if ($user->save()) {
//            $newProfile = \app\models\Profile::find()->where(['user_id' => $user->id])->one();
            $newProfile = $user->profile;
            $newProfile->name = $profile->name;
            $newProfile->family = $profile->family;
            $newProfile->number = $profile->number;
            if (!$newProfile->save()) {
                throw new Exception('can not save profile');
            }
        } else {
            throw new Exception('can not save user');
        }
    }
}
