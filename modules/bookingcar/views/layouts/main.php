<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\modules\bookingcar\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="d-flex flex-column h-100" style="background-color:#edf2f8;">
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
        ['label' => '<i class="fa-solid fa-house-user"></i> หน้าหลัก', 'url' => ['/site/index']],
        ['label' => '<i class="fa-solid fa-user-tag"></i> หนักงานคนขับ', 'url' => ['/bookingcar/default/driver-list']],
        ['label' => '<i class="fa-solid fa-info"></i> เกี่ยวกับระบบ', 'url' => ['/site/contact']],
        ['label' => '<i class="fa-solid fa-list-ul"></i> รายการขอใช้ยานพหนะ', 'url' => ['/bookingcar/booking']],
        [
            'label' => 'ตั้งค่า', 
            'items' => [
                ['label' => '<i class="fa-solid fa-user-shield"></i> ผู้ใช้งานระบบ', 'url' => '/usermanager'],
                ['label' => '<i class="fa-solid fa-car"></i> รถ', 'url' => '/bookingcar/car'],
                [
                     'label' => 'Section 3', 
                     'items' => [
                         ['label' => 'Section 3.1', 'url' => '/'],
                         ['label' => 'Section 3.2', 'url' => '#'],
                         [
                             'label' => 'Section 3.3', 
                             'items' => [
                                 ['label' => 'Section 3.3.1', 'url' => '/'],
                                 ['label' => 'Section 3.3.2', 'url' => '#'],
                             ],
                         ],
                     ],
                 ],
            ],
        ],
        Yii::$app->user->isGuest
        ? ['label' => '<i class="fa-solid fa-user-lock"></i> เข้าสู่ระบบ', 'url' => ['/site/login']]
        : '<li class="nav-item">'
        . Html::beginForm(['/site/logout'])
        . Html::submitButton(
            '<i class="fa-solid fa-power-off"></i> (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-outline-danger btn-sm logout']
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
        font-weight:100;
        font-family: 'Sarabun', sans-serif;
    }
</style>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?=Breadcrumbs::widget(['links' => $this->params['breadcrumbs']])?>
        <?php endif?>
        <?=Alert::widget()?>
        <?=$content?>
    </div>
</main>



<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?=date('Y')?></div>
            <div class="col-md-6 text-center text-md-end"><?=Yii::powered()?></div>
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
