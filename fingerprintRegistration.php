<!DOCTYPE html>
<html>

<head>
    <title>Fingerprint Recognition</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h1 {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
        padding: 5px;
        margin-bottom: 10px;
        width: 200px;
    }

    #send {
        background-color: greenyellow;
        width: 210px;
    }

    #postButton {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #postButton:hover {
        background-color: #45a049;
    }

    #responseDiv {
        margin-top: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <h1>Fingerprint Recognition</h1>
    <form method="post">
        <label for="personID">Enter Person ID:</label>
        <input type="text" name="personID" id="personID" required>
        <br>
        <input type="submit" id="send" name="scan" value="Scan Fingerprint">

    </form>
    <div id="responseDiv">
        <?php
        if (isset($_POST['scan'])) {
                // API Endpoint
                $endpoint = 'http://192.168.1.59:8090/face/fingerRegist';

                // Query Parameters Needed
                $pass = '54321';
                $personId = $_POST['personID'];

            // Create Request Body
            $data = [
                'pass' => $pass,
                'personId' => $personId
            ];

            $json = json_encode($data);

            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($json)
            ];

                // Make a POST request to the API endpoint
                $curl = curl_init($endpoint);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);

            if (curl_errno($curl)) {
            echo "Error: " . curl_error($curl);
        } else {
            // Process the API response (you may want to handle success/error messages accordingly)
            $decodedResponse = json_decode($response, true);
            if ($decodedResponse["success"]) {
                echo "Fingerprint Registered Successfully!";
            } else {
                echo "" . $decodedResponse["msg"];
            }
        }
        curl_close($curl);
    }
        ?>
    </div>
</body>

</html>