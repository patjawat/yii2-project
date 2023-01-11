<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/** @var yii\web\View $this */
?>

<?php
if(Yii::$app->user->isGuest)
{
    echo 'No';
}else{
    // echo 'Yes';
    $user = Yii::$app->user;
    // print_r($user);
}

// print_r(Yii::$app->user)
?>
cccc
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php echo $this->render('car_items', [
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



function runApp() {
      liff.getProfile().then(profile => {
        $.ajax({
          type: "post",
          url: "$checkMe",
          data: {line_id:profile.userId},
          dataType: "json",
          success: function (response) {
            console.log(response);
            if(response == false){
              liff.closeWindow();
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