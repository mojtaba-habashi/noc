<?php

namespace app\controllers\user;

use app\models\User;
use Yii;
use yii\db\Exception;

class RegistrationController extends \dektrium\user\controllers\RegistrationController
{
    /**
     * @return string
     */
    public function actionRegister()
    {
        $user = new User();
        $profile = new \app\models\Profile();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($user->load(\Yii::$app->request->post()) && $profile->load(\Yii::$app->request->post())) {
                $user->checkAdminExist();
                $user->generateUser($user, $profile);
                $transaction->commit();
            } else {
                $transaction->commit();
            }
            return $this->render('register', [
                'user'  => $user,
                'profile' => $profile
            ]);
        } catch (Exception $e) {
            $this->redirect('site/error');
        }
    }
}
