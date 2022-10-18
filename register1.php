<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
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
        $check = 0;
        //$sql = "INSERT into creator(name,email,password,dob,age,description,gender) VALUES ($name,$email,$password,$dob,$age,$pdesc,$gender)";
        $sql = "INSERT INTO creator(name,email,password,dob,age,description,gender, filename) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisss", $name, $email, $hash, $dob, $age, $pdesc, $gender, $fileName);
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $hash = hash('md5', $_POST['Password']);
        $confirm = $_POST['confirm'];
        $dob = $_POST['date'];
        $age = 40;
        $pdesc = $_POST['PDesc'];
        $gender = $_POST['Gender'];
        $valid = "select * from creator where email='$email';";
        $res = mysqli_query($conn, $valid);
        $fileName = basename($_FILES["profile"]["name"]);
        //echo $fileName;
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        $targetDir = "images/";
        $targetFilePath = $targetDir . $fileName;
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
                $check += 1;
            } else {
                echo "File upload error";
            }
        } else {
            echo "Only JPG, JPEG, PNG files are allowed for profile image.";
        }
        if (mysqli_num_rows($res) > 0) {
            echo "<script>alert('Email already exists.')</script>";
        } else {
            $check += 1;
            if ($confirm != $password) {
                echo "<script>alert('Password doesnot match.')</script>";
            } else {
                $check += 1;
            }
        }
        if ($check == 3) {
            $stmt->execute();
        }

        /* if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }*/
    } else if ($type == "2") {
        //$sql = "INSERT into creator(name,email,password,dob,age,description,gender) VALUES ($name,$email,$password,$dob,$age,$pdesc,$gender)";
        $sql = "INSERT INTO user(name,email,password,dob,age,description,gender) VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiss", $name, $email, $hash, $dob, $age, $pdesc, $gender);
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $hash = hash('md5', $_POST['Password']);
        $confirm = $_POST['confirm'];
        $dob = $_POST['date'];
        $age = 40;
        $pdesc = $_POST['PDesc'];
        $gender = $_POST['Gender'];
        $status = 0;
        $valid = "select * from user where email='$email';";
        $res = mysqli_query($conn, $valid);

        //$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        //$allowTypes = array('jpg', 'png', 'jpeg');
        //echo $fileName;
        //$stmt->execute();
        if (mysqli_num_rows($res) > 0) {
            echo "<script>alert('Email already exists.')</script>";
        } else {
            if ($confirm != $password) {
                echo "<script>alert('Error')</script>";
            } else {
                $stmt->execute();
            }
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>

<body>
    <h2>REGISTER</h2>
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <label for="Name"><span>*</span> Name </label>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" id="Name" name="Name" required></td>
                </tr>
                <tr>
                    <td>
                        <label for="Email"><span>*</span> Email ID </label>
                    </td>
                </tr>
                <tr>
                    <td><input type="email" id="Email" name="Email"></td>
                </tr>
                <tr>
                    <td>
                        <label for="Password"><span>*</span> Password </label>
                    </td>
                </tr>
                <tr>
                    <td><input type="password" id="Password" name="Password"></td>
                </tr>
                <tr>
                    <td><label for="CPassword"><span>*</span> Confirm Password </label></td>
                </tr>
                <tr>
                    <td><input type="password" id="confirm" name="confirm"></td>
                </tr>
                <tr>
                    <td><label for="DOB"> Date of Birth </label></td>
                </tr>
                <tr>
                    <td><input type="date" id="date" name="date"></td>
                </tr>
                <tr>
                    <td><label for="">Profile Image</label></td>
                </tr>
                <tr>
                    <td><input type="file" name="profile" id="profile"></td>
                </tr>
                <tr>
                    <td><label for="PDesc">Profile Description</label></td>
                </tr>
                <tr>
                    <td><textarea rows="5" cols="26" Name="PDesc"></textarea></td>
                </tr>
                <tr>
                    <td><label for="Gender">Gender </label></td>
                </tr>
                <tr>
                    <td><input type="radio" id="Gender" name="Gender" value="Male">Male <input type="radio"
                            value="Female" name="Gender">Female<input type="radio" name="Gender"
                            value="Prefer not to say"> Prefer not to say
                    </td>
                </tr>
                <tr>
                    <td><label for="Type">Type</label></td>
                </tr>
                <tr>
                    <td><select name="Type">
                            <option value="1">Author</option>
                            <option value="2">Reader</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="submit">
                <input type="submit" onclick="validate()" value="Register" name="submit"><br>
                <a href="login.html">Already have an account? Login</a>
            </div>
        </form>
    </div>
    <p class="Copyright">Ether &copy; 2022</p>


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
        var regpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[\w@$!%#*?&]{8,}$/;
        if (!pass.match(regpass)) {
            alert("Please enter a valid password.");
            return false;
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
</body>

</html>