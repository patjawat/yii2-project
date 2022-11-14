<?php
use yii\helpers\Html;
?>
<div>

<?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แสดง', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-warning',
        ]) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i> ยกเลิก', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
        ]) ?>
</div>