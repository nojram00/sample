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
            grid-template-columns: 1fr 1fr 1fr 1fr;
            width: 80%;
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
    </style>
</head>
<body>
    <?php
    //Initialize
        require 'records.php';
        $records = new Records('12345',
                    '-1','0','0');
        $data = $records->GetResponse();
    ?>
    <div class="flex-box">
        <div class="header">

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
                            print '<div class="grid-items">
                                    '.$d['attendance']['attendanceId'].'
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
                            print '<div class="grid-items">
                                    '.$d['attendance']['attendanceStatus'].'
                                 </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
