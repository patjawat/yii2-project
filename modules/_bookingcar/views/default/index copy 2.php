<?php
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
use app\modules\bookingcar\AppAsset;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
?>

<style>
element.style {}

.mb-3 {
    margin-bottom: 1rem !important;
}

.card {
    border: var(--bs-card-border-width) solid rgb(0 0 0 / 6%);
}
</style>


<section class="pt-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center py-6">
                <h1 class="fs-9 fw-bold">ระบบขอใช้บริการยานพาหนะ</h1>
                <h2 class="mb-4 fs-9 fw-bold">โรงพยาบาลบึงกาฬ</h2>
                <p class="mb-6 lead text-secondary">บริการรถยนต์ส่วนกลางโดยมีทั้ง รถเก๋ง รถตู้ รถบัส และรถบรรทุก
                    เพื่อบริการท่านในกิจกรรมต่างๆ ที่เกี่ยวข้องกับภารกิจของคณะ หน่วยงาน และมหาวิทยาลัย
                    โดยให้บริการทั้งในเขตจังหวัด และนอกเขตจังหวัดบึงกาฬ<br class="d-none d-xl-block">in one place! The
                    most intuitive way to imagine<br class="d-none d-xl-block">your next user experience.</p>
                <div class="text-center text-md-start"><a class="btn btn-warning me-3 btn-lg" href="#!"
                        role="button">Get started</a><a class="btn btn-link text-warning fw-medium" href="#!"
                        role="button" data-bs-toggle="modal" data-bs-target="#popupVideo"><svg
                            class="svg-inline--fa fa-play fa-w-14 me-2" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="play" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z">
                            </path>
                        </svg><!-- <span class="fas fa-play me-2"></span> Font Awesome fontawesome.com -->Watch the
                        video </a></div>
            </div>
            <div class="col-md-6 text-end">
                <?=Html::img($AssetBundle->baseUrl.'/images/logo31.png',['class' => 'pt-7 pt-md-0 img-fluid']);?>
            </div>
        </div>
    </div>
</section>




<div class="container text-center" style="margin-top:-130px;">
    <div class="row justify-content-md-center">

        <div class="col-8">
            <div class="card mb-3">
                <div class="card-body">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<br>
<div class="container text-center">
    <div class="row justify-content-md-center">
        <div class="col-8">

            <div class="card">
                <div class="card-body">

                    <?= \edofre\fullcalendar\Fullcalendar::widget([
        'options'       => [
            'id'       => 'calendar',
            'language' => 'th'
        ],
        'clientOptions' => [
          'theme'=> false,
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'month',
            'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),

        ],
        'events'=> Url::to(['/bookingcar/default/events', 'id' => '1111']),
    ]);
?>
                </div>
            </div>

        </div>
    </div>
</div>






<div class="row">
    <div class="col-12">
    </div>
</div>

<div class="row">
    <div class="col-6">
        <?php
    //      $this->render('bookinglist', [
    //       'searchModel' => $searchModel,
    //       'dataProvider' => $dataProvider,
    //   ]);
?>
    </div>
    <div class="col-6">

    </div>
</div>