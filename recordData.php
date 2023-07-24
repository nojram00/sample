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
            grid-column: auto;
            width: 80%;
        }
        .grid-item-row{
            grid-row: auto;
            padding: 25px;
        }
        .grid-item-col{
            grid-column: auto;
            padding: 25px;
        }
    </style>
</head>
<body>
    <div class="flex-box">
        <div class="header">

        </div>
        <div class="main-container">
            <div class="grid">
                <div class="grid grid-item-col">
                    <div class="grid-item-row">
                        Name
                    </div>
                    <div class="grid-item-row">
                        ID
                    </div>
                </div>
                <div class="grid grid-item-row">
                    <div class="grid-item-col">
                        Name
                    </div>
                    <div class="grid-item-col">
                        ID
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
