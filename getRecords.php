<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .flex {
            display: flex;
        }
        .flex-row{
            flex-direction: row;
        }
        .flex-col{
            flex-direction: column;
        }
        .w-half{
            min-width: 25%;
            width: 25%;
        }
        .p-5{
            padding: 5px;
        }
        .m-3{
            margin: 3px;
        }
    </style>
</head>
<body>
    <form action="post.php" method="POST" class="flex flex-col w-half">
        <input type="hidden" name="pass" value="12345" class="p-5 m-3">
        <input type="text" name="personID" placeholder="Emp ID" class="p-5 m-3">
        <input type="datetime-local" name="startTime" id="" class="p-5 m-3">
        <input type="datetime-local" name="endTime" id="" class="p-5 m-3">
        <!-- <input type="date" id="time-input" name="startdate">
        <input type="time" name="startTime" id="">
        <input type="datetime-local" id="time-input" name="endDate">
        <input type="time" name="endTime" id=""> -->
        <input type="submit" value="Get all">
    </form>
</body>
</html>
