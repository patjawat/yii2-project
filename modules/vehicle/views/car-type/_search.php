<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\CategorySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'title',[
        'inputTemplate' => 
        '<div class="input-group">{input}'.Html::submitButton('<i class="fas fa-search"></i>', 
        ['class' => 'btn btn-primary']).'</div>',
    ])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
