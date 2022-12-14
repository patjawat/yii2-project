<?php
use yii\helpers\Html;
?>
<div>
    <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แสดง', ['view', 'id' => $model->id], ['class' => 'btn btn-primary',[
    'data' => ['pjax' => false]
    ]]) ?>
    <?php if($model->created_by == Yii::$app->user->identity->id):?>
    <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data-pjax' => false
        ]) ?>
        <?php else: ?>
            <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], [
            'class' => 'btn btn-secondary dis_edit',
            'data-pjax' => false
        ]) ?>
        <?php endif; ?>

        <?php if($model->status_id == 'success' || $model->status_id == 'cancel' || $model->created_by != Yii::$app->user->identity->id):?>
            <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-secondary dis_cancel',
        ]) ?>
            <?php else :?>
    <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-danger',
        ]) ?>
        <?php endif;?>

</div>