<?php
use app\models\Provinces;
use app\modules\vehicle\models\Category;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Json;
use app\modules\vehicle\AppAsset;
use kartik\datecontrol\DateControl;
$myAssetBundle = AppAsset::register($this);

// 'value' => $model->isNewRecord ? Yii::$app->user->identity->username : ''  
$car_id = isset($car_id) ? Category::findOne($car_id)->photo : $model->car->photo;
// $car = $model->isNewRecord ? Category::findOne($car_id) : $model->car->photo;

// $disable = $model->isNewRecord ? false : (Yii::$app->user->can('driver') ? true : false); // (Yii::$app->user->can('driver') ? true : false) || ($model->isNewRecord ? false : true);
$disable = false;
?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 300px;
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

.nav-tabs .nav-link.active,
.nav-tabs .nav-item.show .nav-link {
    color: #198754 !important;
}

.nav-tabs .nav-link {
    color: #6c757d !important;
}
</style>



<?php
$fullname = Yii::$app->user->identity->fullname;
$user_json = Json::decode(Yii::$app->user->identity->data_json);
$position = isset($user_json['position_name']) ? $user_json['position_name'] : null;
?>
<?php $form = ActiveForm::begin(['id' => 'form-booking']);?>
<div class="row">
    <div class="col-8">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i
                        class="fa-regular fa-pen-to-square"></i> ส่วนที่ 1 ข้อมูลการจอง</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i
                        class="fa-regular fa-pen-to-square"></i> ส่วนที่ 2 ข้อมูลการเบิกค่าเดินทาง</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">



                <div class="card border-0 border-radius-lg">
                    <div class="card-body">

                        <?=$form->field($model, 'ref')->hiddenInput(['maxlength' => true])->label(false)?>
                        <?=$form->field($model, 'booking_type')->hiddenInput(['value' => 'vehicle'])->label(false)?>

                        <!-- <div class="alert alert-primary" role="alert">ข้อมูลการเดินทาง</div> -->

                        <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">ข้อมูลผู้จอง</h4>

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <span>ผู้จอง : <code><?=$fullname;?></code></span>
                                    </div>
                                    <div class="col">
                                        <span>ตำแหน่ง : <code><?=$position;?></code></span>

                                    </div>
                                    <div class="col">
                                        <span>โทรศัพท์ : <code><?=Yii::$app->user->identity->phone;?></code></span>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row justify-content-between">

                            <div class="col-8">

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

            ])->textInput(['disabled' =>$disable])->label('วัตถุประสงค์การจอง')?>

                            </div>
                            <div class="col-4">
                                <?=$form->field($model, 'start')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
                    'language' => 'th',
                    'readonly' => true,
                    'disabled' =>$disable,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ],
                ])->label('วันเวลาที่ออกเดินทาง');
                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <?=$form->field($model, 'data_json[point]', [
                'inputTemplate' => '<div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i>&nbsp;</span>
                            </div>
                            {input}
                            </div>',
                'inputOptions' =>
                [
                    'tabindex' => '2',
                    'required' => true,
                ],
            ])->textInput(['disabled' =>$disable])->label('จุดหมายปลายทาง')?>
                            </div>
                            <div class="col-4">
                                <?php
                    echo $form->field($model, 'province_id', [
                        'inputTemplate' => '<div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-building-circle-check"></i>&nbsp;</span>
                        </div>
                        {input}
                        </div>',
                    ])->widget(Select2::classname(), [
                        'options' => ['placeholder' => 'เลือกจังหวัด ...','tabindex' => '2'],
                        'disabled' =>$disable,
                        'data' => ArrayHelper::map(Provinces::find()->all(), 'id', 'name_th'),
                    ]);
                    ?>

                            </div>
                            <div class="col-4">
                                <?=$form->field($model, 'district_id', [
    'inputTemplate' => '<div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa-solid fa-building-circle-check"></i>&nbsp;</span>
    </div>
    {input}
    </div>',
])->widget(DepDrop::className(), [
    'type' => DepDrop::TYPE_SELECT2,
    'options' => ['id' => 'subcat1-id', 'placeholder' => 'เลือก ...','tabindex' => '3',],
    'disabled' =>$disable,
    'pluginOptions' => [
        'depends' => [Html::getInputId($model, 'province_id')],
        'placeholder' => 'เลือกอำเภอ',
        'url' => Url::to(['district-list']),
    ],
])?>
                            </div>
                        </div>

                       

                        <div class="row">
                            <div class="col-4">
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
        'tabindex' => 8,
    ],
])->textInput(['type' => 'number','disabled' =>$disable])->label('จำนวนผู้โดยสาร')?>
                            </div>
                            <div class="col-8">
                                <?=$form->field($model, 'car_id', [
    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-car"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
])->widget(Select2::classname(), [
    'options' => [
        'placeholder' => 'เลือกรถ ...',
        // 'options' => [
        //     8 => ['disabled' => true],
        //     4 => ['disabled' => true],
        // ]
    ],
    'disabled' =>$disable,
    'data' => $model->carsMap(),
]);?>

                            </div>
                        </div>



                        <div class="row">

                            <div class="col-8">

                                <?=$form->field($model, 'data_json[pick_up_point]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-location-pin"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable,'tabindex' => 10])->label('จุดรับกลับ')?>

                            </div>
                            <div class="col-4">
                                <?=$form->field($model, 'end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...','tabindex' => 9],
    'language' => 'th',
    'disabled' =>$disable,
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันเวลาที่วันกลับ');
?>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <?=$form->field($model, 'data_json[fullname]')->hiddenInput(['disabled' =>$disable,($model->isNewRecord ? ['value' => $position] : (isset($model->data_json['fullname']) ? $model->data_json['fullname'] : ''))])->label(false)?>

                                <?=$form->field($model, 'data_json[position_name]')->hiddenInput(['disabled' =>$disable,'value' => $model->isNewRecord ? $position : (isset($model->data_json['position_name']) ? $model->data_json['position_name'] : '' ) ])->label(false)?>

                            </div>
                            <div class="col-6">
                                <?=$form->field($model, 'data_json[phone]')->hiddenInput(['disabled' =>$disable,'value' => $model->isNewRecord ? Yii::$app->user->identity->phone : (isset($model->data_json['phone']) ? $model->data_json['phone'] : '' ) ])->label(false)?>

                                <?=$form->field($model, 'data_json[group_name]')->hiddenInput(['disabled' =>$disable])->label(false)?>


                            </div>
                        </div>


                        

                        <?php if($model->isNewRecord):?>

                        <?php // $form->field($model, 'status_id')->hiddenInput()->label(false)?>
                        <?php else:?>
                        <?php

$datastatus = ['await','approve','success','cancel'];
                $status = yii\helpers\ArrayHelper::map(Category::find()
                ->where(['type_name' => 'booking_sttaus'])
                ->where(['in', 'code',$datastatus])
                ->all(), 
                'code','title');

// echo Yii::$app->user->can('driver') ? $form->field($model, 'status_id')->inline(true)->radioList($status)->label('สถานะ') : '';
?>
                        <?php endif;?>



                        <div class="body-footer">

                            <div class="form-group">
                                <?=Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
                                <?=html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก', ['/vehicle/booking'], ['class' => 'btn btn-default']);?>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- emd body -->

            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <?=$form->field($model, 'data_json[doc_number]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-regular fa-folder-open"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable])->label('ตามคำสั่ง/บันทึกที่')?>
                            </div>
                            <div class="col-6">
                                <?php
                                
                                echo $form->field($model, 'data_json[doc_number_date]')->widget(DateControl::classname(), [
                                    'type'=>DateControl::FORMAT_DATE,
                                    'options' => ['placeholder' => 'เลือกลงวันที่ ...'],
    'language' => 'th',
    'disabled' =>$disable,
    'pluginOptions' => [
        'autoclose' => true,
    ],
                                ]);

                                 ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <?=$form->field($model, 'data_json[member]')->textArea(['disabled' =>$disable,'rows'=> 6,'placeholder' =>'นายตัวอย่าง นามสกุลทดสอบ1 นายตัวอย่าง นามสกุลทดสอบ2 นายตัวอย่าง นามสกุลทดสอบ3'])->label('พร้อมด้วย')?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">

                                <?=$form->field($model, 'data_json[travel_allowance]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable])->label('ค่าเบี้ยเลี้ยงเดินทาง')?>

                                <?=$form->field($model, 'data_json[rent]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable])->label('ค่าเช่าที่พักประเภท')?>


                            </div>
                            <div class="col-6">


                                <?=$form->field($model, 'data_json[vehicle_cost]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable])->label('ค่าพาหนะ')?>


                                <?=$form->field($model, 'data_json[other_cost]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput(['disabled' =>$disable])->label('ค่าใช้จ่ายอื่น')?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- end tabs -->


    </div>
    <!-- end col-8 -->
    <div class="col-4">

        <div class="card border-0" style="width:100%;margin-top: 37px;">
            <?=Html::img(['/file', 'id' => $car_id, ['class' => 'card-img-top']])?>
            <div class="card-body">

                <?php
           $mileage_last = $model->mileageLast();
         
           ?>

            </div>
        </div>

    </div>

</div>
<!-- end Row -->
<?php ActiveForm::end();?>
<?php
$urlDriverPhoto = Url::to('/bookingcar/booking/get-driver-photo');
$js = <<< JS

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