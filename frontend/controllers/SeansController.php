<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use yii\web\NotFoundHttpException;
use frontend\components\AuthHandler;

class SeansController extends Controller
{


    public $layout = '@app/views/layouts/xLayout.php';

    protected $_xapi;

    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
                'authclient' => 'xapi',
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function getXapi() {
        if (!($this->_xapi instanceof \frontend\components\XapiV1Client)) {
            $this->_xapi = clone \Yii::$app->xapi;
            if (func_get_args()) {
              //  $this->xapi->setHandlerParams(func_get_arg(0));
            }
        }
        return $this->_xapi;
    }


    protected function checkResponse($response)
    {
        if (!$response->isOk && (!empty($response->data['message']))){
            $session = Yii::$app->session;
            $session->setFlash('danger', $response->data['message']);
        }
    }

    public function actionSeansesList()
    {
        $t=1;
        if (!\Yii::$app->request->isPost){
            $response = $this->getXapi()->callMethod('/sale', []);
      //      return $this->render('debug' , ['response' => $response] );
            if ($response['status']){
                return $this->render('seansesList',[
                    'seansesList' => $response['data'],
                    'response' => $response,
                ]);
            } else {
              //  $session = Yii::$app->session;
             //   $session->setFlash('error', $response['data']);
                return $this->goBack();

            }
        } else {
            $_post = \Yii::$app->request->post();
            if (isset($_post['seansId'])){
                $seansId = $_post['seansId'];
                return $this->redirect(['/seans/choise-seats', 'seansId' =>$seansId]);
            } else {
                throw new NotFoundHttpException('Сеанс не найден');
            }
        }

    }

    public function actionChoiseSeats($seansId)
    {
        $t=1;
        if (!\Yii::$app->request->isPost){
          //  $client = new Client();
            $response = $this->getXapi()->callMethod('/sale/get-seans', ['id' => $seansId]);
            //      return $this->render('debug' , ['response' => $response] );
            if ($response['status']){
                return $this->render('seans',[
                    'seans' => $response['data'],
                ]);
            } else {
             //   $session = Yii::$app->session;
             //   $session->setFlash('error', $response['data']);
                return $this->goBack();

            }

            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl('http://api.server/v1/sale/get-seans')
                ->setData(['id' => $seansId])
                ->send();
            $seans = $response->isOk ? $response->data : [];
            $result['data'] = $response->data;
            $result['code'] = $response->headers['http-code'];
            $result['headers'] = $response->headers;
            return $this->render('seans',[
                'seans' => $seans,
                'response' => $response,
                'result' => $result,
            ]);

        } else {
            $_post = \Yii::$app->request->post();
            if (isset($_post['reservation'])){
                $datas = json_decode($_post['reservation'], true);
                if (!empty($datas)){
                    return $this->redirect(['/seans/make-reservation',
                        'seansId' => $seansId,
                        'reservation' => $_post['reservation'],
                    ]);
                }
                return $this->redirect('/seans/seanses-list');
            } else {
                throw new NotFoundHttpException('Сеанс не найден');
            }
        }
    }

    public function actionMakeReservation($seansId, $reservation)
    {
        $datas = json_decode($reservation, true);
        foreach ($datas as $data){
            $buf = json_decode($data, true);
            $myReservation[] = [
                'rowNumber' => $buf['rowNumber'],
                'seatNumber' => $buf['seatNumber'],
                'persona' => 'lokoko',
            ];
        }
        if (!empty($myReservation)){
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://api.server/v1/sale/get-reservation')
                ->setData(['seansId' => $seansId, 'reservation' => $myReservation] )
                ->send();
            $this->checkResponse($response);
            //    return $this->render('debug' , ['response' => $response] );
            if ($response->isOk){
                return $this->render('seansSuccessMessage', ['reservation' => $response->data]);
            } else {
                return $this->redirect(['/seans/choise-seats', 'seansId' => $seansId]);
            }
        } else {
            throw new NotFoundHttpException('Данные пусты');
        }

    }


}
