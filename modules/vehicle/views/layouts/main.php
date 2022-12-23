<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\modules\vehicle\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Modal;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;
use app\components\BookingHelper;
AppAsset::register($this);
$myAssetBundle = AppAsset::register($this);

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<style>
    html, body {
    font-family: 'Prompt', sans-serif;
    font-size: 0.95rem;
    background: #fafafa;
    overflow-x: hidden;
    overflow-y: auto;
    letter-spacing: 0.05px;
    font-weight: 200;
    background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
    background: linear-gradient( 3deg, #e6e9f0 0%, rgba(224, 242, 241, 0) 100% ), URL("<?=$myAssetBundle->baseUrl.'/images/5570863.jpg'?>");
    background-attachment: fixed;
    background-size: cover;
    background-position: center center;
}
</style>
<body class="d-flex flex-column h-100" style="background-color:#edf2f8;">
<!-- <body class="d-flex flex-column h-100" style="background-image: url('<?=$myAssetBundle->baseUrl.'/images/bg-image.png'?>'); -->
    <?php $this->beginBody()?>

    <header id="header">
        <?php
NavBar::begin([
    'brandLabel' => 'ระบบบริหารยานพาหนะ',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark'],
]);

echo Nav::widget([
    'encodeLabels' => false,
    'options' => ['class' => 'navbar-nav ms-auto flex-nowrap'],
    'items' => [
        // ['label' => '<i class="fa-solid fa-user-tag"></i> หนักงานคนขับ', 'url' => ['/vehicle/default/driver-list']],
        ['label' => '<i class="fa-solid fa-users"></i> พนักงานขับรถ', 'url' => ['/vehicle/driver']],
        ['label' => '<i class="fa-solid fa-chart-simple"></i> รายงานการใช้รถ', 'url' => ['/vehicle/report']],
        ['label' => '<i class="fa-solid fa-book-open-reader"></i> รายการจอง'.(BookingHelper::MyBooking() > 0 ? ' <span class="badge bg-danger">'.BookingHelper::MyBooking().'</span>' : null), 'url' => ['/vehicle/booking']],
        Yii::$app->user->can('driver') ? ['label' => '<i class="fa-solid fa-user-tag"></i> ภาระกิจ'.(BookingHelper::Myjob() > 0 ? ' <span class="badge bg-danger">'.BookingHelper::Myjob().'</span>' : null), 'url' => ['/vehicle/myjob']] : '',
        Yii::$app->user->can('driver') ? ['label' => '<i class="fa-solid fa-list-ul"></i> รายการขอใช้ยานพหนะ', 'url' => ['/vehicle/booking']] : '',
        ['label' => '<i class="fa-solid fa-user-check"></i> โปรไฟล์', 'url' => ['/me']],
        Yii::$app->user->can('admin') ? [
            'label' => 'ตั้งค่า', 
            'items' => [
                ['label' => '<i class="fa-solid fa-user-shield"></i> ผู้ใช้งานระบบ', 'url' => ['/usermanager']],
                ['label' => '<i class="fa-solid fa-car"></i> รถ', 'url' => ['/vehicle/car']],
                ['label' => '<i class="fa-solid fa-car"></i> ประเภทรถ', 'url' => ['/vehicle/car-type']],
            ],
        ] : '',

       
        Yii::$app->user->isGuest
        ? ['label' => '<i class="fa-solid fa-user-lock"></i> เข้าสู่ระบบ', 'url' => ['/auth/login']]
        : '<li class="nav-item">'
        . Html::beginForm(['/auth/logout'])
        // . Html::submitButton(
        //     '<i class="fa-solid fa-power-off"></i> (' . Yii::$app->user->identity->username . ')',
        //     ['class' => 'btn btn-outline-danger logout']
        // )
        // . Html::endForm()
        . Html::submitButton(
            '<i class="fa-solid fa-power-off"></i> ออกจากระบบ ',
            ['class' => 'btn btn-danger logout']
        )
        . Html::endForm()
        . '</li>',
    ],
    'dropdownClass' => Dropdown::classname(), // use the custom dropdown
    // 'options' => ['class' => 'navbar-nav mr-auto'],
]);
NavBar::end();
?>
    </header>

    <style>
    #main {
        font-weight: 100;
        font-family: 'Sarabun', sans-serif;
    }
    </style>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?=Breadcrumbs::widget(['links' => $this->params['breadcrumbs']])?>
            <?php endif?>

            <?php


        Modal::begin([
            'id' => 'main-modal',
            'title' => '<h4 class="modal-title"></h4>',
            // 'size' => 'modal-sm',
            'footer' => '',
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
        ]);
        Modal::end();
        ?>
            <?=Alert::widget()?>
            <?php \dominus77\sweetalert2\Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]); ?>

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
            <div id="content-container">
                <?= $content ?>
            </div>
        </div>
    </main>



    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; โรงพยาบาลบึงกาฬ <?=date('Y')?></div>
                <div class="col-md-6 text-center text-md-end">นายปัจวัฒน์ ศรีบุญเรือง : ผู้พัฒนา 
                    <a href="https://www.facebook.com/patjawat"><i class="fa-brands fa-facebook"></i></a> | 
                    <a href="https://line.me/ti/p/VYINEcV-kE" class="text-success"><i class="fa-brands fa-line"></i></a> 
                 </div>
            </div>
        </div>
    </footer>

    <?php
$js = <<<JS
    AOS.init();
JS;
$this->registerJS($js);
?>

    <?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>