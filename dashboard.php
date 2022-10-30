<?php

use function PHPSTORM_META\type;

session_start();
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sessid = $_SESSION['id'];
//echo $sessid;
//To select the name of the creator that has been logged in.
$sql = "SELECT NAME FROM CREATOR WHERE ID = $sessid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['NAME'];

//This is to select the number of posts posted by a creator.
$sql2 = "SELECT COUNT(id) as pcount from posts where creatorID='$sessid'";
$result1 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result1);
$post_count = $row2['pcount'];

//This is to select the most recent posts
$sql3 = "SELECT excerpt, title FROM posts where creatorID = $sessid LIMIT 5";
$result2 = mysqli_query($conn, $sql3);
// while ($ro = mysqli_fetch_row($result2)) {
//     echo $ro[0];
// }

//Select the position

$sql4 = "SELECT position from (SELECT ROW_NUMBER() OVER(ORDER BY COUNT(id) DESC) as position, creatorID, count(id) from  posts group by creatorID) as temptable where creatorID = $sessid";
$result3 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_assoc($result3);
$position = $row4['position'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles_create.css">
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap?family=Atkinson+Hyperlegible&"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <header>
        <h1 id="nav-title">ETHER</h1>
        <nav>
            <ul>
                <li><input type="text" class="arch" placeholder="Search">
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a href="./browse_ether.htm">Browse</a></li>
                <li><a href="./post.html">Posts</a></li>
                <li><button name="logout" id="logout" name="logout" onclick="location.href='logout.php'">Logout</button>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="about-us">
            <h4 style="color:rgb(1, 0, 86)" name="user">Hello, <?php echo $name ?></h4>
            <span class="btn"><button class="" onclick="document.location.href='./create.php'"><i class="fa fa-plus"
                        style="color:white"></i> Create
                    Post</button></span>
            <br><br><br>
            <div class="cards">
                <div class="card" style="overflow: hidden;">
                    <div class="card-content"
                        style="background-image: linear-gradient(to right bottom, #00b4db, #0083b0);">
                        <p class="card-title">Views</p><br>
                        <p class="card-metric" style="font-size:3em">4.3k</p>
                    </div>
                </div>
                <div class="card"
                    style="float: left; background-image: linear-gradient(to right bottom, #d4fc79 0%, #96e6a1 100%);;">
                    <div class="card-content">
                        <p class="card-title">Likes</p><br>
                        <p class="card-metric" style="font-size:3em">1.6k</p>
                    </div>
                </div>
                <div class="card"
                    style="float: left; background-image: linear-gradient(to right bottom, #fc5c7d, #6a82fb);">
                    <div class="card-content">
                        <p class="card-title">Position</p><br>
                        <p class="card-metric" style="font-size:3em"><?php echo $position ?></p>
                    </div>
                </div>
                <div class="card"
                    style="float: left; background-image: linear-gradient(to right bottom, #ff9966, #ff5e62);">
                    <div class="card-content">
                        <p class="card-title">Posts</p><br>
                        <p class="card-metric" style="font-size:3em"><?php echo $post_count ?></p>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="card-graph" style="float: right; margin-top: 2em; margin-bottom: 2em;">
            <div class="card-content">
                <select id="slct" class="slct" onchange="changeFunction()">
                    <option value="views">Views</option>
                    <option value="likes">Likes</option>
                </select>
                <p id="chart-title" style="font-weight: bold; text-align: center;"></p>
                <canvas id="myChart" style="width:100%"></canvas>
            </div>
        </div>
        <div class="card card-list" style="float:left">
            <div class="card-content">
                <p class="card-title">Your recent posts</p><br><br>
                <?php
                while ($r = mysqli_fetch_row($result2)) {
                ?>
                <p class="post-title"><?php echo $r[1]; ?></p>
                <p class="post-content"><?php echo $r[0]; ?></p>
                <?php echo "<br>"; ?>
                <?php echo "<hr>"; ?>
                <?php echo "<br>"; ?>
                <?php echo "<br>"; ?>
                <?php } ?>

            </div>
        </div>
        <br><br><br>
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
<script>
function changeFunction() {
    var a = document.getElementById("slct").value;
    console.log(a);
    if (slct.value == "views") {
        viewsChart();
    } else {
        likesChart();
    }
}
var a = document.getElementById("slct").value;
console.log(a);
if (slct.value == "views") {
    viewsChart();
} else {
    likesChart();
}

function likesChart() {
    document.getElementById("chart-title").innerHTML = "No. of likes";
    var xValues = ['01/09', '08/09', '15/09', '22/09', '29/09', '06/10', '13/10', '20/10', '27/10', '03/11', '10/11',
        '17/11'
    ];
    var yValues = [200, 300, 310, 400, 480, 500, 570, 800, 1300, 1350, 1500, 1600];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 100,
                        max: 2000
                    }
                }],
            }
        }
    });
}

function viewsChart() {
    document.getElementById("chart-title").innerHTML = "No. of views";
    var xValues = ['01/09', '08/09', '15/09', '22/09', '29/09', '06/10', '13/10', '20/10', '27/10', '03/11', '10/11',
        '17/11'
    ];
    var yValues = [900, 1000, 1200, 1800, 2700, 1400, 2000, 2200, 2300, 3000, 3500, 3800];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 800,
                        max: 5000
                    }
                }],
            }
        }
    });
}
</script>

</html>