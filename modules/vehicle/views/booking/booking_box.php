<?php
use yii\helpers\Html;
use app\components\BookingHelper;
use app\components\DateTimeHelper;
$status = BookingHelper::CountByStatus();
$queryAwait = Yii::$app->db->createCommand("SELECT status_id,updated_at FROM `booking` WHERE status_id = 'await' ORDER by updated_at DESC")->queryOne();
$querySuccess = Yii::$app->db->createCommand("SELECT status_id,updated_at FROM `booking` WHERE status_id = 'success' ORDER by updated_at DESC")->queryOne();
$querysApprove = Yii::$app->db->createCommand("SELECT status_id,updated_at FROM `booking` WHERE status_id = 'approve' ORDER by updated_at DESC")->queryOne();
$querysTotal = Yii::$app->db->createCommand("SELECT status_id,updated_at FROM `booking` ORDER by updated_at DESC")->queryOne();

$dateTotal =  $querysTotal ? DateTimeHelper::Duration($querysTotal['updated_at'],date("Y-m-d H:i:s"))['medium'] : '-';
$dateAwaitAgo =  $queryAwait ? DateTimeHelper::Duration($queryAwait['updated_at'],date("Y-m-d H:i:s"))['medium'] : '-';
$dateSuccessAgo =  $querySuccess ? DateTimeHelper::Duration($querySuccess['updated_at'],date("Y-m-d H:i:s"))['medium'] : '-';
$dateApproveAgo =  $querysApprove ? DateTimeHelper::Duration($querysApprove['updated_at'],date("Y-m-d H:i:s"))['medium'] : '-';


?>
<style>
    body {
    background-color: #eee
}

.card {
    border: none;
    border-radius: 10px
}

.c-details span {
    font-weight: 300;
    font-size: 13px
}

.icon {
    width: 50px;
    height: 50px;
    background-color: #eee;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 39px
}

.badge span {
    background-color: #efe1ac;
    width: 60px;
    height: 25px;
    padding-bottom: 3px;
    border-radius: 5px;
    display: flex;
    color: #fed85d;
    justify-content: center;
    align-items: center;
}

.badge span > a{
    color: #117073;
    text-decoration: unset;
}

.progress {
    height: 10px;
    border-radius: 10px
}

.progress div {
    /* background-color: red */
    background: -webkit-linear-gradient(90deg, hsla(198, 65%, 34%, 1) 0%, hsla(178, 44%, 32%, 1) 100%);

}

.text1 {
    font-size: 14px;
    font-weight: 600
}

.text2 {
    color: #a5aec0
}
</style>
<div class="container mt-5 mb-3">
    <div class="row">
<?php //for ($x = 0; $x <= 3; $x++):?>
   
        <div class="col-md-3">
        <!-- <a href=""> -->
            <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <i class="bx bxl-mailchimp"></i> <?=$status['all']?></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">ทั้งหมด</h6> ล่าสุด <span><?=$dateTotal;?></span>
                        </div>
                    </div>
                    <div class="badge"> 
                    <span>
                            <?=Html::a('เลือก',['/vehicle/booking']);?>
                        </span>   
                     </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div> -->
                    </div>
                </div>
            </div>
        <!-- </a> -->
        </div>



        <div class="col-md-3">
        <!-- <a href=""> -->
            <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <i class="bx bxl-mailchimp"></i> <?=$status['await']?></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">ขอใช้รถ</h6> <span>ล่าสุด <span><?=$dateAwaitAgo?></span>
                        </div>
                    </div>
                    <div class="badge"> 
                    <span>
                            <?=Html::a('เลือก',['/vehicle/booking','status'=> 'await']);?>
                        </span>        
                </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div> -->
                    </div>
                </div>
            </div>
        <!-- </a> -->
        </div>


        <div class="col-md-3">
        <!-- <a href=""> -->
            <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <i class="bx bxl-mailchimp"></i> <?=$status['approve']?></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">อนุมัติ</h6> <span>ล่าสุด <?=$dateApproveAgo?></span>
                        </div>
                    </div>
                    <div class="badge"> 
                    <span>
                            <?=Html::a('เลือก',['/vehicle/booking','status'=> 'approve']);?>
                        </span>   </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div> -->
                    </div>
                </div>
            </div>
        <!-- </a> -->
        </div>



        <div class="col-md-3">
        <!-- <a href=""> -->
            <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <i class="bx bxl-mailchimp"></i> <?=$status['success']?></div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0">เสร็จสิ้น</h6>ล่าสุด <span><?=$dateSuccessAgo?></span>
                        </div>
                    </div>
                    <div class="badge">
                    <span>
                            <?=Html::a('เลือก',['/vehicle/booking','status'=> 'success']);?>
                        </span>        
                </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div> -->
                    </div>
                </div>
            </div>
        <!-- </a> -->
        </div>

       
        <?php //endfor;?>
        
    </div>
</div>