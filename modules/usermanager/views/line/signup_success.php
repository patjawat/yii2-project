<?php
use yii\helpers\Url;
use yii\web\View;
?>

<style>

/* loading animation */

      
.dbl-spinner {
    position: absolute;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: transparent;
    border: 4px solid transparent;
    border-top: 4px solid #2220;
    border-left: 4px solid #2220;
    -webkit-animation: 2s spin linear infinite;
    animation: 2s spin linear infinite;
  }
                                      
  .dbl-spinner:nth-child(2) {
    border: 4px solid transparent;
    border-right: 4px solid #37d8a8;
    border-bottom: 4px solid #20c997;
    -webkit-animation: 1s spin linear infinite;
    animation: 1s spin linear infinite;
  }
  
  @-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
  }
          
  @keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
  }
  
</style>
<div class="row justify-content-md-center mt-5">
    <h1 class="text-center"><i class="fa-solid fa-user-check"></i> <span class="text-success" id="msg">ลงทะเบียนสำเร็จ</span>
    </h1>
    <div class="row d-flex justify-content-center">
    <img id="pictureUrl" class="rounded-circle shadow-lg p-2 bg-white rounded" style="width:30%">
</div>
    <p id="userId"></p>
    <p id="displayName"></p>
    <p id="statusMessage"></p>
    <p id="getDecodedIDToken"></p>
    <div class="d-grid gap-2 col-12 mx-auto">
        <span id="closeLiff" class="btn btn-success">ตกลง</span>
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
            $('#msg').text(response.msg);
            console.log(response.msg)
            // console.log(response.register);
            if(response.register == true){
              liff.closeWindow();
            }
            // window.location.href
          }
        });

      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657676585-NZL4yEPB" }, () => {
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