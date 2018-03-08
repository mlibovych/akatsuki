<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

define('ID','2007723489441141');
define('SECRET','b0aafc0e4df063277e4762278b0ce4ec');
define('URL','http://akatsuki.ua/auth/login-fb')
?>
<div class="leave-comment mr0"><!--leave comment-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        or
                        <?= Html::a('Login with Facebook', 'https://www.facebook.com/v2.9/dialog/oauth/?client_id='.ID.'&redirect_uri='.URL.'&response_type=code&scope=public_profile,email', ['class' => 'btn btn-primary']) ?>

                    </div>
                </div>

            <?php ActiveForm::end(); ?>

            </div>
        </div>

        <div class="col-md-2 ">
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?152"></script>
            <script type="text/javascript">
                VK.init({apiId: 6390566});
            </script>

            <!-- VK Widget -->
            <div id="vk_auth"></div>
            <script type="text/javascript">
                VK.Widgets.Auth("vk_auth", {"authUrl":"/auth/login-vk"});
            </script>
        </div>

        <div class="col-md-2 ">

        </div>
    </div>
</div>
