<?php
    include ('records.php');

    $pass = $_POST['pass'];
    $id = $_POST['personID'];
    $start = $_POST['startTime'];
    $end = $_POST['endTime'];

    $sTime = new DateTime($start);
    $eTime = new DateTime($end);

    $s = $sTime->format('Y-m-d H:m:s');
    $e = $eTime->format('Y-m-d H:m:s');

    $records = new Records($pass, $id, $s, $e);

    // $records->Test();

    $data = $records->GetResponse();

    echo '<pre>';
    var_dump($data);

// <!-- echo $pass.'</br>';
//     echo $id.'</br>';
//     echo $sTime->format('Y-m-d H:m:s').'</br>';
//     echo $eTime->format('Y-m-d H:m:s').'</br>'; -->
