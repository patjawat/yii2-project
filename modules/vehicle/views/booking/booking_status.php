<?php
use yii\helpers\Html;


switch ($model->status_id) {
    case 'await':
        $status = [
            'color' => 'warning',
            'icon' => '<i class="fa-solid fa-hourglass-start"></i>',
        ];
        break;
    case 'approve':
        $status = [
            'color' => 'primary',
            'icon' => '<i class="fa-solid fa-check"></i>',
        ];
        break;
    case 'success':
        $status = [
            'color' => 'success',
            'icon' => '<i class="fa-solid fa-check"></i>',
        ];
        break;
    case 'cancel':
        $status = [
            'color' => 'danger',
            'icon' => '<i class="fa-solid fa-xmark"></i>',
        ];
        break;

    default:
    $status = [
        'color' => '',
        'icon' => '',
    ];
        break;
}


?>

<span class="btn btn-sm btn-<?=$status['color'];?>"><?=$status['icon'].' '.$model->status->title?></span>
<?php // Html::a($status['icon'].' '.$model->status->title,['/'],['class' => 'btn btn-sm btn-'.$status['color'].' position-relative'])?>