<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\AuthHandler;
use app\models\Site;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function beforeAction( $action ) {
        if ( parent::beforeAction ( $action ) ) {
    
             //change layout for error action after 
             //checking for the error action name 
             //so that the layout is set for errors only
            if ( $action->id == 'error' ) {
                $this->layout = 'blank';
            }
            return true;
        } 
    }

    public function behaviors()
    {
        return [
           
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'authen' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        // if ($model->load(Yii::$app->request->post())){
        //     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //     // return $model->login();
        //     return $this->goBack();

        // }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionConfig()
    {
            // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            // Site::findOne(['id' => $id])
        // $model = Site::findOne(['id' => 'info']);
        // return $model;
        $this->layout = '@app/modules/vehicle2/views/layouts/main';
        // $this->layout = '@app/modules/usermanager/views/layouts/auth';
        
        if($this->findModel('info')){
            $model = $this->findModel('info');
        }else{

            $model = new Site([
                'id' => 'info'
            ]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['/site/config']);
        }else{

            return $this->render('config',[
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Site::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
