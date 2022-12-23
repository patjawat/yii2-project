<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = 'แก้ไข: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="category-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
