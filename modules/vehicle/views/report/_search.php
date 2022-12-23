<?php

use yii\helpers\Html;
// use yii\bootstrap5\ActiveForm;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\CategorySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'id' => 'formSearch',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php
    echo $form->field($model, 'q_date')->widget(DateRangePicker::classname(), [
        'language' => 'th',
        'useWithAddon'=>true,
        // 'pluginOptions' => [
            'presetDropdown' => true,
            'convertFormat' => false,
            'language' => 'th',
            'initRangeExpr' => true,
            'pluginOptions' => [
                'separator' => ' - ',
                'format' => 'YYYY-MM-DD',
                'locale' => [
                    'format' => 'YYYY-MM-DD',
                ],
                'ranges' => [
                    Yii::t('kvdrp', "วันนี้") => ["moment().startOf('day')", "moment()"],
                    Yii::t('kvdrp', "เมื่อวานนี้") => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                    Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 7]) => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                    Yii::t('kvdrp', "ย้อนหลัง {n} วัน", ['n' => 30]) => ["moment().startOf('day').subtract(29, 'days')", "moment()"],
                    Yii::t('kvdrp', "เดือนนี้") => ["moment().startOf('month')", "moment().endOf('month')"],
                    Yii::t('kvdrp', "เดือนที่แล้ว") => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],
                ],
            ],
            'pluginEvents' => [
                //"apply.daterangepicker" => "function() { apply_filter('q_date') }",
                "apply.daterangepicker" => "function() { $('#formSearch').submit() }",
                // 'cancel.daterangepicker'=>"function(ev, picker) {\$('#daterangeinput').val(''); // clear any inputs};"
                'cancel.daterangepicker' => "function() { console.log('clear') }",
            ],
        // ]
    ])->label(false);
    ?>

    <?php ActiveForm::end(); ?>

</div>
