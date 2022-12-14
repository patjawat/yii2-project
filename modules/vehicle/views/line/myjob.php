<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use app\modules\vehicle\models\Booking;
use app\components\BookingHelper;
use app\components\UserHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);
$status = BookingHelper::CountByStatus();


$this->title = 'ภารกิจของฉัน';
?>
<style>
td>img {
    width: 100px;
}

table {
    background-color: #fff;
}

.product-description {
    color: #6c757d;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>

<?php if($dataProvider->getTotalCount() == 0):?>
<h1 class="text-center">ไม่มีภาระกิจ</h1>
  <?php else:?>
<div class="booking-index">


    <div class="row">


        <?php foreach($dataProvider->getModels() as $model):?>
        <div class="col-sm-6">
            <div class="card border-0 shadow-md mb-3 bg-body-tertiary rounded">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="p-0">
                            <h6 class="card-title product-description"><i class="fa-solid fa-book-open-reader"></i>
                                ผู้จอง : <?=$model->createBy->fullname;?></h6>
                        </div>
                        <div class="ms-auto p-2">
                            สถานะ : <?=$this->render('booking_status',['model'=>$model])?>
                        </div>
                    </div>
                    <ul>
                    <li>เรื่อง : <?=$model->title;?></li>
                    <li>สถานที่ : <?=$model->data_json['point'];?></li>
                    <li>ผู้โดยสาร : <?=isset($model->data_json['passenger_number']) ? $model->data_json['passenger_number'] : null?></li>
                    <li>ออกเดินทาง : <?=$model->start;?></li>
                    <li>เดินทางกลับ : <?=$model->end;?></li>
                       
                    </ul>

                    <div class="d-flex">

                        <!-- Flex -->
                        <div class="p-0">
                            <?=Html::a('<i class="far fa-edit"></i> เสร็จสิ้นภาระกิจ', ['confirm-success', 'id' => $model->id], ['class' => 'btn btn-success confirm-job','title' => $model->title]);?>
                            <?php // Html::a('<i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...',['/vehicle/line/view','id' => $model->id],['class' => 'btn btn-primary']);?>
                        </div>
                        <div class="ms-auto p-2">
                            <!-- สถานะ : <?php // $this->render('booking_status',['model'=>$model])?> -->
                            ขอใช้รถทะเบียน :
                            <?=isset($model->car->data_json['car_regis']) ? $model->car->data_json['car_regis'] : '-'?>
                        </div>
                    </div>
                    <!-- End Flex -->
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
<?php endif;?>
    <?php 
$checkMe = Url::to(['/usermanager/line/checkme']);
$js = <<< JS

$('#awaitLogin').show();
$('#content-container').hide();

function runApp() {
      liff.getProfile().then(profile => {
        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          success: function (response) {
            // $('#test').text(JSON.stringify(response))
            $('#test').text('testx')
            console.log(response);
            if(response.register == false){
              liff.closeWindow();
            }else{
              $('#awaitLogin').hide();
              $('#content-container').show();
            }
            // window.location.href
          }
        });

      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657676585-2NDKjXZG" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));



$('.confirm-job').click(function (e) { 
  $('#awaitLogin').show();
$('#content-container').hide();

});

$('.dis_cancel').click(function (e) { 

    e.preventDefault();
    console.log('Calcel')
    Swal.fire(
  'ไม่สามารถยกเลิกได้!',
  'เนื่องจากอนุมัติแล้วกรุณาติดต่อผู้กูแลระบบ!',
  'warning'
)    
});

JS;
$this->registerJs($js,View::POS_END)
?>