<?php
use yii\helpers\Url;
use yii\web\View;
?>
<div class="row justify-content-md-center mt-5">
    <h1 class="text-center"><i class="fa-solid fa-user-check"></i> <span class="text-success">ลงทะเบียนสำเร็จ</span>
    </h1>
    <img id="pictureUrl" width="25%">
    <p id="userId"></p>
    <p id="displayName"></p>
    <p id="statusMessage"></p>
    <p id="getDecodedIDToken"></p>
    <div class="d-grid gap-2 col-12 mx-auto">
        <span id="closeLiff" class="btn btn-success">ตกลงxx</span>
    </div>
</div>

<?php
$checkMe = Url::to(['/usermanager/line/checkme']);

$js = <<< JS


function runApp() {
      liff.getProfile().then(profile => {
        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          success: function (response) {
            // console.log(response.register);
            if(response.register == true){
              liff.closeWindow();
              console.log('register tttt');
            }
            // window.location.href
          }
        });

      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657676585-eQJA1a3Y" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));




   $('#closeLiff').click(function (e) { 
liff.closeWindow();
    });



JS;
$this->registerJs($js,View::POS_END)
?>