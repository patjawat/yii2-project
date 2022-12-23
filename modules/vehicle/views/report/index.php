<?php
/** @var yii\web\View $this */
use app\modules\vehicle\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
?>

<?php Pjax::begin(); ?>
<div class="row justify-content-between">
    <div class="col-4">
        <h1>ราบงานกรใช้รถ</h1>
    </div>
    <div class="col-4">
        <?=$this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<?php foreach ($dataProvider->getModels() as $model):?>
หมายเลขทะเบียน : <code><?=$model->data_json['car_regis']?></code>
<?=$this->render('booking_list',[
    'model' => $model,
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);?>
<?php endforeach;?>

<?php Pjax::end(); ?>

<!-- <iframe width="100%" height="1000" src="https://datastudio.google.com/embed/reporting/6fcd94ce-c82f-4881-b23a-b961637b1b3b/page/hzj6C" frameborder="0" style="border:0" allowfullscreen></iframe> -->