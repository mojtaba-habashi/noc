<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\controllers\user;

use dektrium\user\controllers\RegistrationController as BaseRegistrationController;
use dektrium\user\models\RegistrationForm;
use yii\web\NotFoundHttpException;

class RegistrationController extends BaseRegistrationController
{
    public function actionRegister()
    {


        /** @var RegistrationForm $model */
        $model = \Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

            if ($model->load(\Yii::$app->request->post()) && $model->register()) {
                $this->trigger(self::EVENT_AFTER_REGISTER, $event);

                return $this->render('/message', [
                    'title'  => \Yii::t('user', 'Your account has been created'),
                    'module' => $this->module,
                ]);
            }

            return $this->render('register', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        }

}
