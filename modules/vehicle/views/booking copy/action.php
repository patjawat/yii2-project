<?php
use yii\helpers\Html;
?>


<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <!-- <button type="button" class="btn btn-primary">1</button>
  <button type="button" class="btn btn-primary">2</button> -->

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Dropdown
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
    </ul>
  </div>
</div>