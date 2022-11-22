<?php
use app\modules\vehicle\models\Booking;
use yii\helpers\Json;
 if ($searchModel->q_date) { // ค้นตามวันเวลาที่ระบบ
    $date_explode = explode(" - ", $searchModel->q_date);
    $date1 = trim($date_explode[0]);
    $date2 = trim($date_explode[1]);

}else{
    $date1 =  date("Y-m-d");
    $date2 =  date("Y-m-d");
}

$bookings = Booking::find()
->joinWith('car')
->where(['between','start',$date1,$date2])
->andWhere(['car_id' => $model->id,'status_id' => 'success'])
->all();

$sum = 0;
?>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th width="300">วันที่ไป</th>
            <th width="300">วันที่กลับ</th>
            <th>ภาระกิจ</th>
            <th>รวมระยะทาง(กิโลเมตร)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking): ?>
        <tr>
            <td>
              
                <p><?=$booking->start?> เลขไมล์ : <?=isset($booking->data_json['mileage_end']) ? $booking->data_json['mileage_start'] : '-'?></p>

            </td>
            <td>
            <p><?=$booking->end?> เลขไมล์ : <?=isset($booking->data_json['mileage_end']) ? $booking->data_json['mileage_end'] : '-'?></p>
            </td>
            <td><?=$booking['title'];?></td>
            <td><?=$booking->MileageRang()?></td>
        </tr>
        <?php
        $sum+=(int)$booking->MileageRang()
        ?>

<?php  endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
           
            <th colspan="3">รวมระยะทาง</th>
            <th><?=number_format($sum);?></th>
        </tr>
    </tfoot>
</table>