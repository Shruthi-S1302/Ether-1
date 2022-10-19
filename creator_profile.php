<?php
session_start();
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sessid = $_SESSION['id'];
//echo print_r($_SESSION);
$sql = "SELECT NAME , description, filename FROM CREATOR WHERE ID = $sessid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['NAME'];
$desc = $row['description'];
$image = $row['filename'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="creator_profile_styles.css">
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <title>Author Profile</title>
</head>

<body>
    <header>
        <h1 id="nav-title">ETHER</h1>
        <nav>
            <ul>
                <li><input type="search" class="search" placeholder="Search ..."><button type="submit"
                        class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a href="">Browse</a></li>
                <li><button class="login">Logout</button></li>
            </ul>
        </nav>
    </header>

    <div class="author-profile">
        <div class="profile">
            <img src=".images/<?php echo $image ?>" alt="<?php echo $image ?>">
            <h2 class="author-name"><?php echo $name ?></h2>
            <h4 class="position"><?php echo $desc ?></h4>
            <button class="follow-button" id="follow-button" onclick="change()">Follow</button>
            <div class="follow">
                <div class="followers">
                    <p class="number">2.2K</p>
                    <h3>Followers</h3>
                </div>
                <div class="followers">
                    <p class="number">200</p>
                    <h3>Articles</h3>
                </div>
                <div class="followers">
                    <p class="number">3.6K</p>
                    <h3>Following</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="my-articles">
        <h1>Popular Posts</h1>
        <ul class="card-wrapper">
            <a href="./post.html" class="card">
                <li>
                    <h2 class="card-title">Data Structures</h2>
                    <p class="post">A data structure is not only used for organizing the data. It is also used for
                        processing, retrieving, and storing data. There are different basic and advanced types of
                        data </p>
                </li>
            </a>

            <a href="./post.html" class="card">
                <li>
                    <h2 class="card-title">Data Structures</h2>
                    <p class="post">A data structure is not only used for organizing the data. It is also used for
                        processing, retrieving, and storing data. There are different basic and advanced types of
                        data </p>
                </li>
            </a>

            <a href="" class="card">
                <li>
                    <h2 class="card-title">Data Structures</h2>
                    <p class="post">A data structure is not only used for organizing the data. It is also used for
                        processing, retrieving, and storing data. There are different basic and advanced types of
                        data </p>
                </li>
            </a>

            <a href="./post.html" class="card">
                <li>
                    <h2 class="card-title">Data Structures</h2>
                    <p class="post">A data structure is not only used for organizing the data. It is also used for
                        processing, retrieving, and storing data. There are different basic and advanced types of
                        data </p>
                </li>
            </a>
        </ul>
    </div>

    <footer>
        <div class="footer-icons">
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>

        <div class="footer-links">
            <a href="#home">Home</a>
            <a href="./about.html">About</a>
            <a href="./browse_ether.htm">Browse</a>
            <a href="">Terms</a>
            <a href="">Privacy Policy</a>
        </div>

        <p class="Copyright">Made with ❤️. Ether &copy; 2022</p>
    </footer>
</body>

<script>
function change() {
    var button_text = document.getElementById("follow-button").innerHTML;
    console.log(button_text);
    button_text = "Following";
    document.getElementById("follow-button").innerHTML = button_text;
}
</script>

</html>