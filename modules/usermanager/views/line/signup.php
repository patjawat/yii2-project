<?php
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
$this->title = 'ระบบลงทะเบียน';
?>

<div class="row justify-content-center mt-3">

    <div class="col-10">
        <?php if(isset($searchModel->phone) && $dataProvider->getTotalCount() == 0): ?>
            <?php $form = ActiveForm::begin([
                'id' => 'form-usermanager',
                
            ]); ?>

<div class="row d-flex justify-content-center">
    <img id="pictureUrl" class="rounded-circle shadow-lg p-2 bg-white rounded" style="width:30%">
</div>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'line_id')->hiddenInput(['maxlength' => true,'id' => 'line_id'])->label(false); ?>
            <div class="box-img text-center img-thumbnail">
                <?= Html::img(['/file','id'=>$model->id]) ?>
                <?= $form->field($model,'file')->fileInput(); ?>
            </div>

            <br>
            <div class="d-grid gap-2 col-12 mx-auto mb-5">

            <?= Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>

            <?= Html::a('<i class="fas fa-redo"></i> ยกเลิก', ['/usermanager/user'], ['class' => 'btn btn-secondary link-loading', 'title' =>  'Reset Grid']) ?>
        </div>
            <?php ActiveForm::end(); ?>

            <?php else:?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

 <?php endif; ?>

    </div>
</div>

<?php // if($dataProvider->getTotalCount() == 0): ?>
<?php
// $urlProfile = Url::to(['/usermanager/line/checkme']);
$checkMe = Url::to(['/usermanager/line/checkme']);
$js = <<< JS
function runApp() {
      liff.getProfile().then(profile => {
        // document.getElementById("pictureUrl").src = profile.pictureUrl;
        $('#line_id').val(profile.userId)

        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          success: function (response) {
            console.log(response);
            if(response == true){
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
<?php//  endif;?>