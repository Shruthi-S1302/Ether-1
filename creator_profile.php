<?php
session_start();
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sessid = $_GET['id'];
$user_id = $_SESSION['id'];
//echo print_r($_SESSION);
//$creator_name = $_SESSION['author'];
$sql = "SELECT name, description, filename from creator c, posts p where p.creatorID = c.id and c.id = $sessid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$desc = $row['description'];
$image = $row['filename'];
if ($image == NULL) {
    $image_path = "./images/default.jpg";
} else {
    $image_path = "./images/" . $image;
}


//To count total number of articles of the author
$sql2 = "SELECT COUNT(p.id) as posts_count from posts p where p.creatorID = $sessid";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$post_count = $row2['posts_count'];

//To count total likes of the author
$sql3 = "SELECT SUM(likes) as total_likes from posts where creatorID = $sessid";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$likes_count = $row3['total_likes'];

//To select popular posts
$sql4 = "SELECT title, excerpt from posts  where creatorID = $sessid ORDER by likes desc LIMIT 6";
$result4 = mysqli_query($conn, $sql4);
$val = 'Follow';

$sql5 = "SELECT count(fromID) as follow from follows where toID = $sessid";
$result5 = mysqli_query($conn, $sql5);
$row4 = mysqli_fetch_assoc($result5);
$follow_count = $row4['follow'];


if (isset($_POST['state'])) {
    if ($_POST['state'] == "Following") {
        echo "<script>alert($sessid)</script>";
        $sql3 = "SELECT * FROM follows WHERE fromID = '$user_id' and toID = '$sessid'";
        $result3 = mysqli_query($conn, $sql3);
        $row4 = mysqli_num_rows($result3);
        if ($row4 == 0) {
            $sql2 = "INSERT into follows (fromID, toID) values ($user_id, $sessid)";
            mysqli_query($conn, $sql2);
        }
        $val = $_POST['state'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="creator_profile_styles.css">
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Author Profile</title>
</head>

<body>
    <header>
        <h1 id="nav-title">ETHER</h1>
        <nav>
            <ul>
                <li><input type="search" class="search" placeholder="Search ..."><button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a href="">Browse</a></li>
                <li><button class="login" onclick="window.location.href='logout.php'">Logout</button></li>
            </ul>
        </nav>
    </header>

    <div class="author-profile">
        <div class="profile">
            <img src="<?php echo $image_path ?>" alt="<?php echo $image ?>">
            <h2 class="author-name"><?php echo $name ?></h2>
            <h4 class="position"><?php echo $desc ?></h4>
            <button class="follow-button" id="follow-button" name="follow" onclick="change()"><?php echo $val ?></button>
            <div class="follow">
                <div class="followers">
                    <p class="number"><?php echo $follow_count ?></p>
                    <h3>Followers</h3>
                </div>
                <div class="followers">
                    <p class="number"><?php echo $post_count ?></p>
                    <h3>Articles</h3>
                </div>
                <div class="followers">
                    <p class="number"><?php echo $likes_count ?></p>
                    <h3>Likes</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="my-articles">
        <h1>Popular Posts</h1>
        <ul class="card-wrapper">
            <?php
            while ($r = mysqli_fetch_row($result4)) {
                $sql5 = "SELECT id from posts where title = '$r[0]'";
                $res = mysqli_query($conn, $sql5);
                $row4 = mysqli_fetch_assoc($res);
                $pid = $row4['id'];
            ?>
                <a href="./post.php?id=<?php echo $pid ?>" class="card">

                    <li>
                        <h2 class="card-title"><?php echo $r[0] ?></h2>
                        <p class="post"><?php echo $r[1] ?></p>

                    </li>
                </a>
            <?php } ?>
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
        if (button_text == "Follow") {
            button_text = "Following";
            document.getElementById("follow-button").innerHTML = button_text;
        }
        var id = <?php echo $sessid ?>;

        $.ajax({
            type: 'post',
            url: 'creator_profile.php?id=' + id,
            data: {
                'state': button_text
            },
            success: function() {
                alert(button_text)
            }
        });
    }
</script>

</html>