<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = 'แก้ไข: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'ห้องประชุม', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
