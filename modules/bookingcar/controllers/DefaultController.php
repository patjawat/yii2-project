<?php

namespace app\modules\bookingcar\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\modules\bookingcar\models\Booking;
use app\modules\bookingcar\models\BookingSearch;

/**
 * Default controller for the `Bookingcar` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEvents($id, $start, $end)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            ["id" => "1", "resourceId" => "b", "start" => "2022-10-07T02:00:00", "end" => "2022-10-07T07:00:00", "title" => "สัมนา"],
            ["id" => "2", "resourceId" => "c", "start" => "2022-10-07T05:00:00", "end" => "2022-10-07T22:00:00", "title" => "ประชุมนอกรอบ"],
            ["id" => "3", "resourceId" => "d", "start" => "2022-10-20", "end" => "2022-10-24", "title" => "ออกค่ายภาษาอังกฤษ"],
            ["id" => "4", "resourceId" => "e", "start" => "2022-10-07T03:00:00", "end" => "2022-10-07T08:00:00", "title" => "event 4"],
            ["id" => "5", "resourceId" => "f", "start" => "2022-10-07T00:30:00", "end" => "2022-10-07T02:30:00", "title" => "event 5"],
        ];
    }

    public function actionResources($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            new Resource(["id" => "a", "title" => "Auditorium A"]),
            new Resource(["id" => "b", "title" => "Auditorium B", "eventColor" => "green"]),
            new Resource(["id" => "c", "title" => "Auditorium C", "eventColor" => "orange"]),
            new Resource([
                "id" => "d", "title" => "Auditorium D", "children" => [
                    new Resource(["id" => "d1", "title" => "Room D1"]),
                    new Resource(["id" => "d2", "title" => "Room D2"]),
                ],
            ]),
            new Resource(["id" => "e", "title" => "Auditorium E"]),
            new Resource(["id" => "f", "title" => "Auditorium F", "eventColor" => "red"]),
            new Resource(["id" => "g", "title" => "Auditorium G"]),
            new Resource(["id" => "h", "title" => "Auditorium H"]),
            new Resource(["id" => "i", "title" => "Auditorium I"]),
            new Resource(["id" => "j", "title" => "Auditorium J"]),
            new Resource(["id" => "k", "title" => "Auditorium K"]),
            new Resource(["id" => "l", "title" => "Auditorium L"]),
            new Resource(["id" => "m", "title" => "Auditorium M"]),
            new Resource(["id" => "n", "title" => "Auditorium N"]),
            new Resource(["id" => "o", "title" => "Auditorium O"]),
            new Resource(["id" => "p", "title" => "Auditorium P"]),
            new Resource(["id" => "q", "title" => "Auditorium Q"]),
            new Resource(["id" => "r", "title" => "Auditorium R"]),
            new Resource(["id" => "s", "title" => "Auditorium S"]),
            new Resource(["id" => "t", "title" => "Auditorium T"]),
            new Resource(["id" => "u", "title" => "Auditorium U"]),
            new Resource(["id" => "v", "title" => "Auditorium V"]),
            new Resource(["id" => "w", "title" => "Auditorium W"]),
            new Resource(["id" => "x", "title" => "Auditorium X"]),
            new Resource(["id" => "y", "title" => "Auditorium Y"]),
            new Resource(["id" => "z", "title" => "Auditorium Z"]),
        ];
    }
}
