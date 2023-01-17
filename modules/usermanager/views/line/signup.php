<?php
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
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
</style>

<div class="row justify-content-center mt-5" id="warp-content">
    <h1>
        <?php
  // if(Yii::$app->user->isGuest){
  //   echo 'No Login';
  // }else{
  //   echo 'Login';
  // }
  ?>
        <?php // $dataProvider->getTotalCount();?></h1>
    <div class="col-10">
        <?php if(isset($searchModel->phone) && $dataProvider->getTotalCount() == 0): ?>
        <?php $form = ActiveForm::begin([
                'id' => 'form-usermanager',
                
            ]); ?>

        <div class="row d-flex justify-content-center">
            <img id="pictureUrl" class="rounded-circle shadow-lg p-2 bg-white rounded" style="width:30%">
            <h1 class="text-center" id="displayName"></h1>
        </div>

        <?= $form->field($model, 'username')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'password')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'confirm_password')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'fullname')->hiddenInput(['maxlength' => true,'id' => 'fullname'])->label(false) ?>
        <?= $form->field($model, 'email')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'phone')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'line_id')->hiddenInput(['maxlength' => true,'id' => 'line_id'])->label(false); ?>
        <?= $form->field($model, 'picture_url')->hiddenInput(['maxlength' => true,'id' => 'picture_url'])->label(false); ?>
        <div class="box-img text-center img-thumbnail">
            <?php //  Html::img(['/file','id'=>$model->id]) ?>
            <?php //  $form->field($model,'file')->fileInput(); ?>
        </div>

        <br>
        <div class="d-grid gap-2 col-12 mx-auto mb-5">
            <?= Html::submitButton('<i class="fa-solid fa-check"></i> ยืนยันลงทะเบียน', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>



    </div>
</div>

<?php elseif($dataProvider->getTotalCount() == 1 && !Yii::$app->user->isGuest):?>

<?php echo $this->render('signup_success');?>
<?php else:?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<?php endif; ?>

<?php // if($dataProvider->getTotalCount() == 0): ?>
<?php
// $urlProfile = Url::to(['/usermanager/line/checkme']);
$checkMe = Url::to(['/usermanager/line/checkme']);
$js = <<< JS

$('#loading').show();
$('#warp-content').hide();
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
$this->registerJs($js,View::POS_END)
?>