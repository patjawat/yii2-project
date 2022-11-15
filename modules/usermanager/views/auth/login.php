<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Authentication';
$this->params['breadcrumbs'][] = $this->title;
?>


  <div class="row justify-content-md-center">

    <div class="col-3">
   
    <h1><?= Html::encode($this->title) ?></h1>

<p>กรุณายืนยันตัวตนเพื่อเข้าสู่ระบบ:</p>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group mb-3">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?=Html::a('สมัครสมาชิก',['/auth/signup'],['class' => 'btn btn-success']);?>
            </div>
 

        <?php ActiveForm::end(); ?>



    </div>
    <div class="col-3">
    

    <div class="card" style="margin-top: 117px;">
                <div class="card-body">
                   
          
    <?php $authAuthChoice = yii\authclient\widgets\AuthChoice::begin(['baseAuthUrl' => ['auth/auth']]); ?>

    <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php
                switch ($client->getName()){
                    case 'facebook':
                        $class = 'primary';
                        $icon = '<i class="fa-brands fa-facebook"></i>';
                        break;
                    case 'google':
                        $class = 'danger';
                        $icon = '<i class="fa-brands fa-google"></i>';
                        break;
                    case 'live':
                        $class = 'warning';
                        break;

                }
 ?>
                  <div class="d-grid gap-2">
<?=$authAuthChoice->clientLink($client, $icon.' Login with '.ucfirst($client->getName()), ['class' => 'btn btn-'.$class])?>

<?php endforeach; ?>
</div>
<?php yii\authclient\widgets\AuthChoice::end(); ?>
</div>
            </div>


    </div>
  </div>
