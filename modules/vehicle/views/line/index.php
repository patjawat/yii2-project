<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/** @var yii\web\View $this */
?>

<style>
  .form-control {
    font-family: 'Prompt';
    display: block;
    height: 50px;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1.5rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>

<?php echo $searchModel->end == '' ?  $this->render('_search', ['model' => $searchModel]) : ''; ?>

<?php echo $searchModel->end  == '' ?  '' : $this->render('car_items', [
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>


<?php // if(Yii::$app->user->isGuest):?>
<?php
// $lineAuth = Url::to(['/usermanager/line/line-auth']);
$checkMe = Url::to(['/usermanager/line/checkme']);
$js = <<< JS




$('#awaitLogin').show();
$('#content-container').hide();
function runApp() {
      liff.getProfile().then(profile => {
        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          success: function (response) {
            console.log(response);
            if(response.register == false){
              liff.closeWindow();
            }else{
              $('#awaitLogin').hide();
              $('#content-container').show();
            }
            // window.location.href
          }
        });

      }).catch(err => console.error(err));
    }


    liff.init({ liffId: "1657676585-KD78xz40" }, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));


    $("#form-search").submit(function () {
          $('#loading').show();
            $('#warp-content').hide();
            $('#awaitLogin').show();
    $('#content-container').hide();

            });

$('.select-car').click(function () {
  $('#loading').show();
    $('#warp-content').hide();
    $('#awaitLogin').show();
$('#content-container').hide();
})

    $('#logout').click(function (e) { 
      console.log('logged out');
      liff.logout();
      liff.closeWindow();
      // window.location.reload();
      
    });




JS;
$this->registerJs($js,View::POS_END)


?>
<?php // endif; ?>