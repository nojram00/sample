<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample</title>
    <style>
        body{
            top: 0;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .screen-width{
            display: fixed;
            min-height: 100vh;
            height: 100vh;
        }
        .bg-black-transparent{
            background: rgba(0, 0, 0, 0.5);
        }
        .header{
            display: grid;
            padding-right: 5rem;
            padding-left: 5rem;
            background: #ffffff;
        }
        .main{
            background: #fefefe;
            padding: 25px;
            margin: 2rem;
            border-radius: 2rem;
        }
        .flex-row{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-content: center;
        }
        .flex-col{
            display: flex;
            flex-direction: column;
            justify-items: center;
            justify-content: space-between;
            align-items: center;
            align-content: space-between;
        }
    </style>
    <script type="text/javascript" src="elements.js"></script>
    <script>
        id = getdocumentById('id')
        ip = getdocumentById('ip-address')
        pass = getdocumentById('password')
        getbiometrics = (type) => {
            if (type === 'fingerprint') {
                // fetch(`/createEmployeeHandler.php?id=${id}&type=${type}`)
                fetch(`ip:8090/face/fingerRegist?pass=${pass.value}&personId=${id.value}`)
                    .then(res => res.json())
                    .catch(err => console.error(err));
            }
            if (type === 'face'){

            }
        }
    </script>
</head>
<body>
    <div class="screen-width bg-black-transparent">
        <div class="header">
            <h1>Hello</h1>
        </div>
        <div class="main">
            <form action="" class="flex-col">
                <input type="text" name="" id="ip-address" placeholder="Ip address">
                <input type="text" name="" id="password" placeholder="password">
                <input type="text" name="" id="id" placeholder="ID">
                <button type="button" onclick="getbiometrics('fingerprint')">Enter your fingerprint</button>
                <button type="button" onclick="getbiometrics('face')">Enter your face</button>
            </form>
        </div>
    </div>
</body>
</html>


