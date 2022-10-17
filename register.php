<?php
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    $type = $_POST['Type'];
    if ($type == "1") {
        //$sql = "INSERT into creator(name,email,password,dob,age,description,gender) VALUES ($name,$email,$password,$dob,$age,$pdesc,$gender)";
        $sql = "INSERT INTO creator(name,email,password,dob,age,description,gender) VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiss", $name, $email, $password, $dob, $age, $pdesc, $gender);
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $dob = $_POST['date'];
        $age = 40;
        $pdesc = $_POST['PDesc'];
        $gender = $_POST['Gender'];
        /* if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }*/
    } else if ($type == "2") {
        //$sql = "INSERT into creator(name,email,password,dob,age,description,gender) VALUES ($name,$email,$password,$dob,$age,$pdesc,$gender)";
        $sql = "INSERT into user(id,name,following,email,password,dob,age,description,gender) VALUES ('2001',$name,'100',$email,$password,$dob,$age,$pdesc,$gender)";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("New record created successfully")</script>';
        } else {
            echo '<script>alert("Error: " )</script>';
        }
    }
    $conn->close();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Register - Ether</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
    }

    #nav-title {
        font-size: 2rem;
        margin-right: auto;
        color: #FFF;
    }

    header {
        position: sticky;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px 50px;
        background-color: #495C83;
    }

    body {
        text-align: left;
        background-color: #495C83;
    }

    form {
        background-color: #ffffffa4;
        color: black;
        font-size: large;
        width: 35vw;
        height: 45vw;
        border-radius: 50px;
        padding-top: 1px;
        /* margin-top: 0.3vw; */
    }

    table {
        /* padding-top: 50px; */
        line-height: 50px;
    }

    th {
        text-align: center;
        color: black;
        font-size: 1.5vw;
    }

    tr {
        text-align: left;
    }

    label {
        color: black;
        font-size: 1.5vw;
        margin-bottom: 1vw;
        text-align: left;
    }

    .Copyright {
        text-align: center;
        padding: 5%;
        padding-bottom: 0;
    }

    input,
    select {
        margin-top: 1vw;
        border-radius: 10px;
        width: 12vw;
        height: 2.5vw;
        border-radius: 8px;
        border: 1px solid black;
        margin-left: 15px;
    }

    input[type="radio"] {
        width: 2vw;
    }

    textarea {
        vertical-align: bottom;
        margin-left: 15px;
        margin-top: 15px;
    }

    input[type="submit"] {
        width: 8vw;
        height: 1.5vw;
        margin-top: 1vw;
        border: 1px solid black;
    }

    input[type="submit"]:hover {
        background-image: linear-gradient(to right bottom, #8d85d7, rgb(80, 72, 130));
        color: #FFF;
    }

    a {
        color: black;
        font-size: large;
    }

    .Copyright {
        padding-bottom: 10px;
    }
    </style>
    <script>
    function validate() {
        var email = document.getElementById("Email").value
        var pass = document.getElementById("Password").value
        if (email == null || email == "") {
            window.alert("Please fill Email")
            return false
        }
        if (pass == null || pass == "") {
            window.alert("Please enter Password")
            return false
        }
        var dob = document.getElementById("date").value;
        var bd = new Date(dob);
        console.log(dob);
        var today = new Date();
        console.log(today)
        var diff = (today.getTime() - bd.getTime()) / (1000 * 3600 * 24 * 365);
        console.log(diff);
        if (diff < 18) {
            window.alert("People below age of 18 cannot create account. Please read the Terms and Conditions");
            return false;
        }
        var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (document.getElementById("Email").value.match(regex)) {
            return true
        }
        window.alert("You have entered an invalid email address!")
        return false;
    }
    </script>
</head>

<body>
    <header>
        <h1 id="nav-title">ETHER</h1>
    </header>
    <center>
        <form action="register.php" method="post">
            <table>
                <tr>
                    <th colspan="2">Register</th>
                </tr>
                <tr></tr>
                <tr>
                    <td>
                        <font color="red">*</font><label for="Name">Name </label>
                    </td>
                    <td><input type="text" id="Name" name="Name" required></td>
                </tr>
                <tr>
                    <td>
                        <font color="red">*</font><label for="Email">Email ID </label>
                    </td>
                    <td><input type="email" id="Email" name="Email"></td>
                </tr>
                <tr>
                    <td>
                        <font color="red">*</font><label for="Password">Password </label>
                    </td>
                    <td><input type="password" id="Password" name="Password"></td>
                </tr>
                <tr>
                    <td><label for="DOB">Date of Birth </label></td>
                    <td><input type="date" id="date" name="date"></td>
                </tr>
                <tr>
                    <td><label for="PDesc">Profile Description</label></td>
                    <td><textarea rows="5" cols="26" Name="PDesc"></textarea></td>
                </tr>
                <tr>
                    <td><label for="Gender">Gender </label></td>
                    <td><input type="radio" id="Gender" name="Gender" value="Male">Male <input type="radio"
                            name="Gender" value="Female">Female
                    </td>
                </tr>
                <tr>
                    <td><label for="Type">Type</label></td>
                    <td><select name="Type">
                            <option value="1">Author</option>
                            <option value="2">Reader</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Register" name="submit"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><a href="login.html">Login</a></td>
                </tr>
            </table>
        </form>
        <p class="Copyright">Ether &copy; 2022</p>
    </center>
</body>

</html>