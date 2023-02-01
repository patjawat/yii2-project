<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Json;
$this->title = 'พนักงานขับรถ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss($this->render('style.css'));
echo count($models);
?>


<div class="container">
    <div class="row pt-5 m-auto">
        <?php $delay = 200;?>
        <?php foreach ($models as $model):?>

        <div class="col-md-3 col-lg-3 pb-3">
            <!-- Copy the content below until next comment -->
            <div class="card card-custom bg-white border-white border-0" data-aos="fade-up" data-aos-delay="<?=$delay++?>">
                <!-- <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"> -->
                <div class="card-custom-img"
                    style="background-image: url(https://bkpho.moph.go.th/bungkanpho/uploads/media/2018111510192411_SSJBK_2018_2.jpg);filter: brightness(91%);">
                </div>
                <div class="card-custom-avatar">
                    <?php if($model['photo']):?>
                    <?=Html::img(['/file', 'id' => $model['photo'],['class' =>'img-fluid']])?>
                    <?php else:?>
                    <?=$model['picture_url'] ? Html::img($model['picture_url'],['class' =>'img-fluid']) : Html::img('@web/images/user1.jpg',['class' =>'img-fluid']);?>

                    <?php endif;?>

                </div>
                <div class="card-body" style="overflow-y: auto">
                    <h4 class="card-title"><?=$model['fullname']?></h4>
                    <p class="card-text">
                        <?=$model['phone'] != '' ? '<i class="fa-solid fa-phone"></i> '.$model['phone'] : '-' ?>

                </div>
                <div class="card-footer" style="background: inherit; border-color: inherit;">


                    <?=Html::a('<i class="fa-solid fa-calendar-days"></i> ปฎิทิน', ['/vehicle/driver/job','id' => $model['id']],['class' => ' btn btn-primary a-modal'])?>
                    <!-- <span class="btn btn-primary view_calendar"><i class="fa-solid fa-calendar-days"></i> ปฎิทิน</span> -->
                    <?php $link = Json::decode($model['data_json']); ?>
                    <?php // if (isset($link) && isset($link['link'])):?>
                    <?php // Html::a('<i class="fa-regular fa-star"></i> แบบประเมิน',$link['link'],['class' =>'btn btn-outline-warning','target' => '_blank'])?>
                    <?php // else:?>
                    <!-- <a href="#" class="btn btn-outline-secondary"><i class="fa-regular fa-star"></i> แบบประเมิน</a> -->
                    <?php // endif;?>
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