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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="browse_style_ether.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <title>Browse - Ether</title>


  <!-- Google Fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&family=Roboto&display=swap&family=Roboto&display=swap"
    rel="stylesheet">

  <!-- Styles -->

  <!-- Font Awesome Kits -->
  <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <h1 id="nav-title">ETHER</h1>
    <nav>
      <ul>
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

  <div class="search">
    <form method="post" action="">
      <input type="text" placeholder="Search Ether..." size="50" class="search-bar" name="search">
      <input style="font-family: FontAwesome; background: none; border: none; font-size: large; color: white" value="&#xf002;" type="submit">
    </form>
    
    <br>

    <select id="Filter">
      <option value="" disabled selected hidden>Filter</option>
      <option>Author</option>
      <option>Liked posts</option>
      <option>collaborations</option>
    </select>


    <select id="Sort" onchange = "sort()">
      <option disabled selected hidden>Sort by</option>
      <option value = "rating">rating</option>
      <option value = "latest">latest</option>
      <option value = "popular">popular</option>
    </select>
  </div>


  <br><br><br>
  <div class="Tags">
    <p>Tags</p><br>
    <?php
      $sql1 = "SELECT DISTINCT tag FROM tags";
      $result = mysqli_query($conn, $sql1);
      while ($row1 = mysqli_fetch_array($result))
      {
      ?>
      <a href="browse_ether.php?tag=<?php echo $row1['tag']?>"><?php echo $row1['tag']?></a>
      <?php
      }
      ?>
      
  </div>

  <div class="Tags1">
    <div class="blog">

      <?php
      $sql2 = "SELECT * FROM posts";
      if(isset($_GET['tag']))
      {
        $t = $_GET['tag'];
        $sql2 = "SELECT p.* FROM posts p, tags c where c.postID = p.id AND c.tag = '$t'";
      }
      if (isset($_POST['search']))
      {
        $s = $_POST['search'];
        $sql2 = "SELECT * FROM posts WHERE title like '%$s%' OR excerpt like '%$s%' OR content like '%$s%'";
      }
      if(isset($_GET['sort']))
      {
        $s = $_GET['sort'];
        if($s == "rating")
        $sql2 = "SELECT * FROM posts WHERE title like '%$s%' OR excerpt like '%$s%' OR content like '%$s%' ORDER BY likes DESC";
        elseif($s == "latest")
        $sql2 = "SELECT * FROM posts WHERE title like '%$s%' OR excerpt like '%$s%' OR content like '%$s%' ORDER BY id DESC";
        elseif($s == "popular")
        $sql2 = "SELECT * FROM posts WHERE title like '%$s%' OR excerpt like '%$s%' OR content like '%$s%' ORDER BY views DESC";
      }
      $result1 = mysqli_query($conn, $sql2);
      while ($row1 = mysqli_fetch_array($result1))
      {
      ?>
      <div class="blog_pic">
        <a href="post.php?id=<?php echo $row1['id']; ?>" class="one_star"
          id="one1">

          <p class="post">
            <span style="font-weight: bold"><?php echo $row1['title']; ?></span><br>
          <?php echo $row1['excerpt']; ?>
          </p>
        </a>
      </div>
      <?php
      }
      ?>
    </div>
  </div>
  <div class="footer">
    <div class="footer-icons">
      <a href=""><i class="fa-brands fa-twitter"></i></a>
      <a href=""><i class="fa-brands fa-facebook-f"></i></a>
      <a href=""><i class="fa-brands fa-instagram"></i></a>
      <a href=""><i class="fa-brands fa-youtube"></i></a>
    </div>

    <div class="footer-links">
      <a href="#home">Home</a>
      <a href="./about.html">About</a>
      <a href="">Browse</a>
      <a href="">Terms</a>
      <a href="">Privacy Policy</a>
    </div>
  </div>
  
  <script>
    function sort()
    {
      var setting = document.getElementbyId("Sort").value;
      $.ajax({
        type: 'get',
        url: 'browse_ether.php',
        data : {
          sort: setting
        },
        success: function suc() {}
      });
    }
  </script>
</body>

</html>