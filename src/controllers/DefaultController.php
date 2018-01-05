<?php
/**
 * Created by PhpStorm.
 * User: naffiq
 * Date: 6/7/2017
 * Time: 10:33 PM
 */

namespace naffiq\bridge\controllers;


use naffiq\bridge\BridgeModule;
use naffiq\bridge\models\LoginForm;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Response;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
    public $layout = '@bridge/views/layouts/main';

    /**
     * @var BridgeModule
     */
    public $module;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'class' => $this->module->dashboardAction
            ]
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * ElFinder file manager
     *
     * @return string
     */
    public function actionElfinder()
    {
        return $this->render('elfinder');
    }

    /**
     * Change admin menu state
     *
     * @param bool $state
     *
     * @return array
     */
    public function actionSetMenuState($state)
    {
        \Yii::$app->session->set('bridge-menu-state', $state === 'true' ? 1 : 0);

        \Yii::$app->response->format = Response::FORMAT_JSON;

        return ['state' => $state];
    }
}