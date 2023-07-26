<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <style>
        body{
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .header{
            min-height: 10vh;
            min-width: 100vh;
            width: 100%;
            left: 0;
            background-repeat: no-repeat;
            background: rgba(0, 0, 0, .90);
        }
        .flex-box{
            display: flex;
            flex-direction: column;
            background: black;
        }
        .main-container{
            min-height: 90vh;
            background-color: #fefdd0;
        }
        .grid{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            width: 100%;
        }
        .grid-item-row{
            display: grid;
            grid-template-columns: 1fr, 1fr, 1fr;
            gap: 8px;
        }
        .grid-items{
            text-align: center;
            padding: 8px;
        }
        .grid-header{
            font-weight: 700;
        }
        .flex-row{
            display: flex;
            flex-direction: row;
        }
        .justify-center{
            justify-content: center;
        }
        .align-item-center{
            /* align-items: center; */
            align-self: center;
        }
    </style>
</head>
<body>
    <?php
    //Initialize
        require 'records.php';

        $records = new Records('12345',
            '-1','0','0', endpoint:'http://192.168.1.59:8090');
        // $data;
        // $records->Test();
        if(isset($_POST['attendance-status']))
        {
            $status = $_POST['attendance-status'];
        }
        else{
            //Defaut status:
            $status = 'all';
        }
        if($status == 'all'){
            $data = $records->GetResponse();
        }
        if($status == 'On Work'){
            $data = $records->GetAllRecords()->GetTimeIn();
        }
        if($status == 'End of work'){
            $data = $records->GetAllRecords()->GetTimeOut();
        }
    ?>
    <div class="flex-box">
        <div class="header">
            <form action="recordData.php" method="POST" class="flex-row justify-center align-item-center">
                <select name="attendance-status" id="">
                <option value="all">All</option>
                    <option value="On Work">On Work</option>
                    <option value="End of work">End of Work</option>
                </select>
                <input type="submit" value="Filter">
            </form>
        </div>
        <div class="main-container">
            <div class="grid">
                <div class="grid-item-row">
                    <!-- All Names -->
                    <div class="grid-items grid-header">
                        Name
                    </div>
                    <?php
                        // $records->Test();
                        foreach($data as $d){
                            print '<div class="grid-items">
                                    '.$d['name'].'
                                 </div>';
                        }
                    ?>
                </div>
                <!-- Person ID -->
                <div class="grid-item-row">
                    <div class="grid-items grid-header">
                        Person ID
                    </div>
                    <?php
                        foreach($data as $d){
                            print '<div class="grid-items">
                                    '.$d['personId'].'
                                </div>';
                        }
                    ?>
                </div>
                <!-- Attendance ID -->
                <div class="grid-item-row">
                    <div class="grid-items grid-header">
                        Attendance ID
                    </div>
                    <?php
                        foreach($data as $d){
                            // echo '<pre>';
                            // var_dump($d);
                            $attendanceId = isset($d['attendance']['attendanceId']) ? $d['attendance']['attendanceId'] : '';
                            print '<div class="grid-items">
                                    '.$attendanceId.'
                                 </div>';
                        }
                    ?>
                </div>
                <!-- Attendance Status -->
                <div class="grid-item-row">
                    <div class="grid-items grid-header">
                        Attendance Status
                    </div>
                    <?php
                        foreach($data as $d){
                            $attendance = $d['attendance'];
                            if(array_key_exists('attendanceStatus', $attendance)){
                                print '<div class="grid-items">
                                '.$attendance['attendanceStatus'].'
                                </div>';
                            }
                        }
                    ?>
                </div>
                <!-- Time -->
                <div class="grid-item-row">
                    <div class="grid-items grid-header">
                        Time
                    </div>
                    <?php
                        date_default_timezone_set('Asia/Manila');
                        foreach($data as $d){
                            $date = date('Y-m-d h:i:s a',$d['time']/1000);
                            print '<div class="grid-items">
                                    '.$date.'
                                   </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
