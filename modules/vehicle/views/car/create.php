<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = 'เพิ่มรถ';
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
