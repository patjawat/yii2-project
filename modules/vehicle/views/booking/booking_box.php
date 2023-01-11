<?php
use app\components\BookingHelper;
$status = BookingHelper::CountByStatus();
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
    background-color: #fffbec;
    width: 60px;
    height: 25px;
    padding-bottom: 3px;
    border-radius: 5px;
    display: flex;
    color: #fed85d;
    justify-content: center;
    align-items: center
}

.progress {
    height: 10px;
    border-radius: 10px
}

.progress div {
    background-color: red
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
                            <h6 class="mb-0">ทั้งหมด</h6> <span>1 days ago</span>
                        </div>
                    </div>
                    <div class="badge"> <span>Design</span> </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
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
                            <h6 class="mb-0">ขอใช้รถ</h6> <span>1 days ago</span>
                        </div>
                    </div>
                    <div class="badge"> <span>Design</span> </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
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
                            <h6 class="mb-0">อนุมัติ</h6> <span>1 days ago</span>
                        </div>
                    </div>
                    <div class="badge"> <span>Design</span> </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
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
                            <h6 class="mb-0">เสร็จสิ้น</h6> <span>1 days ago</span>
                        </div>
                    </div>
                    <div class="badge"> <span>Design</span> </div>
                </div>
                <div class="mt-3">
                    <!-- <h3 class="heading">Senior Product<br>Designer-Singapore</h3> -->
                    <div class="mt-0">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
                    </div>
                </div>
            </div>
        <!-- </a> -->
        </div>

       
        <?php //endfor;?>
        
    </div>
</div>