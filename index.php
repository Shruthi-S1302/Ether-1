<?php
$servername = "localhost";
$username = "hari";
$password = "password";
$conn = new mysqli($servername, $username, $password, "ether");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT title, excerpt from posts ORDER by likes desc LIMIT 6";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible&family=Raleway&family=Roboto&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome Kits -->
    <script src="https://kit.fontawesome.com/2df2d259ca.js" crossorigin="anonymous"></script>
    <title>Ether - A Knowledge Sharing Portal</title>
</head>


<body>
    <div class="home" id="home">
        <header>
            <h1 id="nav-title">ETHER</h1>
            <nav>
                <ul>
                    <li><input type="text" class="search" placeholder="Search ..."><button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>
                    <li><a href="./about.html">About</a></li>
                    <li><a href="./browse_ether.htm">Browse</a></li>
                    <li><button class="login" onclick="document.location.href = './login.php'">Login</button></li>
                </ul>
            </nav>
        </header>
        <h2 class="jumbotron line1">Let's make change.</h2>
        <h2 class="jumbotron line2">One post at a time.</h2>
    </div>

    <div class="test">
        <h2>Say Hello to some of our top writers.</h2>
        <div class="testimonials">
            <div class="testimonial">
                <img src="https://user-images.githubusercontent.com/83168881/167544540-8d4c362d-754a-4c44-9b03-1c7d6d20e3a0.jpg" alt="">
                <p>Ether, for me is a platform to learn, share and grow as a community.</p>
                <span class="author-name">Simi Garewal</span>
            </div>

            <div class="testimonial">
                <img src="https://i.pinimg.com/564x/4d/4e/a6/4d4ea6a67d4af18b6a171fa5b928b3fa.jpg" alt="">
                <p>Contributed some good load of work here. Found highly useful articles.
                    Thanks, Ether.</p>
                <span class="author-name">Steve Harrington</span>
            </div>

            <div class="testimonial">
                <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61" alt="">
                <p>Ether catered to all my needs of a good portal to share and learn new things.</p>
                <span class="author-name">Armaan Malik</span>
            </div>
        </div>
    </div>

    <div class="top-posts">
        <h1>Top Posts</h1>
        <ul class="card-wrapper">
            <?php
            while ($r = mysqli_fetch_row($result)) {
                $sql1 = "SELECT id from posts where title = '$r[0]'";
                $res1 = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($res1);
                $pid = $row['id'];
            ?>
                <a href="./post.php?id=<?php echo $pid ?>" class="card">

                    <li>

                        <h2 class="card-title"><?php echo $r[0] ?></h2>
                        <p class="post"><?php echo $r[1] ?></p>

                    </li>
                </a>
            <?php } ?>
            <!-- <a href="" class="card">
                <li>
                    <h2 class="card-title">Machine Learning</h2>
                    <p class="post">Machine Learning is the field of study that gives computers the capability to learn
                        without being explicitly programmed. As it is evident from the name, it gives the computer that
                        makes it more similar to humans: The ability to learn. Machine learning is actively being used
                        today, perhaps in many more places than one would expect.</p>
                </li>
            </a>
            <a href="" class="card">
                <li>
                    <h2 class="card-title">Tourism in Paris</h2>
                    <p class="post">Paris, capital of France, is one of the most important and influential cities in the
                        world. In terms of tourism, Paris is the second most visited city in Europe after London. In
                        this
                        travel guide, you’ll find out about the city’s top attractions, as well as useful travel advice
                        on
                        how to get to Paris and how to save money whilst traveling.</p>
                </li>
            </a>

            <a href="" class="card">
                <li>
                    <h2 class="card-title">Ikigai</h2>
                    <p class="post">It's the Japanese word for ‘a reason to live’ or ‘a reason to jump out of bed in the
                        morning’. It’s the place where your needs, desires, ambitions, and satisfaction meet. A place of
                        balance. Small wonder that finding your ikigai is closely linked to living longer. Finding your
                        ikigai is easier than you might think. This book will help you work out what your own ikigai
                        really
                        is, and equip you to change your life. You have a purpose in this world: your skills, your
                        interests, your desires and your history have made you the perfect candidate for something. All
                        you
                        have to do is find it. </p>
                </li>
            </a>
            <a href="" class="card">
                <li>
                    <h2 class="card-title">All about iOS 16</h2>
                    <p class="post">Apple is ready to announce the iOS 16 update for its smartphones on 12 September. It
                        is
                        also gearing up to launch the next watchOS update on the same date. The new software for Apple’s
                        iPhone series will come with numerous features. Some of these features were a part of the iOS 16
                        beta builds. They include a new lock screen, improved Focus Mode, and other changes.

                        The Apple iOS 16 and watchOS 9 updates will be revealed on 12 September. We have all the
                        necessary
                        details about the new changes and features that you might want to know about the update before
                        the
                        launch. </p>
                </li>
            </a>
            <a href="" class="card">
                <li>
                    <h2 class="card-title">The road not taken</h2>
                    <p class="post">This article deals with the Road Not Taken summary written by Robert Frost and
                        published in the year 1916. The Road Not Taken Summary is a poem that describes the dilemma of a
                        person standing at a road with diversion. This diversion symbolizes real-life situations.
                        Sometimes, in life too there come times when we have to take tough decisions. We could not
                        decide what is right or wrong for us.

                        Driven by our hopes and ambitions, we take a decision taken by fewer people. We think that if
                        fail to seek accomplishments we could get a chance to change and start again. However, we travel
                        too far and have to regret at the end. Also, it is possible that we could become an
                        extraordinary person because of that one decision. Thus, the road not taken summary focuses on
                        making wise decisions in life. </p>
                </li>
            </a> -->
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

    <script>
        var posts = document.getElementsByClassName("post");
        for (var i = 0; i < posts.length; i++) {
            var read_more = "<a href= ' ' style='color: #3e5c76;text-decoration: none; font-weight: bold'>...Read More</a>"
            console.log(posts[i].length);
            var p = posts[i].innerHTML.slice(0, 200);
            posts[i].innerHTML = p + read_more;
        }
    </script>
</body>

</html>