<!DOCTYPE html>
<html>

<head>
    <title>Delete Employee</title>
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
        <input type="text" name="id" placeholder="Enter ID" required>
        <button type="submit" name="delete">Delete Data</button>
    </form>

    <?php
    if(isset($_POST['delete'])) {
        // API endpoint URL
        $endpoint = 'http://192.168.1.59:8090/person/delete';

        // Parameters for the request
        $pass = '54321';
        $id = $_POST['id']; // Retrieve the ID from the input field

        // Create the request body
        $data = [
            'pass' => $pass,
            'id' => $id
        ];

        // Encode the request body as JSON
        $json = json_encode($data);

        // Set the headers for the request
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ];

        // Send POST request
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        // Output the response
        echo '<p>Succesfully Deleted</p>';
    }
    ?>
</body>

</html>