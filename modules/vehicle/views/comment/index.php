<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use yii\bootstrap5\ActiveForm;
use app\modules\vehicle\models\Booking;
use app\components\BookingHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);
$status = BookingHelper::CountByStatusDriver();


$this->title = 'รายการขอใช้ยานพาหนะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td>img {
    width: 100px;
}
</style>
<?php if($model):?>
<?php $form = ActiveForm::begin(['id' => 'form-booking']);?>
<?=$form->field($model, 'data_json[comment]')->textInput(['maxlength' => true])->label(false)?>


<?php ActiveForm::end();?>
<?php endif;?>

<?php 

$js = <<< JS


JS;
$this->registerJs($js,View::POS_END)
?>