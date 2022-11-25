<?php
use yii\helpers\Url;
use yii\web\View;
/** @var yii\web\View $this */
?>
<span id="profilex">xx</span>
<span>
    <?php
    
    ?>
</span>

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
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php echo $this->render('car_items', [
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>

<?php // if(Yii::$app->user->isGuest):?>
<?php
$lineAuth = Url::to(['/usermanager/line/line-auth']);
$js = <<< JS

    async function main() {
        await liff.init({ liffId: "1657676585-KD78xz40" })
        if (liff.isInClient()) {
            // getUserProfile()
        } else {
        if (liff.isLoggedIn()) {
          const profile = await liff.getProfile();
        //   await getUser();
        //   alert(profile)
          console.log(profile)
          // getUserProfile()
          $('#profilex').text(JSON.stringify(profile));
        //   getUser()
        } else {
        console.log('no');
        logIn()

        }
      }
    }

 main()
   



JS;
$this->registerJs($js,View::POS_END)


?>
<?php // endif; ?>