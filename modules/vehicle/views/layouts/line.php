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


<body class="d-flex flex-column h-100" style="background-color:#edf2f8;">
    <?php $this->beginBody()?>


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