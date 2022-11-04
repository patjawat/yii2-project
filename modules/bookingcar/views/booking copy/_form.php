<?php

use kartik\widgets\DateTimePicker;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

use app\modules\bookingcar\AppAsset;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
$this->registerCssFile($AssetBundle->baseUrl.'/css/step-style.css')
?>


<style>
    .demo{
        background-color:red;
    }
</style>
<section class="pt-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center py-6">
                <h1 class="mb-4 fs-9 fw-bold">The Design Thinking Superpowers</h1>
                <?=$this->render('stepview');?>
            </div>
            <div class="col-md-6 text-end">
                <?=Html::img($AssetBundle->baseUrl.'/images/logo31.png',['class' => 'pt-7 pt-md-0 img-fluid']);?>
               
            </div>
        </div>
    </div>
</section>

<div class="container">

    <?php $form = ActiveForm::begin([
        // 'layout' => 'horizontal'
        ]);?>

        <div id="multi-step-form-container" style="margin-top: -90px;">
            <!-- Form Steps / Progress Bar -->
                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    <!-- <h2 class="font-normal">Account Basic Details</h2> -->
                    <!-- Step 1 input fields -->
                    <div class="mt-3">
                        <!-- Step 1 input fields goes here.. -->
                        <div class="alert alert-primary" role="alert">แผนการเดินทางเลือกยานพาหนะ</div>
                        <?=$this->render('_form_step1',['form' => $form ,'model'=>$model])?>
                       
                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                    </div>
                </section>
                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <!-- <h2 class="font-normal">Social Profiles</h2> -->
                    <!-- Step 2 input fields -->
                    <?=$this->render('_form_step2',['form' => $form ,'model'=>$model])?>

                   
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                    </div>
                </section>
                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <h2 class="font-normal">Personal Details</h2>
                    <!-- Step 3 input fields -->
                    <div class="alert alert-primary" role="alert"><i class="fa-solid fa-map-location-dot"></i>
                        ภาระกิจ</div>

                    <?=$form->field($model, 'title')->textarea(['rows' => 6])?>

                    <?=$form->field($model, 'description')->textarea(['rows' => 6])?>

                    <?=$form->field($model, 'stopover')->textarea(['rows' => 6])?>

                    <?=$form->field($model, 'cost_type')->textInput()?>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="4">Next</button>
                    </div>
                    <!-- <div class="mt-3">
                    <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                    <button class="button submit-btn" type="submit">Save</button>
                </div> -->
                </section>

                <section id="step-4" class="form-step d-none">
                    <!-- Step 4 input fields -->

                    <div class="alert alert-primary" role="alert"><i class="fa-solid fa-map-location-dot"></i>
                        ผู้รับรองและผู้ยื่นคำขอ
                    </div>
                    <?=$form->field($model, 'person_name')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'certifier_name')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'certifier_position')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'author_id')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'author_position')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'date_end')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'time_end')->textInput(['maxlength' => true])?>

                    <?=$form->field($model, 'receive')->textInput()?>

                    <?=$form->field($model, 'driver')->textarea(['rows' => 6])?>

                    <?=$form->field($model, 'car_id')->textarea(['rows' => 6])?>

                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                        <!-- <button class="button btn-navigate-form-step" type="button" step_number="4">Next</button> -->
                        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
                    </div>
                    <!-- <div class="mt-3">
                    <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                    <button class="button submit-btn" type="submit">Save</button>
                </div> -->
                </section>
          
        </div>
        <?=$form->field($model, 'passengers_number')->textInput()?>

    <?php ActiveForm::end();?>
    
    </div>







<?php
$js = <<< JS


const navigateToFormStep = (stepNumber) => {
    /**
     * Hide all form steps.
     */
    document.querySelectorAll(".form-step").forEach((formStepElement) => {
        formStepElement.classList.add("d-none");
    });
    /**
     * Mark all form steps as unfinished.
     */
    document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
        formStepHeader.classList.add("form-stepper-unfinished");
        formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
    });
    /**
     * Show the current form step (as passed to the function).
     */
    document.querySelector("#step-" + stepNumber).classList.remove("d-none");
    /**
     * Select the form step circle (progress bar).
     */
    const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
    /**
     * Mark the current form step as active.
     */
    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
    formStepCircle.classList.add("form-stepper-active");
    /**
     * Loop through each form step circles.
     * This loop will continue up to the current step number.
     * Example: If the current step is 3,
     * then the loop will perform operations for step 1 and 2.
     */
    for (let index = 0; index < stepNumber; index++) {
        /**
         * Select the form step circle (progress bar).
         */
        const formStepCircle = document.querySelector('li[step="' + index + '"]');
        /**
         * Check if the element exist. If yes, then proceed.
         */
        if (formStepCircle) {
            /**
             * Mark the form step as completed.
             */
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
            formStepCircle.classList.add("form-stepper-completed");
        }
    }
};
/**
 * Select all form navigation buttons, and loop through them.
 */
document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
    /**
     * Add a click event listener to the button.
     */
    formNavigationBtn.addEventListener("click", () => {
        /**
         * Get the value of the step.
         */
        const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
        /**
         * Call the function to navigate to the target form step.
         */
        navigateToFormStep(stepNumber);
    });
});


JS;
$this->registerJs($js, View::POS_END);
?>