<?php

/** @var yii\web\View $this */
/** @var string $content */

// use app\assets\AppAsset;
use app\modules\vehicle\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
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
</style>

<body>
    <?php $this->beginBody() ?>
    <header class="container d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <?php

use kartik\nav\NavX;
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
    'encodeLabels' => false
]);


    // NavBar::begin([
    //     'brandLabel' => Yii::$app->name,
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => ['class' => 'nav nav-pills']
    // ]);
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav'],
    //     'items' => [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         ['label' => 'About', 'url' => ['/site/about']],
    //         ['label' => 'Contact', 'url' => ['/site/contact']],
    //         Yii::$app->user->isGuest
    //             ? ['label' => 'Login', 'url' => ['/site/login']]
    //             : '<li class="nav-item">'
    //                 . Html::beginForm(['/site/logout'])
    //                 . Html::submitButton(
    //                     'Logout (' . Yii::$app->user->identity->username . ')',
    //                     ['class' => 'nav-link btn btn-link logout']
    //                 )
    //                 . Html::endForm()
    //                 . '</li>'
    //     ]
    // ]);
    // NavBar::end();
    ?>

        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4 text-white">ระบบขอใช้ยานพาหนะส่วนกลาง</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <?=Html::a('หน้าหลัก',['/vehicle2'],['class'=> 'nav-link active'])?>
            </li>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-book-open-reader"></i> รายการจอง',['/vehicle2/booking'],['class'=> 'nav-link'])?>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <?= $content ?>
            </div>
        </div>
    </main>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>