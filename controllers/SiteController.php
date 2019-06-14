<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    // vamos a controlar las reglas de acceso
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'actions' => ['logout','index','accion1','accion2','accion3','accion4','contact'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login','index','accion4'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // cargamos la pagina de inicio
        return $this->render('index');
    }

    public function actionLogin()
    {
        // en caso de no estar logueado nos colocamos en la pagina de inicio
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        // en caso de intentar realizar un logueo
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // si es correcto volvemos a la pagina anterior
            return $this->goBack();
        }
        
        // en caso de que el logueo no sea correcto no entramos
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        // nos salimos de la sesion
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /* accion para enviar un correo con formulario */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('Correo');
            //evitar envio masivo del correo con F5
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionAccion1()
    {
        return $this->render('unica',[
            'texto'=>$this->action->id,
        ]);
    }
    
    public function actionAccion2()
    {
        return $this->render('unica',[
            'texto'=>$this->action->id,
        ]);
    }
    
    public function actionAccion3()
    {
        return $this->render('unica',[
            'texto'=>$this->action->id,
        ]);
    }
    
    public function actionAccion4()
    {
        return $this->render('unica',[
            'texto'=>$this->action->id,
        ]);
    }
}
