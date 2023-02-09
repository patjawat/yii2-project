<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\modules\bookipd\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
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
html,
body {
    font-family: 'Prompt', sans-serif;
    font-size: 0.95rem;
    /* background: #fafafa; */
    overflow-x: hidden;
    overflow-y: auto;
    letter-spacing: 0.05px;
    font-weight: 200;
    background: #01a9d1;

}
h1,h2,h3,h4,h5,h6 {
  font-weight: 300!important;
}
.bg-light {
    background: #eff3ff !important;

}

/* .navbar-brand{
    position: relative;
} */
.navbar-brand>img {
    position: absolute;
    width: 65px;
    top: 15px;
}

.navbar-brand>span {
    position: absolute;
    top: 26px;
    margin-left: 70px;
}
</style>

<body id="top" class="d-flex flex-column h-100" style="background-color:#14b2b7;">
    <!-- <body class="d-flex flex-column h-100" style="background-image: url('<?=$myAssetBundle->baseUrl . '/images/bg-image.png'?>'); -->
    <?php $this->beginBody()?>

    <header id="header" class="bg-light">


        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="header-nav" role="navigation">
            <div class="container">
              <?=html::img($myAssetBundle->baseUrl . '/images/logo-ipd.png',['width'=>100])?>
              <a class="link-dark navbar-brand site-title mb-0" href="#home">ผู้ป่วยใน</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#home"><i class="fa-solid fa-house"></i> หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#princing"><i class="fa-solid fa-money-bill-1-wave"></i> อัตราค่าบริการ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#skills"><i class="fa-solid fa-bed-pulse"></i> สิทธิประโยชน์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#portfolio"><i class="fa-solid fa-user-nurse"></i> สำหรับเจ้าหน้าที่</a>
                        </li>
                        <!-- <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
              </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <div id="home">
        <div class="cover bg-light mt-5 pt-5">
            <div class="px-3 container">
                <div class="row">
                    <div class="col-lg-6 p-2">
                        <!-- <img class="img-fluid vert-move" src="<?php // $myAssetBundle->baseUrl . '/images/section-hero.jpg'?>" alt="hello" style="width:400px;" /> -->
                        <img class="img-fluid vert-move" src="<?=$myAssetBundle->baseUrl . '/images/hero2.png'?>" alt="hello" style="width:650px;" />
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-5">
                            <h2 class="intro-title marker fw-normal" data-aos="fade-left" data-aos-delay="50">
                                การจองห้องพิเศษ
                            </h2>
                            <div class="d-flex">
  <div class="flex-shrink-0">
    <?=Html::img($myAssetBundle->baseUrl . '/images/qr-code.png', ['width' => 130,'data-aos'=>"fade-up", 'data-aos-delay'=>"100"])?>
  </div>
  <div class="flex-grow-1 ms-3">
  <p class="lead fw-normal mt-3" data-aos="fade-up" data-aos-delay="100">
                                ผู้ป่วยที่มีความประสงค์จะจองห้องพิเศษสามารถจองผ่านระบบ Online หรือ ติดต่อสอบถาม
                                0909748044
                            </p>
                            <div class="mt-3" data-aos="fade-up" data-aos-delay="200">
                                <a class="btn  btn-primary shadow-lg mt-1 hover-effect" href="#contact">เริ่มต้นการจอง<i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
  </div>
</div>
                           
            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wave-bg"></div>
    </div>



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
    'customAnimate' => true,
]);?>

        <!-- Loading-box -->
        <div id="awaitLogin" style="display:none;margin-top:100px">
            <div class="d-flex justify-content-center">
                <div style="position:relative;width:10%;">
                    <?=Html::img('@web/images/logo.png', ['style' => 'position: absolute;width: 100px;top:1px;left:1px;']);?>
                    <div class="dbl-spinner"></div>
                    <div class="dbl-spinner"></div>
                    <h6 style="position: absolute;top:115px;left:8%;">กำลังโหลด...</h6>
                </div>
            </div>
        </div>


      </div>
      <?=$content?>


    <footer id="footer" class="mt-auto py-3 bg-dark">
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

});


JS;
$this->registerJS($js);
?>

    <?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>