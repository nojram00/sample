<?php
    require 'records.php';
    require 'addrecords.php';

class recordsManager{
    // use Records;

    private static $password;
    private static $endpoint;
    public static function start($password, $endpoint){
        self::$password = $password;
        self::$endpoint = $endpoint;
        return new self();
    }

    public function records($start = null, $end = null){
        $id = -1;
        return new Records(self::$password, $id, $start, $end, self::$endpoint);
    }
    public function newRecords(){
        echo 'listen: '.self::$endpoint;
        return new AddRecords(self::$endpoint, self::$password);
    }

    private $emp_id;

    public function addPerson($id, $name, $allowFingerPrint){
        $endpoint = '/person/create';
        $data = array(
            'id' => $id,
            'person' => $name,
            'fingerPermission' => $allowFingerPrint,
        );

        $data_encoded = json_encode($data);
        $encoded = urldecode($data_encoded);
        $params = array(
            'pass' => self::$password,
            'person' => $encoded,
        );

        $q = http_build_query($params);

        $url = self::$endpoint.$endpoint.'?'.$q;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        // $response = json_decode($data);
        // return $response;

        $this->emp_id = $id;
        return $this;
    }

    public function addFingerprint(){
        $url = '/face/fingerRegist';
        $params = array(
            'pass' => self::$password,
            'personId' => $this->emp_id
        );
    }

}

