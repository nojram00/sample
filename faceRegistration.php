<!DOCTYPE html>
<html>

<head>
    <title>Face Recognition</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
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
    <h1>Face Recognition</h1>
    <form method="post">

        <label for="personId">Enter Person ID:</label>
        <input type="text" id="personId" name="personId">
        <br>
        <input type="submit" id="send" name="scan" value="Scan Face">
    </form>
    <div id="responseDiv">
        <?php
        if (isset($_POST['scan'])) {
            $pass = '12345';
            $personId = $_POST['personId'];

            // Check if any of the input fields are empty
            if (empty($pass) || empty($personId)) {
                echo "Please fill in all the fields.";
            } else {
                // Make the API request using cURL
                $endpoint = "http://192.168.1.59:8090/face/takeImg";
                $data = array(
                    'pass' => $pass,
                    'personId' => $personId
                );

                $json = json_encode($data);

                $headers = [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($json)
                ];

                $curl = curl_init($endpoint);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // Set the headers

                $response = curl_exec($curl);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if (curl_errno($curl)) {
                    echo "Error: " . curl_error($curl);
                } else {
                    // Process the API response (you may want to handle success/error messages accordingly)
                    $decodedResponse = json_decode($response, true);
                    if ($decodedResponse["success"]) {
                        echo "Face Registered Successfully!";
                    } else {
                        echo "" . $decodedResponse["msg"];
                        echo "" . $decodedResponse["success"];
                    }
                }
                curl_close($curl);
            }
        }
        
        ?>
    </div>
</body>

</html>