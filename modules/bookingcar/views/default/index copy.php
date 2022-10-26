<?php
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\datecontrol\DateControl;
?>
<div class="row">
<div class="col-12"> 
   <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
</div>

<div class="row">
<div class="col-6">
<?php
        echo $this->render('bookinglist', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
?>
</div>
<div class="col-6">

<?= \edofre\fullcalendar\Fullcalendar::widget([
        'options'       => [
            'id'       => 'calendar',
            'language' => 'th'
        ],
        'clientOptions' => [
          'theme'=> false,
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'month',
            'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),

        ],
        'events'        => Url::to(['/bookingcar/default/events', 'id' => '1111']),
    ]);
?>
  
  </div>
</div>