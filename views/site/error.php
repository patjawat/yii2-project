<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container mt-5">
<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<div class="d-flex justify-content-center">
<?=Html::img('@web/images/error-404.jpg',['width' =>500])?>

</div>
