<?php
session_start();

$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ERROR | E_PARSE);
$id = $_SESSION['id'];

$pid = $_GET['id'];
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

$sql3 = "SELECT * FROM views WHERE userID = '$id' AND postID = '$pid'";
$result3 = mysqli_query($conn, $sql3);
$row2 = mysqli_num_rows($result3);
$sql7 = "SELECT * FROM user WHERE id = '$id'";
$result5 = mysqli_query($conn, $sql7);
$row4 = mysqli_num_rows($result5);
if ($row2 == 0 && $row4 != 0) {
    $sql4 = "INSERT INTO views(postID,userID) VALUES ('$pid','$id')";
    mysqli_query($conn, $sql4);
    $sql5 = "SELECT views FROM posts WHERE id = $pid";
    $result4 = mysqli_query($conn, $sql5);
    $row3 = mysqli_fetch_assoc($result4);
    $v = $row3['views'];
    $v = $v + 1;
    $sql6 = "UPDATE posts SET views = '$v' WHERE id = '$pid'";
    mysqli_query($conn, $sql6);
}
if (isset($_POST['addcomment'])) {
    echo '<script>pc()</script>';
    $comment = $_POST['yourcomment'];
    $sql = "INSERT INTO comments(userID, postID, description) VALUES(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $userID = $id;
    $postID = $pid;
    $stmt->bind_param('iis', $userID, $postID, $comment);
    $stmt->execute();
    $sql2 = "SELECT u.name,c.description FROM user u,comments c WHERE c.postID = $postID AND u.id = c.userID ORDER BY c.id DESC";
    $result2 = mysqli_query($conn, $sql2);
}

// To display likes
$sql3 = "SELECT likes from posts where id = '$pid'";
$result3 = mysqli_query($conn, $sql3);
$row2 = mysqli_fetch_assoc($result3);
$likecount = $row2['likes'];


//To count number of comments
$sql4 = "SELECT count(postID) as c_count from comments where postID = $pid";
$result4 = mysqli_query($conn, $sql4);
$row3 = mysqli_fetch_assoc($result4);
$comment_count = $row3['c_count'];

$sql6 = "UPDATE posts set comments = ? where id = $pid";
$stmt1 = $conn->prepare($sql6);
if ($comment_count != null) {
    $stmt1->bind_param('i', $comment_count);
    $stmt1->execute();
}


//To report comments
if (isset($_POST['commentid']) && isset($_POST['userid']) && isset($_POST['description'])) {
    $comid = $_POST['commentid'];
    echo "<script>alert($comid)</script>";
    $uid = $_POST['userid'];
    $desc = $_POST['description'];
    $sql8 = "INSERT INTO `reportcomments` (`commentID`, `userID`, `cuserID`, `description`) VALUES ($comid, $uid, $id, '$desc')";
    mysqli_query($conn, $sql8);
}

