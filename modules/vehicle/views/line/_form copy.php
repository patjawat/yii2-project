<?php
use app\components\UserHelper;
use app\models\Provinces;
use app\modules\vehicle\AppAsset;
use app\modules\vehicle\models\Category;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
$myAssetBundle = AppAsset::register($this);
$user = UserHelper::getUser();

// $car_id = isset($car_id) ? Category::findOne($car_id)->photo : $model->car->photo;
// $car = $model->isNewRecord ? Category::findOne($car_id) : $model->car->photo;

// $disable = $model->isNewRecord ? false : (Yii::$app->user->can('driver') ? true : false); // (Yii::$app->user->can('driver') ? true : false) || ($model->isNewRecord ? false : true);
$disable = false;
?>

<style>

.form-control {
    font-family: 'Prompt';
    display: block;
    height: 50px;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1.5rem;
    font-weight: 400;
}

.input-group-text {
    font-size: 1.58rem;
}
</style>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}
.form-label {
    margin-bottom: 0.5rem;
    font-size: 18px;
    font-weight: 400;
}

.box-img>img {
    width: 200px;
}

.driver-profile {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 20px;
}

.card-driver {
    border-radius: 50%;
    width: 116px;
    height: 116px;
    position: absolute;
    top: -10;
    box-shadow: 0px 5px 50px 0px #084298, 0px 0px 0px 2px rgb(107 74 255 / 50%);
}

.input-group > .select2-container--krajee-bs5:not(:first-child), .input-group > .select2-container--krajee-bs5:not(:first-child) .select2-selection {
    height: 50px;
}
</style>

<?php $form = ActiveForm::begin([
    'id' => 'form-line'
]);?>
<div class="row justify-content-center">
    <div class="col-12">

        <?=$form->field($model, 'ref')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'booking_type')->hiddenInput(['value' => 'vehicle'])->label(false)?>
        <?=$form->field($model, 'data_json[fullname]')->hiddenInput(['disabled' => $disable, 'value' => Yii::$app->user->identity->username])->label(false)?>
        <?=$form->field($model, 'data_json[phone]')->hiddenInput(['disabled' => $disable, 'value' => $user->phone])->label(false)?>

 <div class="card">
    <div class="card-body">
        <h3 class="card-title"> ทะเบียน <?php //  $model->car->data_json['car_regis']?></h3>
       
        <div class="d-flex justify-content-between">
        <div class="image-parent box-img">
        <?php // Html::img(['/file', 'id' => $model->car->photo,['class' =>'bd-placeholder-img','style' => 'width:1px;']])?>
          </div>
          <div>
          <p><small>ยี่ห้อ : <?php // $model->car->data_json['band']?> </p>
          <p>รุ่น : <?php // $model->car->data_json['model']?></small></p>
          </div>
        </div>
    </div>
    <div class="card-footer">
    <!-- ทะเบียน <?php // $model->car->data_json['car_regis']?> -->
    วันที่ <?=$model->start;?> ถึง <?=$model->end;?>
    </div>
 </div>

  <div class="card mt-4">
      <div class="card-body">
        <h3 class="card-title">แบฟอร์มจองรถ</h3>
      

        <div class="row justify-content-between">
            <div class="col-12">
                <?=$form->field($model, 'start')->hiddenInput()->label(false);?>
                <?=$form->field($model, 'end')->hiddenInput()->label(false);?>
            </div>
            <div class="col-12">

                <?=$form->field($model, 'title', [

    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-regular fa-pen-to-square"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
    'inputOptions' =>
    [
        'autofocus' => 'autofocus',
        'tabindex' => '1',
    ],

])->textInput(['disabled' => $disable])->label('วัตถุประสงค์การจอง')?>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?=$form->field($model, 'data_json[point]', [
    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
    'inputOptions' =>
    [
        'required' => true,
    ],
])->textInput(['disabled' => $disable])->label('จุดหมายปลายทาง')?>
            </div>
            <div class="col-12">
                <?php
