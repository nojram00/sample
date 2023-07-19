<?php

class AddRecords {

    private $url;
    private $devicepass;

    public function __construct($url, $devicepass)
    {
        $this->url = $url;
        $this->devicepass = $devicepass;
    }
    public function addfingerprint($id)
    {
        // echo $this->url;
        $endpoint = $this->url.'/face/fingerRegist';
        echo '<br>'.$endpoint;
        $pass = $this->devicepass;
        $params = [
            'pass' => $pass,
            'personId' => $id
        ];
        $query =  http_build_query($params);
        $url = $endpoint.'?'.$query;
        // echo $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $response = json_decode($data, true);

        var_dump($response);
        if(isset($response['data'])){
            return $response['data'];
        }else{
            return null;
        }
    }

    // public function addPerson($id, $name, $allowFingerPrint){
    //     return new personData(id:$id, name:$name, fingerpermission:$allowFingerPrint,devicepass:$this->devicepass, host:$this->url);
    // }
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
            'pass' => $this->devicepass,
            'person' => $encoded,
        );

        $q = http_build_query($params);

        $url = $this->url.$endpoint.'?'.$q;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        $response = json_decode($data);
        return $response;
    }
}

class personData{

    private $personData;
    private $devicepass;
    private $host;

    public function __construct(
        $id=null, $name, $idcardNum=false, $facepermission=false, $idcardpermission=false,
        $passwordpermission=false, $fingerpermission=false, $qrcodepermission=false,
        $faceandcardpermission=false, $cardandpasswordpermision=false, $faceandqrcodepermission=false,
        $tag=null, $qrCode=null, $password=null, $role=null, $scheduleId=null, $devicepass, $host
    )
    {

        if($facepermission){
            $facePermission = 2;
        }
        else{
            $facePermission = 1;
        }

        if($idcardpermission){
            $idCardPermission = 2;
        }else{
            $idCardPermission = 1;
        }

        if($passwordpermission){
            $passwordPermission = 2;
        }else{
            $passwordPermission = 1;
        }

        if($fingerpermission){
            $fingerPermission = 2;
        }else{
            $fingerPermission = 1;
        }

        if($qrcodepermission){
            $qrCodePermission = 2;
        }else{
            $qrCodePermission = 1;
        }

        if($faceandcardpermission){
            $faceAndCardPermission = 2;
        }
        else
        {
            $faceAndCardPermission = 1;
        }

        if($cardandpasswordpermision){
            $cardAndPasswordPermission = 2;
        }
        else {
            $cardAndPasswordPermission = 1;
        }

        if($faceandcardpermission){
            $faceAndCardPermission = 2;
        }
        else{
            $faceAndCardPermission = 1;
        }

        if($faceandqrcodepermission){
            $faceAndQrCodePermission = 2;
        }else {
            $faceAndQrCodePermission = 1;
        }

        $data = array(
            'id' => $id,
            'name' => $name,
            'idcardNum' => $idcardNum,
            'facePermission'=>$facePermission,
            'idCardPermission' => $idCardPermission,
            'passwordPermission' => $passwordPermission,
            'fingerPermission' => $fingerPermission,
            'qrCodePermission' => $qrCodePermission,
            'faceAndCardPermission' => $faceAndCardPermission,
            'cardAndPasswordPermission' => $cardAndPasswordPermission,
            'faceAndQrCodePermission' => $faceAndQrCodePermission,
            'tag'=> $tag,
            'qrCode' => $qrCode,
            'password'=> $password,
            'role'=>$role,
            'scheduleId'=>$scheduleId,
        );


        $this->personData = json_encode($data);

        $this->devicepass = $devicepass;
        $this->host = $host;
    }

    public function execute()
    {
        $url = $this->host.'/person/create';
        echo '<br>URL: ' . $url;
        $urlEncoded = urlencode($this->personData);
        $params = [
            'pass' => $this->devicepass,
            'person' => $urlEncoded,
        ];

        echo 'data: <pre>'. $urlEncoded;
        // echo '<pre>';
        // var_dump(json_decode($this->personData, true));
        $query = http_build_query($params);
        $endpoint = $url.'?'.$query;
        echo '<br>The endpoint: '.$endpoint;
        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        $response = json_decode($data);
        return $response;
    }
}
