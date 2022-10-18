<?php
session_start();
$msg = "";
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    $type = $_POST['Type'];
    //try
    //{
    if ($type == "1") {
        $sql1 = "SELECT * FROM creator where email= ? and password = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ss", $em, $psw);
        $psw = hash('md5', $_POST['password']);
        //echo $psw;
        $em = $_POST['email'];
        $stmt1->execute();
        $result = $stmt1->get_result();
        $row = $result->fetch_assoc();
        if ($row == "" || $row == NULL) {
            echo '<script> window.alert("Invalid Credentials")</script>';
        } else {
            echo 'Login successful';
            $_SESSION['id'] = $row['id'];
            echo $_SESSION['id'];
            echo '<script type="text/javascript">location.href = "dashboard.php";</script>';
        }
    }
    //}
    //catch(Exception $e1)
    //{
    //    $x++;
    //try
    //{
    if ($type == "2") {
        $sql2 = "SELECT * FROM user where email = ? and password = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ss", $em2, $psw2);
        $psw2 = hash('md5', $_POST['password']);
        $em2 = $_POST['email'];
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        if ($row2 == "" || $row2 == NULL) {
            echo '<script> window.alert("Invalid Credentials")</script>';
        } else {
            echo 'Login successful';
            echo '<script type="text/javascript">location.href = "register1.php";</script>';
        }
    }
    /*catch(Exception $e2)
    {
        $x++;
    }*/
}
/* $sql="SELECT * FROM creator c, user u inner join where (c.EMAIL = '$em' and c.password = '$psw') or (u.email = '$em' and u.password = '$psw')";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($res === FALSE)
    {
        echo '<script>','validate_form()','</script>';
    }
    if($res !== FALSE)
    {
        $row = mysqli_fetch_array($res);
        $_SESSION['id'] = $row['id'];
        echo "<script>console.log(".$_SESSION['id'].");</script>";
    }
  }*/
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Login - Ether</title>
</head>

<body>
    <div class="form-body">
        <div class="form">
            <form action="" method="post">
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                    </tr>
                    <tr>
                        <td><input type="email" id="email" name="email" placeholder="xyz@abcd.com"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Password" id="password">Password </label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" id="password" name="password" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td><label for="Type">Type</label></td>
                    </tr>
                    <tr>
                        <td><select name="Type">
                                <option value="1">Author</option>
                                <option value="2">Reader</option>
                            </select></td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" value="Login" name="submit"><br>
                    <a href="register.html">Don't have an account? Click to register.</a>
                </div>
            </form>
        </div>
    </div>

</body>
<script>
function validate_form() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var ret = "false";
    console.log(email);
    if (email == null || email == "") {
        window.alert("Please fill Email");
        return false;
    }
    if (pass == null || pass == "") {
        window.alert("Please enter Password");
        return false;
    }
    // var re = /^\[A-Za-z]{1}(?=\w+)/;
    // console.log(pass.match(re));
    // if (pass.match(re)) {
    //     alert("Valid");
    // } else {
    //     alert("Invalid");
    //     return false;
    // }
    var regex = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    if (document.getElementById("email").value.match(regex)) {
        ret = "true";
        return true;
    }
    window.alert("You have entered an invalid email address!");
    return false;

}
</script>

</html>