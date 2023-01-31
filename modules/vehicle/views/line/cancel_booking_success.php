<h1 class="text-center mt-5">ยกเลิกกสำเร็จ</h1>
<?php
$js = <<< JS



const myTimeout = setTimeout(myGreeting, 2000);
function myGreeting() {
    liff.closeWindow();
}
JS;
$this->registerJS($js);
?>