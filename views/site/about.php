<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$authenticator = \Yii::$app->authenticator;

//Google Authenticator Secret
$secret = $authenticator->secret;

//Google Charts URL for the QR-Code
$authenticator->secret = $secret;
$authenticator->name = 'ปัจวัฒน์ ศรีบุญเรือง';
echo  $qRCodeGoogleUrl = $authenticator ->qRCodeGoogleUrl;

//Code
$code = $authenticator->code;
echo $authenticator->verifyCode($code); //return bool

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
