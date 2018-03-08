<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\web\Controller;
define('ID','2007723489441141');
define('SECRET','b0aafc0e4df063277e4762278b0ce4ec');
define('URL','http://akatsuki.ua/auth/login-fb');

class AuthController extends Controller
{

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    
    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }

        return $this->render('signup', ['model'=>$model]);
    }

    public function actionLoginVk($uid, $first_name, $photo)
    {
        $user = new User();
        if($user->saveFromVk($uid, $first_name, $photo))
        {
            return $this->redirect(['site/index']);
        }
    }

    public function actionLoginFb()
    {
        if(isset($_GET['code'])) {
            $token = json_decode(file_get_contents('https://graph.facebook.com/v2.12/oauth/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code']), true);
        }
        if(isset($token)) {
            $data = json_decode(file_get_contents('https://graph.facebook.com/v2.12/me?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code'].'&access_token='.$token['access_token'].'&fields=id,name,email'), true);
            $data['photo'] = 'https://graph.facebook.com/v2.12/'.$data['id'].'/picture';
        }

        $uid = $data['id'];
        $email = $data['email'];
        $name = $data['name'];
        $photo = $data['photo'];

        $user = new User();
        if($user->saveFromFb($uid,$name,$photo,$email))
        {
            return $this->redirect(['site/index']);
        }
    }
    
    public function actionTest()
    {
        $user = User::findOne(1);

        Yii::$app->user->logout($user);
        
        if(Yii::$app->user->isGuest)
        {
            echo 'Пользователь гость';
        }
        else
        {
            echo 'Пользователь Авторизован';
        }
    }
}