<?php
    require 'recordsManager.php';

    $endpoint = 'http://192.168.0.115:8090';
    $password = '12345';
    if(isset($_POST['name']) && isset($_POST['id'])){
        $name = $_POST['name'];
        $id = $_POST['id'];
        recordsManager::start($password, $endpoint)
                    ->addPerson($id, $name)
                    ->addFingerprint();


        set_time_limit(10);
        header('Location: createEmployee.php');
    }
