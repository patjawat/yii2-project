<?php
use yii\helpers\Html;
?>
<div>

    <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แสดง', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
    <?php Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-warning',
            'data-pjax' => false
        ]) ?>
        <?php if($model->status_id == 'approve'):?>
            <?= Html::a('<i class="fa-solid fa-ban"></i> การจองยกเลิก', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-secondary dis_cancel',
        ]) ?>
            <?php else :?>
    <?= Html::a('<i class="fa-solid fa-ban"></i> การจองยกเลิก', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
        ]) ?>
        <?php endif;?>
</div>