<?php
    require 'scanFF.php';

//   $fingerprintResponse = curl_exec($fingerprintCurl);

   
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pop-up Container Example</title>
    <style type="text/css">
    /* CSS to style the popup container */
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

    .empID {
        padding: 5px;
        margin-bottom: 10px;
        width: 200px;

    }

    .input {

        width: 30px;
        height: 30px;
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

    #popupContainer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    #popupContent {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
        font-size: 30px;
    }
    </style>
</head>

<body>

    <button id="updateEmp">Update Employee</button>
    <div id="popupContainer">
        <div id="popupContent">
            <span class="close" id="closeButton">&times;</span>
            <form method="post" action="scanFF.php">
                <label id="label">Enter Person ID:</label>
                <input type="text" id="personId" name="personId" class="empID"
                    value=" <?php echo isset($_POST['personId']) ? htmlspecialchars($_POST['personId']) : ''; ?>"
                    required />
                <br />
                <label id="label">Face Register:</label>
                <input type="submit" id="send" name="scanFace" value="&plus;" class="input" />
                <label id="label">Fingerprint Register:</label>
                <input type="submit" id="send" name="scanFingerprint" value="&plus;" class="input" />
            </form>
            <div id="responseDiv">
            </div>
        </div>

        <script type="text/javascript">
        document.getElementById("updateEmp").addEventListener("click", function() {
            var container = document.getElementById("popupContainer");
            if (container.style.display === "none") {
                container.style.display = "block";
            } else {
                container.style.display = "none";
            }
        });
        document.getElementById("closeButton").addEventListener("click", function() {
            var container = document.getElementById("popupContainer");
            container.style.display = "none";
        });
        </script>
</body>

</html>