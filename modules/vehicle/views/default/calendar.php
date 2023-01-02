<?php
use yii\helpers\Url;
use yii\web\JsExpression;
?>
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