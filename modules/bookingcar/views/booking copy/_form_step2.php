<?php
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Provinces;

?>
<div class="alert alert-primary" role="alert"><i class="fa-solid fa-map-location-dot"></i>
                        จุดหมายปลายทาง</div>
                    <div class="row">
                        <div class="col-6">
                            <?php
                            echo $form->field($model, 'province_id')->widget(Select2::classname(), [
                                'options' => ['placeholder' => 'เลือกจังหวัด ...'],
                                'data' => ArrayHelper::map(Provinces::find()->all(), 'id', 'name_th'),
                            ]);
                            ?>
                       
                        </div>
                        <div class="col-6">
                            <?=$form->field($model, 'district_id')->widget(DepDrop::className(), [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'subcat1-id', 'placeholder' => 'เลือก ...'],
                                'pluginOptions' => [
                                    'depends' => [Html::getInputId($model, 'province_id')],
                                    'placeholder' => 'เลือกอำเภอ',
                                    'url' => Url::to(['district-list'])
                                ]
                            ])?>
                        </div>
                    </div>

                    <div class="alert alert-primary" role="alert"><i class="fa-solid fa-map-location-dot"></i>จำนวนผู้โดยสารและผู้ติดต่อ</div>
                            <div class="row">
                                <div class="col-3">
                                    <?=$form->field($model, 'data_json[person_count]')->textInput()->label('จำนวนผู้โดยสาร')?>
                                </div>
                                <div class="col-3">
                                    <?=$form->field($model, 'data_json[contact_name]')->textInput()->label('ชื่อผู้ร่วมเดินทาง ที่สามารถติดต่อได้')?>
                                </div>
                                <div class="col-3">
                                    <?=$form->field($model, 'data_json[contact_phone]')->textInput()->label('หมายเลขโทรศัพท์มือถือ')?>
                                </div>
                            </div>

                    <?=$form->field($model, 'data_json[location_point]')->textInput(['maxlength' => true])->label('จุดหมายปลายทาง')?>