<?php

/** @var yii\web\View $this */
/** @var string $content */

// use app\assets\AppAsset;
use app\components\BookingHelper;
use app\modules\vehicle\AppAsset;
use kartik\nav\NavX;
use yii\bootstrap5\Html;
use app\components\SiteHelper;

AppAsset::register($this);
$site = SiteHelper::info();
$urlAction = $this->context->id.'/'.$this->context->action->id;
$homeActive = $urlAction == 'default/index' ? 'active' : null;
$bokingActive = $urlAction == 'booking/index' ? 'active' : null;
// $getUrl = 

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" class="h-100">

<head>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<style>
html,
body {
    margin: 0;
    background-color: #29bca5;
    background-image: url(https://vaccine.kku.ac.th/assets/images/bg_pattern.png);
    background-position: 50%;
    background-size: 600px;
}

#main {
    font-weight: 100;
    font-family: 'Sarabun', sans-serif;
}

.nav > li {
    padding: 5px !important;
    /* padding:10px; */
}
</style>

<body>
    <?php $this->beginBody()?>

    <header class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      ระบบบริหารยานพาหนะส่วนกลาง
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><?=Html::a('หน้าหลัก', ['/vehicle2'], ['class' => 'nav-link link-dark btn btn-light '.$homeActive])?></li>
        <li><?=Html::a('<i class="fa-solid fa-book-open-reader"></i> รายการจอง' . (BookingHelper::MyBooking() > 0 ? ' <span class="badge bg-danger">' . BookingHelper::MyBooking() . '</span>' : null), ['/vehicle2/booking'], ['class' => 'nav-link link-dark btn btn-light '.$bokingActive])?></li>
        <li><?=Html::a('โปรไฟล์', ['/me'], ['class' => 'nav-link link-dark btn btn-light '.$homeActive])?></li>
       
        <li><a href="#" class="nav-link link-dark btn btn-light">FAQs</a></li>
        <li><a href="#" class="nav-link link-dark btn btn-light">About</a></li>
      </ul>

      <div class="col-md-3 text-end">

<?php if (Yii::$app->user->isGuest): ?>
                <?=Html::a('<i class="fa-solid fa-user-lock"></i> เข้าสู่ระบบ', ['/auth/login'],['class' => 'btn btn-outline-primary me-2'])?>
           
            <?php else: ?>
                <?=Html::beginForm(['/auth/logout'])

. Html::submitButton(
    '<i class="fa-solid fa-power-off"></i> ออกจากระบบ ',
    ['class' => 'btn btn-danger me-2 logout','style' => 'color:#fff']
)
. Html::endForm()?>

            <?php endif;?>
        <!-- <button type="button" class="btn btn-outline-primary me-2">Login</button>
        <button type="button" class="btn btn-primary">Sign-up</button> -->
      </div>
    </header>

        <?php

NavX::widget([
    'options' => ['class' => 'nav nav-pills'],
    'items' => [
        ['label' => 'หน้าหลัก', 'url' => ['/vehicle2']],
        ['label' => 'Submenu', 'items' => [
            ['label' => 'Action', 'url' => '#'],
            ['label' => 'Another action', 'url' => '#'],
            ['label' => 'Something else here', 'url' => '#'],
        ]],
        ['label' => 'Something else here', 'url' => '#'],
        '<li class="divider"></li>',
        ['label' => 'Separated link', 'url' => '#'],
    ],
    'encodeLabels' => false,
    'activateParents' => true,
    'encodeLabels' => false,
]);

?>




            <!-- Loading-box -->
            <div id="awaitLogin" style="display:none;margin-top:100px">
                <div class="d-flex justify-content-center">
                    <div style="position:relative;width:10%;">
                        <?=Html::img('@web/images/moph_logo.png',['style' => 'position: absolute;width: 100px;top:1px;left:1px;']);?>
                        <div class="dbl-spinner"></div>
                        <div class="dbl-spinner"></div>
                        <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                    </div>
                </div>
            </div>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="row justify-content-md-center">
            <div class="col-12">
<div id="content-container">
<?php // $this->context->id;?>
<?php // $this->context->action->id;?>
<?php
// echo Yii::$app->request->referrer;
// echo Yii::$app->controller->id;
// echo Yii::$app->controller->action->id;
// echo Yii::$app->controller->module->id;
echo $urlAction;
?>
    <?=$content?>
</div>
            
            </div>
        </div>
    </main>


    <?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>