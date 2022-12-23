<?php
use yii\helpers\Html;
?>


<style>
body {
    background-color: #f7f6f6
}

.card {

    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px;
}


.dots {

    height: 4px;
    width: 4px;
    margin-bottom: 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}

.badge {

    padding: 7px;
    padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef;
}

.user-img {

    margin-top: 4px;
}

.check-icon {

    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px;
}

.form-check-input {
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer;
}


.form-check-input:focus {
    box-shadow: none;
}


.icons i {

    margin-left: 8px;
}

.reply {

    margin-left: 12px;
}

.reply small {

    color: #b7b4b4;

}


.reply small:hover {

    color: green;
    cursor: pointer;

}

.box-img{
        position: relative;
        /* width:500px; */
    }
    .box-img > img{
        width:80px;
    }
</style>

<div class="container mt-5">
    <div class="row  d-flex justify-content-center">
        <div class="col-md-8">
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5>Unread comments(6)</h5>
                <div class="buttons">
                    <span class="badge bg-white d-flex flex-row align-items-center">
                        <span class="text-primary">Comments "ON"</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        </div>
                    </span>
                </div>
            </div>
            <?php foreach ($querys as $model): ?>
            <div class="card p-3 mt-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user d-flex flex-row align-items-center">
                    <div class="box-img" data-aos="fade-left">
            <?=Html::img(['/file', 'id' => $model['id']], ['class' => 'user-img rounded-circle mr-2'])?>
        </div>
                        <span><small class="font-weight-bold text-primary">simona_rnasi</small> <small
                                class="font-weight-bold text-primary">@macky_lones</small> <small
                                class="font-weight-bold text-primary">@rashida_jones</small> <small
                                class="font-weight-bold">Thanks </small></span>
                    </div>
                    <small>3 days ago</small>
                </div>
                <div class="action d-flex justify-content-between mt-2 align-items-center">
                    <div class="reply px-4">
                        <small>Remove</small>
                        <span class="dots"></span>
                        <small>Reply</small>
                        <span class="dots"></span>
                        <small>Translate</small>
                    </div>
                    <div class="icons align-items-center">
                        <i class="fa fa-check-circle-o check-icon text-primary"></i>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>