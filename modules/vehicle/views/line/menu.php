<?php
use yii\helpers\Html;
$this->title = 'เมนูอื่นๆ';
?>


<div class="row row-cols-1 row-cols-sm-2 g-4">

    <div class="col-6">
        <div class="card text-center border-0 shadow-md mb-3 bg-body-tertiary rounded">

            <div class="card-body">
                <h5 class="card-title">QR-Code</h5>
                <p class="card-text">Line OA </p>
                <?=Html::a('<i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...',['/vehicle/line/qrcode'],['class' => 'btn btn-primary']);?>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card text-center border-0 shadow-md mb-3 bg-body-tertiary rounded">
            <div class="card-body">
                <h5 class="card-title">QR-Code</h5>
                <p class="card-text">Line OA </p>
                <?=Html::a('<i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...',['/vehicle/line/qrcode'],['class' => 'btn btn-primary']);?>
            </div>
        </div>
    </div>

</div>