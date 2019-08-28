<?php

namespace app\controllers\user;

use app\models\Station;
use Yii;
use app\models\Service;
use app\models\Servicesearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'fetch-station'],
                'rules' => [
                    [
                        'actions' => ['index', 'fetch-station'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $customer_id
     * @return string
     */
    public function actionIndex($customer_id)
    {
        $searchModel = new Servicesearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $customer_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'customer_id' => $customer_id,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $customer_id
     * @return string|\yii\web\Response
     */
    public function actionCreate($customer_id)
    {
        $service = new Service();
        $station = new Station();
        if ($service->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $service->station_id = intval($service->station_id);
                $service->user_id = $customer_id;
                $station = Station::findOne($service->station_id);
                $station->is_used = 1;
                $station->save();
                $service->save();
                $transaction->commit();

                return $this->redirect(['view', 'id' => $service->id]);
            } catch (\Exception $exception) {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $service,
            'station' => $station,
        ]);
    }

    /**
     * @return array
     */
    public function actionFetchStation()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->post() && $data = Yii::$app->request->post()) {
            $serviceType = Yii::$app->request->post()['data'];
            $station = new Station();
            $stations = $station->getAjaxStations($serviceType);
            $response = [];
            foreach ($stations as $station) {
                $response[$station->id] = $station->name;
            }

            return $response;
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }

            Throw new \Exception("sadasdasdasd");
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            return $this->redirect(['index']);
        }

        Throw new \Exception("sadasdasdasd");
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}