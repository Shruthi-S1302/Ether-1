<?php
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Login - Ether</title>
</head>

<body>
    <div class="form-body">
        <div class="form">
            <form action="register.php" method="post">
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                    </tr>
                    <tr>
                        <td><input type="email" id="email" name="email" placeholder="xyz@abcd.com"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Password">Password </label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" id="password" name="password" placeholder="Password"></td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" onclick="return validate_form()" value="Login"><br>
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
    console.log(email);
    if (email == null || email == "") {
        window.alert("Please fill Email");
        return false;
    }
    if (pass == null || pass == "") {
        window.alert("Please enter Password");
        return false;
    }
    if (pass.length < 6) {
        window.alert("Password should contain minimum 8 characters");
        return false;
    }
    if (pass.length > 20) {
        window.alert("Password should contain maximum 20 characters");
        return false;
    }
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (document.getElementById("email").value.match(regex)) {
        window.alert("Success");
        return true;
    }
    window.alert("You have entered an invalid email address!");
    return false;

}
</script>

</html>