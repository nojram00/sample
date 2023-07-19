<?php
class Records{

    private $response;
    private $records = [];

    /**
     * @param string $pass Password
     *
     * @param string $id Person id
     *
     * -Query personnel recognition records of designated id.
     *
     * -Pass in -1 to query recognition records of all personnel, including strangers.
     *
     * -Pass in STRANGERBABY to query all records of strangers/failed recognition.
     *
     * -Pass in IDCARD to query records of all face&card comparison.
     *
     * @param string $startTime Start time of records
     *
     * -If not querying via time, please pass in 0 respectively
     *
     * -If querying via time, please follow the format (Year-Month-Day Hour:Minute:Second) Example: 2017-07-15 12:05:00.
     *
     * @param string $endTime End time of records
     *
     * -If not querying via time, please pass in 0 respectively
     *
     * -If querying via time, please follow the format (Year-Month-Day Hour:Minute:Second) Example: 2017-07-15 12:05:00.
     */
    public function __construct($pass, $id, $startTime = null, $endTime = null, $endpoint = null)
    {
        if($startTime == null){
            $startTime = '0';
        }
        if($endTime == null){
            $endTime = '0';
        }
        if($endpoint == null){
            $endpoint = 'http://192.168.0.115:8090/newFindRecords';
        }
        else{
            $endpoint = $endpoint.'/newFindRecords';
        }
        // echo $endpoint;
        //endpoint may be changed based on device ip and port:
        $params = [
            'pass' => $pass,
            'personID' => $id,
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
        $query = http_build_query($params);
        $url = $endpoint.'?'.$query;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        $res = json_decode($data, true);

        // var_dump($res);
        if(isset($res['data'])){
            $this->response = $res['data']['records'];
        }
    }

    /**
     * For testing purposes
     */
    public function Test(){
        echo '<pre>';
        var_dump($this->response);
    }


    /**
     * @return array Get all records data.
     */
    public function GetResponse(){
        return $this->response;
    }

    public function GetRecordsByID($id){
        foreach($this->response as $r){
            if($r['personId'] == $id){
                array_push($this->records, $r);
            }
        }
        return $this;
    }

    public function GetRecordsByName($name){
        foreach($this->response as $r){
            if($r['name'] == $name){
                array_push($this->records, $r);
            }
        }
        return $this;
    }

    /**
     * @return array Get all attendance records based on input ID/Name.
     */
    public function GetAll(){
        if(!empty($this->records))
        {
            return $this->records;
        }
        else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }


    /**
     * @return array Get all Attendance status based on input ID/Name.
     */
    public function AttendanceStatus(){
        $attendanceStatus = [];
        if(!empty($this->records)){
            foreach($this->records as $a)
            {
                array_push($attendanceStatus, $a['attendance']['attendanceStatus']);
            }
            return $attendanceStatus;
        }else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }

    /**
     * @return array Returns all Time Out data.
     */
    public function GetTimeOut(){
        if(!empty($this->records)){
            $timeOut = [];
            foreach($this->records as $a){
                if($a['attendance']['attendanceStatus'] == 'Time Out'){
                    array_push($timeOut, $a);
                }
            }
            return $timeOut;
        }
        else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }

    /**
     * @return array Returns all Time In data.
     */
    public function GetTimeIn(){
        if(!empty($this->records)){
            $timeIn = [];
            foreach($this->records as $a){
                if($a['attendance']['attendanceStatus'] == 'Time In'){
                    array_push($timeIn, $a);
                }
            }
            return $timeIn;
        }
        else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }

    /**
     * @return array Returns all Start of Overtime data.
     */
    public function GetStartOT(){
        if(!empty($this->records)){
            $startOT = [];
            foreach($this->records as $a){
                if($a['attendance']['attendanceStatus'] == 'Start the OT'){
                    array_push($startOT, $a);
                }
            }
            return $startOT;
        }
        else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }


    /**
     * @return array Returns all End of Overtime data.
     */
    public function GetEndOt(){
        if(!empty($this->records)){
            $endOT = [];
            foreach($this->records as $a){
                if($a['attendance']['attendanceStatus'] == 'End the OT'){
                    array_push($endOT, $a);
                }
            }
            return $endOT;
        }
        else
        {
            throw new Exception('ERROR: no records found. Make sure you get records using GetRecordsByID() or GetRecordsByName()');
            return;
        }
    }
}
