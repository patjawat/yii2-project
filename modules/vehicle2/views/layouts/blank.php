<?php

/** @var yii\web\View $this */
/** @var string $content */

// use app\assets\AppAsset;
use app\components\BookingHelper;
use app\modules\vehicle\AppAsset;
use kartik\nav\NavX;
use yii\bootstrap5\Html;

AppAsset::register($this);

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
</style>

<body>
    <?php $this->beginBody()?>
    <header class="container d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
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

        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4 text-white">ระบบขอใช้ยานพาหนะส่วนกลาง</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <?=Html::a('หน้าหลัก', ['/vehicle2'], ['class' => 'nav-link active'])?>
            </li>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-book-open-reader"></i> รายการจอง' . (BookingHelper::MyBooking() > 0 ? ' <span class="badge bg-danger">' . BookingHelper::MyBooking() . '</span>' : null), ['/vehicle2/booking'], ['class' => 'nav-link'])?>
            </li>

            <?php if (Yii::$app->user->can('driver')): ?>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-user-tag"></i> ภาระกิจ' . (BookingHelper::Myjob() > 0 ? ' <span class="badge bg-danger">' . BookingHelper::Myjob() . '</span>' : null), ['/vehicle2/booking'], ['class' => 'nav-link'])?>
            </li>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-list-ul"></i> รายการขอใช้ยานพหนะ', ['/vehicle2/booking'], ['class' => 'nav-link'])?>
            </li>
            <?php endif;?>

            <?php if (Yii::$app->user->can('admin')): ?>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-list-ul"></i> รายการขอใช้ยานพหนะ', ['/vehicle2/booking'], ['class' => 'nav-link'])?>
            </li>
            <?php endif;?>

            <?php if (Yii::$app->user->isGuest): ?>
            <li class="nav-item">
                <?=Html::a('<i class="fa-solid fa-user-lock"></i> เข้าสู่ระบบ', ['/auth/login'],['class' => 'nav-link'])?>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <?=Html::beginForm(['/auth/logout'])
// . Html::submitButton(
//     '<i class="fa-solid fa-power-off"></i> (' . Yii::$app->user->identity->username . ')',
//     ['class' => 'btn btn-outline-danger logout']
// )
// . Html::endForm()
. Html::submitButton(
    '<i class="fa-solid fa-power-off"></i> ออกจากระบบ ',
    ['class' => 'btn btn-danger logout','style' => 'color:#fff']
)
. Html::endForm()?>
            </li>

            <?php endif;?>

        </ul>
    </header>


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
    <?=$content?>
</div>
            
            </div>
        </div>
    </main>


    <?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>