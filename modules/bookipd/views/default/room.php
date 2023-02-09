<?php
$myAssetBundle = app\modules\bookipd\AppAsset::register($this);
?>

<div class="bg-light">


 <div class="text-center mb-5 mt-5">
              <h2 class="marker marker-center">ห้องพิเศษ</h2>
            </div>
            <div class="d-flex justify-content-center">

            
<div class=" container row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

  <?php for ($x = 0; $x <= 7; $x++):?>
    <div class="col mb-3">
          <div class="card shadow-lg">
          <img src="<?=$myAssetBundle->baseUrl.'/images/vip1.jpeg'?>" class="card-img-top" alt="...">

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-primary">แสดงรายละเอียด</button>
                  
                </div>
                <span class="badge rounded-pill bg-success">ว่าง</span>
              </div>
            </div>
          </div>
        </div>

    <?php endfor;?>
  </div>
  </div>
  </div>