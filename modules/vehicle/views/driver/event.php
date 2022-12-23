<?php
use yii\helpers\Url;
use yii\web\JsExpression;

echo \edofre\fullcalendar\Fullcalendar::widget([
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
    'events' => Url::to(['/vehicle/driver/events', 'id' => $id]),
]);
?>