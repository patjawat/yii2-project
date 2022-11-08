<?php
use app\models\Provinces;
use app\modules\bookingcar\models\Category;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */
/** @var yii\widgets\ActiveForm $form */

$car_id = isset($car_id) ? $car_id : $model->car_id;
$car = Category::findOne($car_id);

?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 300px;
}
</style>

<div class="row">
    <div class="col-8">
        <?php $form = ActiveForm::begin();?>

        <?=$form->field($model, 'ref')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'status_id')->hiddenInput()->label(false)?>
        <div class="alert alert-primary" role="alert">ข้อมูลการเดินทาง</div>

        <div class="row justify-content-between">
            <div class="col-4">
                <?=$form->field($model, 'start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
    'language' => 'th',
    'readonly' => true,
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันเวลาที่ออกเดินทาง');
?>
            </div>
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
    ]
    
])->textInput()->label('วัตถุประสงค์การจอง')?>

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
      'required' => true,
    ]
])->textInput()->label('จุดหมายปลายทาง')?>
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
    'options' => ['placeholder' => 'เลือกจังหวัด ...'],
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
    'options' => ['id' => 'subcat1-id', 'placeholder' => 'เลือก ...'],
    'pluginOptions' => [
        'depends' => [Html::getInputId($model, 'province_id')],
        'placeholder' => 'เลือกอำเภอ',
        'url' => Url::to(['district-list']),
    ],
])?>
            </div>
        </div>

        <div class="alert alert-primary" role="alert">รายละเอียดการขอใช้</div>
        <div class="row">
            <div class="col-6">
                <?=$form->field($model, 'data_json[fullname]', [
    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-user-check"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                'inputOptions' =>
                [
                  'autofocus' => 'autofocus',
                  'tabindex' => '2',
                ]
])->textInput()->label('ชื่อผู้จอง')?>

            </div>
            <div class="col-6">
                <?=$form->field($model, 'data_json[phone]', [
    'inputTemplate' => '<div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-mobile-screen"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                'inputOptions' =>
                [
                  'autofocus' => 'autofocus',
                  'tabindex' => '3',
                ]
])->textInput()->label('เบอร์โทรศัพท์ติดต่อ')?>
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
                  'tabindex' => '4',
                ]
])->textInput(['type' => 'number'])->label('จำนวนผู้โดยสาร')?>
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
    'options' => ['placeholder' => 'เลือกรถ ...'],
    'data' => ArrayHelper::map(Category::find()->where(['type_name' => 'car'])->all(), 'id', function ($model) {
        return $model->data_json['band'] .' ทะเบียน '.$model->data_json['car_regis'];
    }),
]);?>

            </div>
        </div>



        <div class="row">
            <div class="col-4">
                <?=$form->field($model, 'end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันเวลาที่วันกลับ');
?>
            </div>
            <div class="col-8">

                <?=$form->field($model, 'data_json[pick_up_point]', [
    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-location-pin"></i>&nbsp;</span>
                                        </div>
                                        {input}
                                        </div>',
])->textInput()->label('จุดรับกลับ')?>

            </div>
        </div>

        <div class="form-group">
            <?=Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
            <?=html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก',['/bookingcar'],['class' => 'btn btn-danger']);?>
        </div>

        <?php ActiveForm::end();?>
    </div>
    <div class="col-4">

        <div class="card border-0 mt-3" style="width:100%;">
            <?=Html::img(['/file', 'id' => $car_id, ['class' => 'card-img-top']])?>
            <div class="card-body">

                <table class="table table-light">
                    <tbody>
                        <tr>
                            <td>เลขทะเบียน</td>
                            <td><?php print_r($car->data_json['car_regis']);?></td>
                        </tr>
                        <tr>
                            <td>ยี่ห้อ</td>
                            <td><?php print_r($car->data_json['band']);?></td>
                        </tr>
                        <tr>
                            <td>รุ่น</td>
                            <td><?php print_r($car->data_json['model']);?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>