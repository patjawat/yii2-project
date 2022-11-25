<?php
use yii\web\View;
use app\modules\vehicle\AppAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
?>
<div class="container">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">

        <div class="col-6">
            <br>
            <div class="card border-0">
                <div class="card-body">
                   
        
            <?=\edofre\fullcalendar\Fullcalendar::widget([
    'options' => [
        'id' => 'calendar',
        'language' => 'th',
    ],
    'clientOptions' => [
        'theme' => false,
        'weekNumbers' => true,
        'selectable' => true,
        'defaultView' => 'month',
        'eventClick' => new JsExpression("
        function(event, delta, revertFunc, jsEvent, ui, view) {
            $(this).css('border-color', 'red');
            BookingView(event.id);
        }
        "),
        'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),
        
    ],
    'events' => Url::to(['/vehicle/booking/events', 'id' => '']),
    
]);
?>
        </div>

        
            </div>
            <!-- end Card -->
        </div>

        <div class="col-6">
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