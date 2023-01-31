<?php

use app\components\UserHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

\yii\web\YiiAsset::register($this);
?>
<style>
.driver-profile {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 20px;
}

table {
    background-color: #fff;
}

.card-driver {
    /* border-radius: 50%;
    width: 116px;
    height: 116px;
    position: absolute;
    top: -10;
    box-shadow: 0px 5px 50px 0px #084298, 0px 0px 0px 2px rgb(107 74 255 / 50%); */

}
</style>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">ผู้จอง : <?=$model->createBy->fullname;?></h5>
                    <p>เรื่อง : <?=$model->title;?></p>
                    <p>สถานที่ : <?=$model->data_json['point'];?></p>
                    <p>ผู้โดยสาร :
                        <?=isset($model->data_json['passenger_number']) ? $model->data_json['passenger_number'] : null?>
                    </p>
                    <p>ออกเดินทาง : <?=$model->start;?></p>
                    <p>เดินทางกลับ : <?=$model->end;?></p>

                    </div>
                    <div class="card-footer">
                    <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning','style' => 'margin-right: 5px;']) ?>

                </div>
            </div>
        </div>
    </div>



    <?php
$ConfirmUrl = Url::to(['/vehicle/booking/confirm-job']);
$userConfirm = UserHelper::getUser('fullname');
$js = <<< JS
$('#confirm-job').click(function (e) {
    e.preventDefault();

Swal.fire({
  title: 'ยืนยันรับภาระกิจ?',
  text: "$userConfirm!",
  icon: 'warning',
  showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่,ยืนยัน!',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
        type: "get",
        url: "$ConfirmUrl",
        data:{id:$model->id},
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
  }
})

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
function CancelWarnings() {

}
JS;
$this->registerJs($js, View::POS_END)
?>