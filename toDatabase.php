<?php
    require 'records.php';
    try
    {
        $pdo = new Pdo('mysql:host=localhost;port=8081;dbname=sample','root');
    }
    catch(PDOException $e)
    {
        die($e);
    }

    $records = new Records('12345',
    '-1','0','0');

    $data = $records->GetResponse();

    foreach($data as $d)
    {
        date_default_timezone_set('Asia/Manila');
        $name = $d['name'];
        $id = $d['personId'];
        $at_id = $d['attendanceId'];
        $date = date('Y-m-d H:i:s', $d['time']/1000);
        $pdo->prepare("INSERT INTO `records_data` (`Name`, `person_id`, `attendance_id`, `attendance_status`, `time`) VALUES ($name, $person_id, $at_id, $date)");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>
