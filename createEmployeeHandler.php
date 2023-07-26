<?php

require 'recordsManager.php';
if (isset($_GET['id']) && isset($_GET['type'])) {
    echo 'this is passed to a javascript function';
    $id = $_GET['id'];
    $type = $_GET['type'];
    if($type == 'fingerprint'){
        $res = fingerPrint($id);
        echo json_encode($res);
    }
    if($type == 'face'){
        $res = face($id);
        echo json_encode($res);
    }

}
function fingerPrint($id){
    $endpoint = 'http://192.168.1.59:8090';
    $password = '12345';
    $res = recordsManager::start($password,$endpoint)
                ->updateFingerprint($id);
    $response = array(
        'message' => 'success',
        'id' => $id
    );
    // return 'fuck!';
    return $res;
}
function face($id){
    $endpoint = 'http://192.168.1.59:8090';
    $password = '12345';
    $res = recordsManager::start($password, $endpoint)
        ->addFace($id);
    return $res;
}