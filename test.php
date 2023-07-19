<?php
    // require('personels.php');
    require 'recordsManager.php';

    // $pass = '12345';
    // $id = '-1';
    // $newresponse = new Personels($pass, $id);

    // date_default_timezone_set('Asia/Manila');
    // $now = date('Y-m-d h:m:s A', time());

    // $pass = new DateTime($now);
    // $interval = new DateInterval('P0Y1M0DT0H0M0S');
    // $past_thirty = $pass->sub($interval);
    // echo 'Today is: ' .$now.'</br>';
    // echo 'Pass 30 days: ' .$past_thirty->format('Y-m-d h:m:s A');

    // echo '<pre>';
    // $data = $newresponse->response;

    // // $newresponse->Test();
    // if($data !== null){
    //     foreach($data as $d){
    //         echo '<h3>'.$d['name'].'</h3></br>';
    //         echo '<h3>'.$d['id'].'</h3></br>';
    //     }
    // }else{
    //     echo "hello world";
    // }

    // echo 'Name: '. $newresponse->GetNameByID('017').'</br>';
    // echo 'ID: ' .$newresponse->GetIdByName('Marjon').'</br>';
    // echo 'Password: ' . $newresponse->GetPasswordByID('017').'</br>';
    // echo 'Time Created: ' . $newresponse->GetCreateTimeByID('017');

    $name = 'Johnny';
    $id = '099';
    $password = '12345';
    $host = 'http://192.168.0.115:8090';

    $res = recordsManager::start($password,$host)
                        ->addPerson($id,$name,'2');

    // $res = recordsManager::start($password, $host)
    //             ->newRecords()
    //             ->addPerson($id,$name,$password)
    //             ->execute();

    echo '<pre>';
    var_dump($res);
