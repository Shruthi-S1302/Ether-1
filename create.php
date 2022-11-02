<?php
session_start();
// Checks if a session is open
if (!isset($_SESSION['id'])) {
    // If a session is not open (not logged in), redirects to login-error.php
    header('location:error.php');
    die("Please login to access this page.");
} else {
    // Extracting data of owner through his owner ID
    $id = $_SESSION['id'];
    // Another way to connect to the MySQL database
    $con = mysqli_connect("localhost", "root", "", "ether");
    // SQL Query to select all relevant data of booking history of renter through his owner ID
    $sql1 = "SELECT * FROM creator WHERE id = '$id'";
    // Executing the Query
    $exc = mysqli_query($con, $sql1);
    // This statement returns the records of the result of the query
    // in the form of an array.
    $row = mysqli_fetch_array($exc);
}

if (isset($_POST['submit'])) {
    $con = mysqli_connect("localhost", "root", "", "ether");
    $title = $_POST['title'];
    $exc = $_POST['excerpt'];
    $cid = $_SESSION['id'];
    $content = $_POST['pst'];
    $view = 0;
    $likes = 0;
    $comm = 0;
    $stat = $_POST['status'];
    $tags = $_POST['tags'];
    $colab = $_POST['collab'];
    str_replace(" ", "-", $tags);
    $t = explode(",", $tags);
    $sql1 = "INSERT INTO posts (title, excerpt, content, creatorID, likes, comments, views, status) VALUES ('$title', '$exc', '$content', '$cid', $view, $comm , $likes, '$stat')";
    $exc = mysqli_query($con, $sql1);
    $sql2 = "SELECT id from posts where title = '$title' and creatorID = $cid";
    $exc = mysqli_query($con, $sql2);
    $row = $exc->fetch_assoc();
    $pid = $row['id'];
    foreach ($t as $c) {
        $sql3 = "INSERT INTO tags (`postID`, `tag`) VALUES ($pid, '$c')";
        $exc = mysqli_query($con, $sql3);
    }
    $sql5 = "INSERT INTO collaborate (`pid`,`cid`) VALUES ($pid,$id)";
    $exc = mysqli_query($con, $sql3);
    foreach ($colab as $c) {
        $sql3 = "INSERT INTO collaborate (`pid`,`cid`) VALUES ($pid,$c)";
        $exc = mysqli_query($con, $sql3);
    }
    header("location: ./post.php?id=$pid");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create New Post</title>
    <link rel="stylesheet" href="styles_create.css">
    <script src="mdtohtmlparser.js"></script>
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1 id="nav-title">ETHER</h1>
        <nav>
            <ul>
                <li><input type="text" class="arch" placeholder="  Search">
                </li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./browse_ether.php">Browse</a></li>
                <li><a href="./browse-edit.php">Your Posts</a></li>
                <li><a href="./dashboard.php">Dashboard</a></li>
                <li><button>Logout</button></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="about-us">
            <h4 style="color:rgb(1, 0, 86)">Create Post</h4>
            <br><br>
            <form method="post" action="">
                <table cellspacing="15px" valign="top">
                    <tr>
                        <td class="label">Title</td>
                        <td><input type="text" name="title" class="inp" placeholder="Enter Title"></td>
                    </tr>
                    <tr>
                        <td class="label">Excerpt</td>
                        <td><textarea class="txtarea" name="excerpt" placeholder="Enter excerpt of the post" cols="60" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td class="label">Tags</td>
                        <td><input class="inp" type="text" name="tags" placeholder="Enter tags seperated by commas">
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Post Content</td>
                        <td><textarea class="txtarea" cols="80" rows="15" id="pst" name="pst" placeholder="Enter the text of your post here. Markdown is supported! :D"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Permissions</td>
                        <td>
                            <select id="slct" name="status" class="slct">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Collaborators</td>
                        <td>
                            <select id="slct" name="collab[]" class="slct" multiple>
                                <?php
                                $sql4 = "SELECT * FROM creator WHERE id != $id";
                                $result3 = mysqli_query($con, $sql4);
                                while ($row3 = mysqli_fetch_array($result3)) {
                                ?>
                                    <option value="<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="terms" type="checkbox" value="I agree to all the terms and conditions"> <label class="terms">I agree to all the
                                terms and conditions. <a>Read Terms and Conditions Here.</a></label></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" class="submit" name="submit" onclick="send()" value="Publish Post">
                <br><br><br><br><br><br>
            </form>
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
            <a href="">Home</a>
            <a href="">About</a>
            <a href="">Browse</a>
            <a href="">Terms</a>
            <a href="">Privacy Policy</a>
        </div>

        <p class="Copyright">Ether &copy; 2022</p>
    </footer>
    <script>
        function send() {
            var s = document.getElementById("pst").value;
            document.getElementById("pst").value = parseMd(s);
        }
    </script>
</body>

</html>