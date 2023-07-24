<?php
    require ('records.php');

    $password = '12345';
    $id = '-1';
    $now = date('Y-m-d H:m:s', time());

    function GetOneDayAhead($targetTime){
        $t = new DateTime($targetTime);
        $interval = new DateInterval('P0Y0M1DT0H0M0S');
        $p = $t->add($interval);
        $r = $p->format('Y-m-d H:i:s');
        return $r;
    }

    function GetPastThirtyDays($targetTime){
        $t = new DateTime($targetTime);
        $interval = new DateInterval('P0Y1M0DT0H0M0S');
        $p = $t->sub($interval);
        $r = $p->format('Y-m-d H:i:s');
        return $r;
    }

    $startTime = GetPastThirtyDays($now);
    $endTime = GetOneDayAhead($now);

    $records = new Records($password, $id, '0', '0');

    // $records->Test();
    // $data = $records->GetResponse();
    // foreach($data as $d){
    //     echo $d['name'].'<br>';
    // }
    // echo '<h1>wews</h1>';

    echo '<pre>';
    // var_dump($data);
    // var_dump($data);

    var_dump($records->GetRecordsByID('034')->GetAll());

    // var_dump($records->GetRecordsByID('999')->AttendanceStatus());
    // var_dump($records->GetRecordsByID('017')->GetAll());
    // var_dump($records->GetRecordsByID('013')->GetTimeOut());
    // var_dump($records->GetRecordsByID('017')->GetTimeIn());

    // $timeOut = $records->GetRecordsByID('')->GetTimeOut();
    // $timeIn = $records->GetRecordsByID('013')->GetTimeIn();

    // foreach($timeOut as $t){
    //     echo '<b>Time Out: '.date('Y-m-d h:m:s A', $t['time']/1000).'</br>';
    // }

    // foreach($timeIn as $t){
    //     echo '<b>Time In: '.date('Y-m-d h:m:s A', $t['time']/1000).'</br>';
    // }

    // var_dump($records->GetTimeOut());
    // $endTime = date('Y-m-d H:m:s', );
    // $endTime = '2023-07-12 07:00:00 AM';
