<?php
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
            <div class="card">
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
        'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),
            'eventClick' => "function(calEvent, jsEvent, view) {
                $(this).css('border-color', 'red');
                $.get('index.php?r=event/update',{'id':calEvent.id}, function(data){
                    $('.modal').modal('show')
                    .find('#modelContent')
                    .html(data);
                })
                $('#calendar').fullCalendar('removeEvents', function (calEvent) {
                    return true;
                });
           }",

    ],
    'events' => Url::to(['/vehicle/default/events', 'id' => '1111']),
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


