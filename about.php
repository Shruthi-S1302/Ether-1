<?php
session_start();
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>About US</title>
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1 id="nav-title"><a href="index.php">ETHER</a></h1>
        <nav>
            <ul>

                <li><input type="search" class="search" placeholder="Search ..."><button type="submit"
                        class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./browse_ether.php">Browse</a></li>
                <?php if(isset($_SESSION['id']))
        {
          ?>
        <li><button class="login" onclick="document.location.href = './logout.php'">Logout</button></li>
        <?php
        }
        else
        {
          ?>
          <li><button class="login" onclick="document.location.href = './login.php'">Login</button></li>
          <?php
        }
        ?>
            </ul>
        </nav>
    </header>
    <div class="about-us">
        <h4>Meet our team.</h4>
        <p class="about">Ether was created by the four of us. It started off as a mere school project, which has now
            turned into a
            mission to transform knowledge sharing as we know it. We know of video sharing websites, song/podcast
            publishing platforms where we can share content for free to everyone regardless of who they are. <br>Our
            knowledge is one of the most important resources that will improve our society as a whole. A wise general
            once said, <span class="quote">&quot;Gaining knowledge is the first step to wisdom, Sharing it is the first
                step to
                humanity.&quot;</span> Hopefully we help you all take your first step. Cheers!</p>
    </div>

    <div class="founders">
        <div class="founder">
            <img src="./images/hari.jpg" alt="">
            <p>A CSE student, working towards imporving my skills. Loves to play chess</p>
            <span class="founder-name">Harikrishna R</span>
        </div>

        <div class="founder">
            <img src="./images/susindhar.jpg" alt="">
            <p>A student working towards data - driven solutions to grassroot problems.</p>
            <span class="founder-name">Susindhar A V</span>
        </div>

        <div class="founder">
            <img src="./images/Reuben Photo.jpeg" alt="">
            <p>A BTech student, love programming, play badminton.</p>
            <span class="founder-name">Reuben Manoj</span>
        </div>

        <div class="founder">
            <img src="./images/shruthi photo.jpg" alt="">
            <p>Passionate learner. BTech Undergradute. Loves to code, sing and cook.</p>
            <span class="founder-name">Shruthi S</span>
        </div>
    </div>

    <footer>
        <div class="footer-icons">
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
        </div>

        <div class="footer-links">
            <a href="./index.html">Home</a>
            <a href="./about.html">About</a>
            <a href="./browse_ether.htm">Browse</a>
            <a href="">Terms</a>
            <a href="">Privacy Policy</a>
        </div>

        <p class="Copyright">Made with ❤️. Ether &copy; 2022</p>
    </footer>
</body>

</html>