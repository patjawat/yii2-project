<?php
/** @var yii\web\View $this */
?>

<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<?php echo $this->render('car_items', [
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); ?>