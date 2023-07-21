<!DOCTYPE html>
<html>

<head>
    <title>Create New Employee</title>
</head>
<style>
.container {
    width: 500px;
    height: 500px;
    align-items: center;
    justify-content: center;
    background-color: lightblue;
    display: flex;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.personInfo {
    border: 20;
    width: 412.685px;
    height: 162.75px;
    flex-shrink: 0;
    margin-top: -50%;
    position: relative;

}

.person {
    width: 200px;
    height: 40px;
    border-radius: 20px;
    border: 2px solid #000;
    background: #FFF;
    position: relative;
    margin: 5px;
}

.employmentAccess {
    margin-top: 400px;
    position: absolute;
    width: 403.457px;
    height: 198px;
    flex-shrink: 0;
    flex-shrink: 0;
    display: flex;
}

.save {
    margin-top: 400px;
    width: 50px;
    height: 50px;
    border-radius: 30%;
    background-color: lightgreen;
    font-size: 15px;
    font-weight: bold;
}

.btnFace {
    width: 100px;
    height: 100px;
    background-color: white;
    border-radius: 10%;
}


.btnFinger {
    width: 50px;
    height: 50px;
    color: black;
    background-color: white;
    border-radius: 10%;
}

label {
    display: flex;
    font-weight: bold;
    font-size: 20px;
}
</style>

<body>
    <form class="container" action="addnewrecords.php" method="POST">
        <div class="personInfo">
            <div>
                <input type="text" name="name" class="person" placeholder="Enter First Name">
            </div>
            <div>
                <input type="text" class="person" placeholder="Enter Last Name">
            </div>
            <div>
                <input type="text" name="id" id="id" class="person" placeholder="Enter Employee ID">
            </div>
            <div>
                <input type="number" name="" class="person" placeholder="Enter Contact Number">
            </div>
            <div>
                <input type="password" class="person" placeholder="Enter Password">
            </div>
        </div>
        <div class="employmentAccess">


            <div>
                <label for="label">Face Recognition:</label>
                <input type="button" onclick="getFacePhoto()" value="" class="btnFace" placeholder="+">
            </div>
            &nbsp;
            &nbsp;
            &nbsp;
            <div>
                <label for="label">Fingerprint:</label>
                <input type="button" onclick="getFingerprint()" class="btnFinger" placeholder="+">
            </div>
        </div>
        <button class="save">Save</button>
    </form>

</body>

<script type="text/javascript">
    const getFacePhoto = () => {
        console.log('Get Face Photo!')
        const empIDTextBox = document.getElementById('id')
        fetch(`createEmployeeHandler.php?id=${empIDTextBox.value}&type=face`)
            .then(res => res.text())
            .then(data => {
                console.log(data);
            })
            .catch(err => console.error(err));
    }
    const getFingerprint = () => {
        console.log('Get Fingerprint!');
        const empIDTextBox = document.getElementById('id')
        fetch(`createEmployeeHandler.php?id=${empIDTextBox.value}&type=fingerprint`)
            .then(res => res.text())
            .then(data => {
                console.log(data);
            })
            .catch(err => console.error(err));
    }
</script>
</html>





