<!DOCTYPE html>
<html>

<head>
    <title>Delete Records</title>
</head>
<style>
button {
    width: 100px;
    height: 50px;
    border-radius: 20px;
    background: lightskyblue;
}
</style>

<body>
    <form method="POST">
        <input type="text" name="personId" placeholder="Enter ID" required>
        <button type="submit" name="delete">Delete Records</button>
    </form>

    <?php
    if(isset($_POST['delete'])) {
        // API endpoint URL
        $endpoint = 'http://192.168.1.59:8090/newDeleteRecords';

        // Parameters for the request
        $pass = '54321';
        $personId = $_POST['personId'];
        $startTime = '2021-07-18 01:00:00';
        $endTime = '2024-07-18 01:00:00';
        $model = -1;

        // Create the request body
        $data = [
            'pass' => $pass,
            'personId' => $personId,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'model'  => $model
        ];

        // Encode the request body as URL-encoded format
        $json = http_build_query($data);

        // Set the headers for the request
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: ' . strlen($json)
        ];

        // Send POST request
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        // Output the response
        echo '<p>Records Deleted Successfully</p>';
    }
    ?>
</body>

</html>