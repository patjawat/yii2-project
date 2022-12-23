<?php
use yii\helpers\Html;
?>
<div>
    <?php echo Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-warning',
        ]) ?>
       
</div>