<?php
    require 'records.php';
    try
    {
        $pdo = new Pdo('mysql:host=localhost;port=3306;dbname=sample','root');
    }
    catch(PDOException $e)
    {
        die($e);
    }

    $records = new Records('12345',
    '-1','0','0', endpoint:'http://192.168.1.59:8090');

    $data = $records->GetResponse();

    foreach($data as $d)
    {
        echo '<pre>';
        var_dump($d);
        date_default_timezone_set('Asia/Manila');
        $name = $d['name'];
        $id = $d['personId'];
        $attendance = $d['attendance'];
        if(array_key_exists('attendanceId', $attendance)){
            $at_id = $attendance['attendanceId'];
            datagetter::setID($at_id);
        }
        if(array_key_exists('attendanceStatus', $attendance)){
            $at_s = $attendance['attendanceStatus'];
            datagetter::setStatus($at_s);
        }

        $at_id = datagetter::getID();
        $at_s = datagetter::getStatus();
        $date = date('Y-m-d H:i:s', $d['time']/1000);
        $pdo->prepare("INSERT INTO `records_data` (`Name`, `person_id`, `attendance_id`, `attendance_status`, `time`) VALUES ('$name', '$id', '$at_id', '$at_s', '$date')")->execute();

    }

    class datagetter{
        private static $id;
        private static $status;
        public static function setID($id){
            self::$id = $id;
        }
        public static function getID(){
            return self::$id;
        }
        public static function setStatus($status){
            self::$status = $status;
        }
        public static function getStatus(){
            return self::$status;
        }
    }
