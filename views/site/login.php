<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6  login_social">



<?php $authAuthChoice = AuthChoice::begin([
'baseAuthUrl' => ['site/auth']
]); ?>

<?php $authAuthChoice = yii\authclient\widgets\AuthChoice::begin([
                'baseAuthUrl' => ['site/auth']
            ]); ?>

            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php
                switch ($client->getName()){
                    case 'facebook':
                        $class = 'primary';
                        break;
                    case 'google':
                        $class = 'danger';
                        break;
                    case 'live':
                        $class = 'warning';
                        break;

                }

                echo $authAuthChoice->clientLink($client, 'Login with '.ucfirst($client->getName()), ['class' => 'btn btn-'.$class.' btn-block']) ?>
            <?php endforeach; ?>

        <?php yii\authclient\widgets\AuthChoice::end(); ?>
        </div>
    </div>
</div>