echo $form->field($model, 'province_id', [
    'inputTemplate' => '<div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa-solid fa-building-circle-check"></i>&nbsp;</span>
    </div>
    {input}
    </div>',
])->widget(Select2::classname(), [
    'options' => ['placeholder' => 'เลือกจังหวัด ...'],
    'disabled' => $disable,
    'size' => Select2::LARGE,
    'data' => ArrayHelper::map(Provinces::find()->all(), 'id', 'name_th'),
]);
?>
            </div>
            <div class="col-12">
                <?=$form->field($model, 'district_id', [
    'inputTemplate' => '<div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa-solid fa-building-circle-check"></i>&nbsp;</span>
    </div>
    {input}
    </div>',
])->widget(DepDrop::className(), [
    'type' => DepDrop::TYPE_SELECT2,
    'options' => ['id' => 'subcat1-id', 'placeholder' => 'เลือก ...'],
    'disabled' => $disable,
    'pluginOptions' => [
        'depends' => [Html::getInputId($model, 'province_id')],
        'placeholder' => 'เลือกอำเภอ',
        'url' => Url::to(['district-list']),
    ],
])?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?=$form->field($model, 'data_json[passenger_number]', [
    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-users"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
    'inputOptions' =>
    [
        'autofocus' => 'autofocus',
        'tabindex' => '4',
    ],
])->textInput(['type' => 'number', 'disabled' => $disable])->label('จำนวนผู้โดยสาร')?>
            </div>
            <div class="col-12">
                <?=$form->field($model, 'car_id')->hiddenInput()->label(false);?>

            </div>
        </div>



        <div class="row">
            <div class="col-12">
                <?=$form->field($model, 'data_json[pick_up_point]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-location-pin"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' => $disable])->label('จุดรับกลับ')?>

            </div>
        </div>


        <?php if ($model->isNewRecord): ?>
        <?=$form->field($model, 'status_id')->hiddenInput()->label(false)?>
        <?php else: ?>
        <?php

$datastatus = ['await', 'approve', 'success', 'cancel'];
$status = yii\helpers\ArrayHelper::map(Category::find()
        ->where(['type_name' => 'booking_sttaus'])
        ->where(['in', 'code', $datastatus])
        ->all(),
    'code', 'title');

echo Yii::$app->user->can('driver') ? $form->field($model, 'status_id')->inline(true)->radioList($status)->label('สถานะ') : '';
?>
        <?php endif;?>


        <div class="form-group">
            <?=Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
            <?=html::a('<i class="fa-solid fa-xmark"></i> ยกเลิกการ', ['/vehicle/booking'], ['class' => 'btn btn-danger']);?>
        </div>

        <?php ActiveForm::end();?>
    </div>
    <div class="col-12">

        <div class="card border-0 mt-3" style="width:100%;">
            <div class="card-body">
                <?php if (Yii::$app->user->can('driver') && !$model->isNewRecord): ?>

                <?php
echo $form->field($model, 'driver_id', [
    'inputTemplate' => '<div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa-regular fa-id-card"></i>&nbsp;</span>
    </div>
    {input}
    </div>',
])->widget(Select2::classname(), [
    'options' => ['placeholder' => 'เลือกพนักงานบับรถ ...'],
    'data' => $model->driversMap(),
    'disabled' => $disable,
    'pluginEvents' => [
        "select2:select" => "function() {
            getDriverPhoto($(this).val())
         }",
    ],
])->label('พนักงานขับรถ');
?>

                <?php
$mileage_last = $model->mileageLast();
?>
                <?=$form->field($model, 'data_json[mileage_start]', [

    'inputTemplate' => '<div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-gauge-high"></i>&nbsp;</span>
                                </div>
                                {input}
                                </div>',

])->textInput(['value' => $mileage_last])->label('เลขไมค์ก่อนออกเดินทาง')?>

                <?php // print_r($car->data_json['car_regis']);?>


                <?=$form->field($model, 'data_json[mileage_end]', [

    'inputTemplate' => '<div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-gauge-high"></i>&nbsp;</span>
                                </div>
                                {input}
                                </div>',

])->textInput()->label('เลขไมค์หลังเสร็จสินภาระกิจ')?>


                <?php endif;?>
            </div>
        </div>


        <h5 class="card-title">Title</h5>
        <p class="card-text">Content</p>
    </div>
    <div class="card-footer">
        Footer
    </div>
  </div>

    </div>

</div>

<?php
$urlDriverPhoto = Url::to('/bookingcar/booking/get-driver-photo');
$js = <<< JS


$("#form-line").submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
            console.log(data);
            // return false;
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
                // if (response.data.success == true) {
                //     alert("Wow you commented");
                // }
                console.log(response);
            })
            .fail(function() {
                console.log("error");
            });
        
        });
function getDriverPhoto(id) {
    $('#driver-photo').attr("src", "/file?id="+id).show();
    // $.ajax({
    //     type: "get",
    //     url: "$urlDriverPhoto",
    //     data:id,
    //     dataType: "json",
    //     success: function (response) {
    //         console.log(response)
    //         // $('.driver-profile').html(response)
    //         // $('.card-driver').attr("src", "/file/43");
    //         $('#driver-photo').attr("src", "/file?id="+id);
    //         // console.log(a)
    //     }
    // });
}
JS;

$this->registerJs($js, View::POS_END);
?>