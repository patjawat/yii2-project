<?php
use yii\helpers\Html;
?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 100px;
}
p{
    margin-bottom:0px;
}
</style>

<ul></ul>
<p>
    ทะเบียน <?=$model->car->data_json['car_regis']?>
</p>


<?php //  isset($model->car) ? Html::img(['/file', 'id' => $model->car->photo,['class' =>'bd-placeholder-img']]) : ''?>

