<?php

namespace app\controllers\user;

use app\models\Profile;
use app\models\SearchUser;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;

class CustomerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin == 0 ? false : true;
                        }
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin == 0 ? false : true;
                        }
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin == 0 ? false : true;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $id
     * @return string
     */

    public function actionIndex()
    {
        $searchModel = new SearchUser();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return string|Response
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $user = new User();
        $user->is_admin = 0;
        $profile =new Profile();
        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $user->generateUser($user, $profile);
                $transaction->commit();
            } catch (Exception $e){
                $transaction->rollBack();
                print_r($e->getMessage());

            }
        }

        return $this->render('create', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $profile = $user->profile;

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $user->save();
            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('update', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }



    /**
     * @return string
     *
     */
    /*public function actionListCustomers ()
    {
        $searchModel = new SearchUser();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('listcustomers', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }*/
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}

