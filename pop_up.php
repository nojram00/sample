<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <style>
    /* Styling for the container */
    .container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #fff;
        z-index: 9999;
    }

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
    <button id="popupButton">Change Password</button>
    <div class="container" id="popupContainer">
        <form method="post" action="changeDevicePassword.php">
            <label for="oldPassword">Old Password:</label>
            <input type="password" name="oldPassword" id="oldPassword" required><br><br>

            <label for="newPassword">New Password:</label>
            <input type="password" name="newPassword" id="newPassword" required><br><br>

            <input type="submit" name="submit" value="Change Password">
        </form>
    </div>

    <script>
    // JavaScript to handle the button click and show/hide the container
    document.getElementById("popupButton").addEventListener("click", function() {
        var container = document.getElementById("popupContainer");
        if (container.style.display === "none") {
            container.style.display = "block";
        } else {
            container.style.display = "none";
        }
    });
    </script>
</body>

</html>