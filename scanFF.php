<?php
        if (isset($_POST['scanFace'])) {
            // Face Recognition API Endpoint
            $faceEndpoint = "http://192.168.1.59:8090/face/takeImg";
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
                    echo "<script>alert('Fingerprint registered successfully!');  window.history.go(-1);</script>";
                    } else {
                        echo "<script>alert('"  . $faceDecodedResponse["msg"]. "'); window.history.go(-1);</script>";
                    }
                }
                curl_close($faceCurl);
            }
        }

        if (isset($_POST['scanFingerprint'])) {
            // Fingerprint Recognition API Endpoint
            $fingerprintEndpoint = 'http://192.168.1.59:8090/face/fingerRegist';
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
                    echo "<script>alert('Fingerprint registered successfully!');  window.history.go(-1);</script>";
                } else {
                    echo "<script>alert('" . $fingerprintDecodedResponse["msg"] . "'); window.history.go(-1);</script>";
                }
            }
            curl_close($fingerprintCurl);
        }
        ?>