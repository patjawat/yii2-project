<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = 'สร้างประเภทรถ';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทรถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
