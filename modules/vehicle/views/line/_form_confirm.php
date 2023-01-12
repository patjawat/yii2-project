<?php
use dominus77\sweetalert2\assets\ThemeAsset;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);
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

// $user_json = Json::decode(Yii::$app->user->identity->data_json);
// $position = isset($user_json['position']) ? $user_json['position'] : null;
?>
<?php $form = ActiveForm::begin(['id' => 'form-success']);?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">บักทึกเสร็จสิ้นพาระกิจ</h5>
        <?php
echo $mileage_last = $model->mileageLast();

?>
        <?php if ($mileage_last == ''): ?>
        <?=$form->field($model, 'data_json[mileage_start]', [

    'inputTemplate' => '<div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-gauge-high"></i>&nbsp;</span>
                                </div>
                                {input}
                                </div>',

])->textInput(['value' => $mileage_last])->label('เลขไมค์ก่อนออกเดินทาง')?>

        <?php else: ?>

        <?=$form->field($model, 'data_json[mileage_start]')->hiddenInput(['value' => $mileage_last])->label('เลขไมค์หลังเสร็จสินภาระกิจ')->label(false)?>
        <?php endif;?>
        <label class="form-label" for="booking-data_json-mileage_start">เลขไมค์ก่อนออกเดินทาง</label>
        <div class="alert alert-success" role="alert">
            <h4><?=$mileage_last?></h4>
        </div>
        <div class="mb-3 field-booking-data_json-mileage_start">
            <div class="input-group">

                <!-- <input type="text" id="booking-data_json-mileage_start" class="form-control" name="Booking[data_json][mileage_start]" value="120000"> -->
            </div>

            <div class="invalid-feedback"></div>
        </div>

        <?=$form->field($model, 'data_json[mileage_end]', [

    'inputTemplate' => '<div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-gauge-high"></i>&nbsp;</span>
                            </div>
                            {input}
                            </div>',

])->textInput()->label('เลขไมค์หลังเสร็จสินภาระกิจ')?>


       



        <?=Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-primary'])?>
    </div>
</div>

<?php ActiveForm::end();?>
<?php
$urlDriverPhoto = Url::to('/bookingcar/booking/get-driver-photo');
$js = <<< JS


$("#form-success").submit(function(event) {
            event.preventDefault(); // stopping submitting
            var data = $(this).serializeArray();
            var url = $(this).attr('action');
            $('#awaitLogin').show();
            $('#content-container').hide();
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#awaitLogin').hide();
                        $('#content-container').show();
                    if (response == true) {
                       
                        liff.closeWindow();

                }
                }
            });


        });

JS;

$this->registerJs($js, View::POS_END);
?>