<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = 'แก้ไข: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->data_json['band'], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
