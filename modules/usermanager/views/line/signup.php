<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
$this->title = 'ระบบลงทะเบียน';
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

#user-role {
    display: flex;
    font-size: 30px;
    justify-content: center;
    font-weight: 500;
}

.form-container{
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  margin: 0 auto;

}

</style>

<div class="row justify-content-center mt-5" id="warp-content">
    <div class="col-10">
        <?php if (isset($searchModel->phone) && $dataProvider->getTotalCount() == 0): ?>
        <?php $form = ActiveForm::begin([
    'id' => 'form-usermanager',

]);?>

        <div class="row d-flex justify-content-center">
            <img id="pictureUrl" class="rounded-circle shadow-lg p-2 bg-white rounded" style="width:30%">
            <h1 class="text-center" id="displayName"></h1>
        </div>

<div class="form-container">

        <?=$form->field($model, 'role')->inline()->radioList(['user' => 'ผู้ใช้ทั่วไป', 'driver' => 'พขร'])->label(false)?>
        <?=$form->field($model, 'data_json[position_name]')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'username')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'password')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'confirm_password')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'fullname')->hiddenInput(['maxlength' => true, 'id' => 'fullname'])->label(false)?>
        <?=$form->field($model, 'email')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'phone')->hiddenInput(['maxlength' => true])->label(false)?>
        <?=$form->field($model, 'line_id')->hiddenInput(['maxlength' => true, 'id' => 'line_id'])->label(false);?>
        <?=$form->field($model, 'picture_url')->hiddenInput(['maxlength' => true, 'id' => 'picture_url'])->label(false);?>

        <br>
        <div class="d-grid gap-2 col-12 mx-auto mb-5" style="width: 80%;">
            <?=Html::submitButton('<i class="fa-solid fa-check"></i> ยืนยันลงทะเบียน', ['class' => 'btn btn-lg btn-success'])?>
        </div>

</div>
        <?php ActiveForm::end();?>



    </div>
</div>

<?php elseif ($dataProvider->getTotalCount() == 1 && !Yii::$app->user->isGuest): ?>

<?php echo $this->render('signup_success'); ?>
<?php else: ?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<?php endif;?>

<?php // if($dataProvider->getTotalCount() == 0): ?>
<?php
// $urlProfile = Url::to(['/usermanager/line/checkme']);
$checkMe = Url::to(['/usermanager/line/checkme']);
$js = <<< JS

$('#loading').show();
$('#warp-content').hide();

$("#form-search").submit(function () {
          $('#loading').show();
            $('#warp-content').hide();
            $('#awaitLogin').show();
    $('#content-container').hide();

            });

            $("#form-usermanager").submit(function () {
          $('#loading').show();
            $('#warp-content').hide();
            $('#awaitLogin').show();
    $('#content-container').hide();

            });

            
function runApp() {
      liff.getProfile().then(profile => {
        console.log(profile);
        $('#line_id').val(profile.userId)
        try {
        document.getElementById("pictureUrl").src = profile.pictureUrl;
        document.getElementById("displayName").innerHTML = profile.displayName;
        $("#picture_url").val(profile.pictureUrl);
        $("#fullname").val(profile.displayName);
      } catch (error) {

      }
        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          beforeSend: function(){
            $('#loading').show();
            $('#warp-content').hide();

            $('#awaitLogin').show();
    $('#content-container').hide();
          },
          success: function (response) {
            $('#loading').hide();
            $('#warp-content').show();
            $('#awaitLogin').hide();
            $('#content-container').show();
            $('#msg').text(response.msg);
            if(response.register == true){
              liff.closeWindow();
            }
          }
        });

      }).catch(err => console.error(err));
    }

    liff.init({ liffId: "1657676585-NZL4yEPB" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
        // getUser();
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


    $('#logout').click(function (e) {
      console.log('logged out');
      liff.logout();
      liff.closeWindow();
      // window.location.reload();

    });


JS;
$this->registerJs($js, View::POS_END)
?>