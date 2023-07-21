<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h2 {
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

    .error {
        color: red;
    }
    </style>
</head>

<body>
    <h2>Change Password</h2>
    <form method="post" action="">
        <label for="oldPassword">Old Password:</label>
        <input type="password" name="oldPassword" id="oldPassword" required><br><br>

        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" id="newPassword" required><br><br>

        <input type="submit" name="submit" value="Change Password">
    </form>
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Set the API endpoint
    $apiEndpoint = "http://192.168.0.115:8090/setPassWord";

    // Retrieve old and new passwords from the form
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    // Check if the required fields are not empty
    if (empty($oldPassword) || empty($newPassword)) {
        echo "Please fill in both old and new passwords.";
        exit;
    }

    // Prepare the data to be sent in the POST request
    $postData = array(
        "oldPass" => $oldPassword,
        "newPass" => $newPassword
    );

    // Initialize cURL session
    $curl = curl_init($apiEndpoint);

    // Set cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute cURL request and get the response
    $response = curl_exec($curl);

    // Check for cURL errors
        if (curl_errno($curl)) {
            echo "Error: " . curl_error($curl);
        } else {
            // Process the API response (you may want to handle success/error messages accordingly)
            $decodedResponse = json_decode($response, true);
            if ($decodedResponse["success"]) {
                echo "Password changed successfully!";
            } else {
                echo "" . $decodedResponse["msg"];
            }
        }
        
        // Close cURL session
        curl_close($curl);
    }

    

    // // Output the response
    // if ($response === "SUCCESS") {
    //     echo "Password changed successfully!";
    // } elseif ($response === "WRONG_OLD_PASSWORD") {
    //     echo "Wrong old password. Password not changed.";
    // } else {
    //     echo "An error occurred while changing the password.";
    // }
    // }
?>
</body>

</html>