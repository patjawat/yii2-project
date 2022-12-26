<?php
use yii\web\View;
use app\modules\vehicle\AppAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
$this->title = 'ระบบจองรถ';
?>
<div class="row justify-content-md-center mt-5">
<div class="col-8">

<div class="container" style="margin-top:10px;">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php echo $this->render('car_items', [
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>

</div>
</div>
</div>



<?php
$viewUrl = Url::to(['/vehicle/booking/view-ajax']);
$js = <<< JS

function BookingView(id){
    $.ajax({
        type: "get",
        url: "$viewUrl",
        data: {
            id:id
        },
        beforeSend: function(){
            beforLoadModal()
        },
        dataType: "json",
        success: function (response) {
            $('#main-modal').modal('show');
            $('#main-modal-label').html(response.title);
            $('.modal-body').html(response.content);
            $('.modal-footer').html(response.footer);
            $(".modal-dialog").removeClass('modal-sm');
            $(".modal-dialog").addClass('modal-lg');
            $('.modal-content').addClass('card-outline card-primary');
        }
    });
}

JS;
$this->registerJs($js,View::POS_END)
?>