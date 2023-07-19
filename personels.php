<?php

class Personels{

    /**
     * @var array $response
     */
    public $response;

    /**
     *
     * @param string $pass Set the device password.
     * @param string $id Query person information of designated id.
     * Passing in -1 for id to query all personnel id
     *
     */
    public function __construct($pass, $id)
    {
        $endpoint = "http://192.168.0.115:8090/person/find";
        $params = [
            'pass' => $pass,
            'id' => $id,
        ];
        $query = http_build_query($params);
        $url = $endpoint.'?'.$query;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $res = json_decode($data, true);

        $this->response = $res['data'];
    }


    public function Test(){
        echo '<pre>';
        var_dump($this->response);
    }

    /**
     * Returns the name based on the id provided.
     * @param string $id Corresponding ID.
     * @return string Name.
     */

    public function GetNameByID($id){
        if($id == null) return;
        foreach($this->response as $r){
            if($id == $r['id']){
                return $r['name'];
            }
        }
    }

    /**
     * Returns the id based on the name provided.
     * @param string $name Name.
     * @return string ID.
     */
    public function GetIdByName($name){
        if($name == null) return;
        foreach($this->response as $r){
            if($name == $r['name']){
                return $r['id'];
            }
        }
    }

    /**
     * Returns the password based on the id provided.
     * @param string $id ID.
     * @return string Password.
     */
    public function GetPasswordByID($id){
        if($id == null) return;
        foreach($this->response as $r){
            if($id == $r['id']){
                return $r['password'];
            }
        }
    }

    /**
     * Returns the password based on the name provided.
     * @param string $name Name.
     * @return string Password.
     */
    public function GetPasswordByName($name){
        if($name == null) return;
        foreach($this->response as $r){
            if($name == $r['name']){
                return  $r['password'];
            }
        }
    }

    /**
     * Returns the Time created for the specified id in standard datetime format
     * @param string $id ID
     */
    public function GetCreateTimeByID($id){
        if ($id == null) return;
        foreach($this->response as $r){
            if($id == $r['id']){
                return date('Y-m-d h:m:s A', $r['createTime']/1000);
            }
        }
    }

    /**
     * Returns the Time created for the specified name in standard datetime format
     * @param string $name Name
     */
    public function GetCreateTimeByName($name){
        if($name == null) return;
        foreach($this->response as $r){
            if($name == $r['id']){
                return date('Y-m-d h:m:s A', $r['createTime']/1000);
            }
        }
    }
}
