<?php
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = 'พนักงานขับรถ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss($this->render('style.css'));
?>


<div class="container">
    <div class="row pt-5 m-auto">
        <?php foreach ($dataProvider->getModels() as $model):?>
        <div class="col-md-3 col-lg-3 pb-3">

            <!-- Copy the content below until next comment -->
            <div class="card card-custom bg-white border-white border-0">
                <!-- <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"> -->
                <div class="card-custom-img" style="background-image: url(<?=Url::to(['/file', 'id' => $model->photo])?>);">
                </div>
                <div class="card-custom-avatar">
     
                        <?php // Html::img(['/file', 'id' => $model->photo,['class' =>'img-fluid']])?>
                        <?=Html::img('@web/images/moph_logo.png',['class' =>'img-fluid'])?>
                        
                </div>
                <div class="card-body" style="overflow-y: auto">
                    <h4 class="card-title"><?=$model->data_json['room_name']?></h4>
                    <p class="card-text">
                        ขนาด <?=$model->data_json['size']?> คน
                    <?php // $model['phone'] != '' ? '<i class="fa-solid fa-phone"></i> '.$model['phone'] : '-' ?>
                     </p>
                </div>
                <div class="card-footer" style="background: inherit; border-color: inherit;">
                <?=Html::a('<i class="fa-solid fa-calendar-days"></i> ปฎิทิน', ['/vehicle/driver/job','id' => $model->id],['class' => ' btn btn-primary a-modal'])?>
                    <!-- <span class="btn btn-primary view_calendar"><i class="fa-solid fa-calendar-days"></i> ปฎิทิน</span> -->
                    <a href="#" class="btn btn-outline-warning"><i class="fa-regular fa-star"></i> แบบประเมิน</a>
                </div>
            </div>
            <!-- Copy until here -->

        </div>
       <?php endforeach; ?>

    </div>
</div>


<?php
$js = <<< JS

// $('.view_calendar').click(function (e) { 
//     console.log(e.target)
//     // e.preventDefault();
//     beforLoadModal();
    
// });
JS;
$this->registerJs($js,View::POS_END)
?>