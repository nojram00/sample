<!DOCTYPE html>
<html>

<head>
    <title>Biometric Recognition</title>
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
    <h1>Biometric Recognition</h1>
    <form method="post">
        <label for="personId">Enter Person ID:</label>
        <input type="text" id="personId" name="personId" required>
        <br>
        <input type="submit" id="send" name="scanFace" value="Scan Face">
        <input type="submit" id="send" name="scanFingerprint" value="Scan Fingerprint">
    </form>
    <div id="responseDiv">
        <?php
        if (isset($_POST['scanFace'])) {
            // Face Recognition API Endpoint
            $faceEndpoint = "http://192.168.0.115:8090/face/takeImg";
            $pass = '12345';
            $personId = $_POST['personId'];

            // Check if any of the input fields are empty
            if (empty($pass) || empty($personId)) {
                echo "Please fill in all the fields.";
            } else {
                // Make the API request using cURL
                $faceData = array(
                    'pass' => $pass,
                    'personId' => $personId
                );

                $faceJson = json_encode($faceData);

                $faceHeaders = [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($faceJson)
                ];

                $faceCurl = curl_init($faceEndpoint);
                curl_setopt($faceCurl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($faceCurl, CURLOPT_POSTFIELDS, $faceJson);
                curl_setopt($faceCurl, CURLOPT_HTTPHEADER, $faceHeaders); // Set the headers

                $faceResponse = curl_exec($faceCurl);
                $faceHttpCode = curl_getinfo($faceCurl, CURLINFO_HTTP_CODE);

                if (curl_errno($faceCurl)) {
                    echo "Error: " . curl_error($faceCurl);
                } else {
                    // Process the API response (you may want to handle success/error messages accordingly)
                    $faceDecodedResponse = json_decode($faceResponse, true);
                    if ($faceDecodedResponse["success"]) {
                        echo "Face Registered Successfully!";
                    } else {
                        echo "" . $faceDecodedResponse["msg"];
                        echo "" . $faceDecodedResponse["success"];
                    }
                }
                curl_close($faceCurl);
            }
        }

        if (isset($_POST['scanFingerprint'])) {
            // Fingerprint Recognition API Endpoint
            $fingerprintEndpoint = 'http://192.168.0.115:8090/face/fingerRegist';
            $pass = '12345';
            $personId = $_POST['personId'];

            // Create Request Body
            $fingerprintData = [
                'pass' => $pass,
                'personId' => $personId
            ];

            $fingerprintJson = json_encode($fingerprintData);

            $fingerprintHeaders = [
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($fingerprintJson)
            ];

            // Make a POST request to the API endpoint
            $fingerprintCurl = curl_init($fingerprintEndpoint);
            curl_setopt($fingerprintCurl, CURLOPT_POST, 1);
            curl_setopt($fingerprintCurl, CURLOPT_POSTFIELDS, $fingerprintJson);
            curl_setopt($fingerprintCurl, CURLOPT_RETURNTRANSFER, true);

            $fingerprintResponse = curl_exec($fingerprintCurl);

            if (curl_errno($fingerprintCurl)) {
                echo "Error: " . curl_error($fingerprintCurl);
            } else {
                // Process the API response (you may want to handle success/error messages accordingly)
                $fingerprintDecodedResponse = json_decode($fingerprintResponse, true);
                if ($fingerprintDecodedResponse["success"]) {
                    echo "Fingerprint Registered Successfully!";
                } else {
                    echo "" . $fingerprintDecodedResponse["msg"];
                }
            }
            curl_close($fingerprintCurl);
        }
        ?>
    </div>
</body>

</html>