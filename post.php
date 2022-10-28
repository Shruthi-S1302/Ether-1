<?php
session_start();
//$comment =
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$id = $_SESSION['id'];
//$creator_name = $_SESSION["author"];
//echo $creator_name;
$pid = $_GET['id'];
echo $pid;
$sql = "SELECT c.id, p.title, p.content, c.name FROM posts p, creator c WHERE c.id = p.creatorID and p.id = $pid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cid = $row['id'];
$title = $row['title'];
$cont = $row['content'];
$name = $row['name'];
$sql2 = "SELECT id from creator where name = '$name'";
$result2 = mysqli_query($conn, $sql2);
$row1 = mysqli_fetch_assoc($result2);
$creator_id = $row1['id'];
if (isset($_POST['addcomment'])) {
    // $sql = "INSERT INTO comments(userid, postid, description) VALUES(?,?,?,?,?,?,?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ssssiss", 1, 1, $comment);
    //echo $comment;
    $comment = $_POST['yourcomment'];
    echo "<h4 id= 'user'>$name says</h4>";
    echo "<p id='othercomments'>$comment</p>";
    // $sql = "INSERT INTO comments(userID, postID, description) VALUES(?, ?, ?)";
    // $stmt = $conn->prepare($sql);

    // $userID = $creator_id;
    // $postID = $pid;
    // $comment = $_POST['yourcomment'];
    // $stmt->bind_param('iis', $userID, $postID, $comment);
    // $stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post</title>
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>

    <!-- jsPDF CDN -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"
        integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="post.css">
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

    <div class="post">
        <div class="post-content" id="post">
            <h2 class="heading" id="save"><?php echo $title; ?></h2>
            <a href="creator_profile.php?id=<?php echo $cid; ?>" id="author" name="author"><?php echo $name; ?></a>
            <div class="tags" id="tags">
                <a href="" class="tag">Computer Science</a>
                <a href="" class="tag">Competitive Programming</a>
            </div>
            <p id="content" name="content"><?php echo $cont; ?></p>
        </div>
    </div>

    <div class="comments">
        <div class="icons">
            <div class="icon" id="bookmark"><i class="fa-solid fa-bookmark"></i></div>
            <div class="icon" id="submit" onclick="saveAsPDF()"><i class="fa-solid fa-download"></i></div>
            <div class="icon"><i class="fa fa-share-alt" id="sc" onclick="sharecount()"></i></div>
            <div class="icon" onclick="likecount()"><i class="fa fa-thumbs-up" id="lc"></i></div>
            <p class="count" id="Like">0</p>
        </div>
        <h2>Leave a comment (<span id="comment">0</span>)</h2>
        <p class="text">Start a discussion. Please be respectful in the comments section.</p>
        <hr>
        <form action="" method="post">
            <input type="text" placeholder="Write a comment" id="yourcomment" name="yourcomment"><br>
            <button id="addcomment" name="addcomment" type="submit">Add Comment</button>
        </form>

        <h4 id="user">Susindhar A V says</h4>
        <p id="othercomments" readonly></p><br>
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
    <script src="./printThis.js"></script>
</body>
<script>
function likecount() {
    var likeC = document.getElementById("Like").innerHTML;
    var lc = parseInt(likeC);
    //console.log(parseInt(likeC));
    if (lc == 0) {
        var inc = parseInt(likeC) + 1;
        lc = 1;
    } else {
        var inc = parseInt(likeC) - 1;
        lc = 0;
    }
    console.log(inc)
    document.getElementById("Like").innerHTML = inc;
}

function sharecount() {
    navigator.clipboard.writeText(window.location.href);
    alert("URL copied to clipboard");
    // var share = document.getElementById("Share").innerHTML;
    // var inc = parseInt(share) + 1;
    // document.getElementById("Share").innerHTML = inc;
}

function pc() {
    var comm = document.getElementById("yourcomment").value;
    comm = comm.trim();
    if (comm != "") {
        var userName = document.getElementById("user");
        var p = document.createElement("p");
        var x = document.createTextNode(comm);
        p.appendChild(x);
        userName.style.display = "block";
        var c = document.getElementById("othercomments").insertAdjacentElement('afterend', p);
        var comment_count = parseInt(document.getElementById("comment").innerHTML);
        document.getElementById("othercomments").setAttribute('value', comm);
        var d = document.getElementById("othercomments");
        //console.log(d);
        document.getElementById("comment").innerHTML = comment_count + 1;
        userName.setAttribute("style",
            "display: block; margin-left:6%; margin-top: 2%; font-size: 1.2rem; color: #1B2430; font-weight: bold");
        c.style.marginLeft = "8%";
    }
}
</script>
</body>

</html>