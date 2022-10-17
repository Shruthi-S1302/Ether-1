<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create New Post</title>
    <link rel="stylesheet" href="styles_create.css">
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
                <li><a href="./about.html">About</a></li>
                <li><a href="./browse.htm">Browse</a></li>
                <li><a href="./dashboard.html">Dashboard</a></li>
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
                        <td><input type="text" class="inp" placeholder="Enter Title"></td>
                    </tr>
                    <tr>
                        <td class="label">Excerpt</td>
                        <td><textarea class="txtarea" placeholder="Enter excerpt of the post" cols="60"
                                rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td class="label">Tags</td>
                        <td><input class="inp" type="text" placeholder="Enter tags seperated by commas"></td>
                    </tr>
                    <tr>
                        <td class="label">Post Content</td>
                        <td><textarea class="txtarea" cols="80" rows="15"
                                placeholder="Enter the text of your post here. Markdown is supported! :D"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="terms" type="checkbox"
                                value="I agree to all the terms and conditions"> <label class="terms">I agree to all the
                                terms and conditions. <a>Read Terms and Conditions Here.</a></label></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" class="submit" value="Publish Post">
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
</body>

</html>