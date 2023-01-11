<?php
use yii\web\View;
use app\modules\vehicle\AppAsset;
use yii\helpers\Url;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
$site = app\components\SiteHelper::Info();
// $this->title = $site['site_name'];

?>

<div class="container">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <?php echo $this->render('car_items', [
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <br>
          <?=$this->render('calendar');?>
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