// To get tags
$sql9 = "SELECT tag from tags WHERE postID = $pid";
$result9 = mysqli_query($conn, $sql9);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post</title>
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- jquery CDN  -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- jsPDF CDN -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js" integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                <li><input type="search" class="search" placeholder="Search ..."><button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><a href="">Browse</a></li>
                <li><button class="logout" name="logout" onclick="location.href='logout.php'">Logout</button></li>
            </ul>
        </nav>
    </header>

    <div class="post">
        <div class="post-content" id="post">
            <h2 class="heading" id="save"><?php echo $title; ?></h2>
            <a href="creator_profile.php?id=<?php echo $cid; ?>" id="author" name="author"><?php echo $name; ?></a>
            <div class="tags" id="tags">
                <?php
                while ($row9 = mysqli_fetch_array($result9)) {
                ?>
                    <a href="browse_ether.php?tag=<?php echo $row9['tag'] ?>" class="tag"><?php echo $row9['tag'] ?></a>
                <?php
                }
                ?>
            </div>
            <p id="content" name="content"><?php echo $cont; ?></p>
        </div>
    </div>

    <div class="comments">
        <div class="icons">
            <div class="icon" id="submit" onclick="saveAsPDF()"><i class="fa-solid fa-download"></i></div>
            <div class="icon"><i class="fa fa-share-alt" id="sc" onclick="sharecount()"></i></div>
            <div class="icon"><button type="button" name="like" id='likebutton'><i class="fa fa-thumbs-up" id="lc" onclick="likecount()"></i></button></div>
            <p class="count" id="Like" name='likecount'><?php echo $likecount ?></p>
        </div>
        <h2>Leave a comment (<span id="comment"><?php echo $comment_count ?></span>)</h2>
        <p class="text">Start a discussion. Please be respectful in the comments section.</p>
        <hr>
        <form action="" method="post">
            <input type="text" placeholder="Write a comment" id="yourcomment" name="yourcomment" autocomplete="off"><br>
            <button id="addcomment" name="addcomment" type="submit">Add Comment</button>
        </form>
        <?php
        if (TRUE) {
            error_reporting(E_ERROR | E_PARSE);
            session_start();
            $servername = "localhost";
            $username = "hari";
            $password = "password";
            $conn = new mysqli($servername, $username, $password, "ether");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $id = $_SESSION['id'];
            $pid = $_GET['id'];
            $postID = $pid;
            $sql2 = "SELECT u.name,c.description,c.id,u.id FROM user u,comments c WHERE c.postID = $postID AND u.id = c.userID ORDER BY c.id DESC";
            $result2 = mysqli_query($conn, $sql2);
            while ($r = mysqli_fetch_row($result2)) {
        ?>
                <h2><?php echo $r[0]; ?> says</h2><?php echo "<pre>                             $r[1]</pre>"; ?>
                <br><button class="btn btn-secondary float-right" onclick="sendrep(<?php echo $r[2]; ?>,<?php echo $r[3]; ?>)">Report this comment</button><br>
        <?php
            }
        }
        ?>
        <br><br>
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
    function sendrep(a, b) {
        var id = <?php echo $id; ?>;
        let exp = prompt("Explain why you are reporting this comment.", "");
        $.ajax({
            type: 'post',
            url: 'post.php?id=' + id,
            data: {
                'commentid': a,
                'userid': b,
                'description': exp
            },
            success: function f() {
                alert("Sent successful.");
            },
        });
        alert("Your report has been sent to the administrator.");
    }
    var likeC = <?php echo $likecount ?>;
    var current_like = parseInt(document.getElementById('Like').innerHTML);
    var lc = 0;
    var timesClicked = 0;

    function likecount() {
        timesClicked++;
        var id = <?php echo $pid ?>;
        if (timesClicked % 2 != 0) {
            var likeButton = document.getElementById('lc');
            likeButton.className = "fa fa-thumbs-down";
            var inc = likeC + 1;
            $.ajax({
                type: 'post',
                url: 'post.php?id=' + id,
                data: {
                    'likes': inc
                },
            });
            var like_disp = document.getElementById('Like');
            like_disp.innerHTML = inc;
            <?php $sql5 = "UPDATE posts set likes = ? where id = $pid";
            $stmt = $conn->prepare($sql5);
            $likes = $_POST['likes'];
            echo $likes;
            if ($likes != null) {
                $stmt->bind_param('i', $likes);
                $stmt->execute();
            }
            ?>
        } else {
            var likeButton = document.getElementById('lc');
            likeButton.className = "fa fa-thumbs-up";
            var inc = likeC;
            console.log(inc);
            var postID = "<?php echo $pid ?>";

            $.ajax({
                type: 'post',
                url: 'post.php?id=' + id,
                data: {
                    'likes': inc
                },
            });
            var like_disp = document.getElementById('Like');
            like_disp.innerHTML = inc;

            <?php $sql5 = "UPDATE posts set likes = ? where id = $pid";
            $stmt = $conn->prepare($sql5);
            $likes = $_POST['likes'];
            echo $likes;
            if ($likes != null) {
                $stmt->bind_param('i', $likes);
                $stmt->execute();
            }
            ?>
        }
    }

    function sharecount() {
        navigator.clipboard.writeText(window.location.href);
        alert("URL copied to clipboard");
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