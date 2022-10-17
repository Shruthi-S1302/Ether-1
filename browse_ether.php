<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="browse_style_ether.css">
  <title>browse</title>


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
        <li><a href="./about.html">About</a></li>
        <li><a href="./browse.htm">Browse</a></li>
        <li><button class="login" onclick="document.location.href = './login.html'">Login</button></li>
      </ul>
    </nav>
  </header>

  <div class="search">
    <forms>
      <input type="text" placeholder="Search Ether..." size="50" class="search-bar">
    </forms>
    <i class="fa fa-search"></i>
    <br>

    <select id="Filter">
      <option value="" disabled selected hidden>Filter</option>
      <option>Author</option>
      <option>Liked posts</option>
      <option>collaborations</option>
    </select>


    <select id="Sort">
      <option disabled selected hidden>Sort by</option>
      <option>rating</option>
      <option>latest</option>
      <option>popular</option>
    </select>
  </div>

  <br>
  <button id="filter_1" onclick="filter_blogs()">five_star</button>


  <br><br><br>
  <div class="Tags">
    <p>Tags</p><br>
    <a href="#">-Filter</a><br>
    <a href="#">-Food</a><br>
    <a href="#">-Lifestyle</a><br>
    <a href="#">-Fashion</a><br>
    <a href="#">-Music</a><br>
    <a href="#">-Travel</a><br>
    <a href="#">-Health</a><br>
    <a href="#">-Personal</a><br>
    <a href="#">-DIY craft</a><br>
    <a href="#">-Parenting</a><br>
    <a href="#">-Business</a><br>
    <a href="#">-Book </a><br>
    <a href="#">-Finance</a><br>
    <a href="#">-Design</a><br>
    <a href="#">-Sports </a><br>
    <a href="#">-News</a><br>
    <a href="#">-Movie</a><br>
    <a href="#">-Religion</a><br>
    <a href="#">-Political</a><br>

  </div>

  <div class="Tags1">
    <div class="blog">
      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/2022/2/17/12-most-polluted-rivers-in-the-world class="one_star"
          id="one1">

          <p class="post">Rivers are a critical part of our ecosystem; they not only provide drinking water to
            billions of people, but are also homes to our precious wildlife.
          </p>
        </a>
      </div>

      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/why-we-should-care-about-plastic-pollution class="three_star"
          id="three1">

          <p class="post">Have you ever heard of the Great Pacific Garbage Patch? It’s a giant floating mass of
            plastic waste brought
            together by various ocean currents between Hawaii.</p>
        </a>
      </div>

      <div class="blog_pic">
        <a href=https://epicentre.org.za/2022/09/01/alternative-medicine/ class="two_star" id="two1">
          <p class="post"> For 20 years Epicentre has been fighting South African’s infectious diseases, and now we’re
            taking on COVID-19! We are a company founded on a vision.</p>
        </a>
      </div>
      <div class="blog_pic">
        <a href=https://epicentre.org.za/2022/09/01/4720yrs-history-high-bp/ class="four_star" id="four1">
          <p class="post"> High blood pressure (hypertension) is a common condition in which the long-term force of
            the blood against your artery walls is high enough.</p>
        </a>
      </div>
      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/2022/2/18/earth-day-2022-7-things-you-can-do-to-celebrate-earth-day
          class="three_star" id="3.21">

          <p class="post"> Prior to the first Earth Day, Americans were exerting a mass amount of leaded gas due to
            inefficient automobiles.</p>
        </a>
      </div>
      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/2022/5/9/finding-your-climate-action-intersection-virtual-panel-recap
          class="four_star" id="4.51">
          <p class="post"> Here were no consequences from the law or media because air pollution was accepted as a
            byproduct of economic growth.</p>
        </a>
      </div>
      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/great-divide class="three_star" id="3.51">
          <p class="post"> The Great Divide runs along the peaks and ridges of the main range of the Rocky Mountains
            in Canada, continues South, dividing all of North America into east-flowing water.</p>

        </a>
      </div>
      <div class="blog_pic">
        <a href=https://seasmartschool.com/blog/education-day-resources class="five_star" id="five1">
          <p class="post"> The United Nations declared this day to celebrate the power of education in bringing peace
            and development to nations and communities around the world. </p>
        </a>
      </div>
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
    const btn = document.getElementById("filter_1");

    const targetDiv1d = document.getElementById("one1");

    const targetDiv2d = document.getElementById("three1");

    const targetDiv3d = document.getElementById("two1");

    const targetDiv4d = document.getElementById("four1");

    const targetDiv5d = document.getElementById("3.21");

    const targetDiv6d = document.getElementById("4.51");

    const targetDiv7d = document.getElementById("3.51");

    const targetDiv8d = document.getElementById("five");
    function filter_blogs() {

      if (targetDiv1d.style.display !== "none") {
        targetDiv1d.style.display = "none";
      } else {
        targetDiv1d.style.display = "block";
      }


      if (targetDiv2d.style.display !== "none") {
        targetDiv2d.style.display = "none";
      } else {
        targetDiv2d.style.display = "block";
      }

      if (targetDiv3d.style.display !== "none") {
        targetDiv3d.style.display = "none";
      } else {
        targetDiv3d.style.display = "block";
      }

      if (targetDiv4d.style.display !== "none") {
        targetDiv4d.style.display = "none";
      } else {
        targetDiv4d.style.display = "block";
      }

      if (targetDiv5d.style.display !== "none") {
        targetDiv5d.style.display = "none";
      } else {
        targetDiv5d.style.display = "block";
      }

      if (targetDiv6d.style.display !== "none") {
        targetDiv6d.style.display = "none";
      } else {
        targetDiv6d.style.display = "block";
      }


      if (targetDiv7d.style.display !== "none") {
        targetDiv7d.style.display = "none";
      } else {
        targetDiv7d.style.display = "block";
      }

      if (targetDiv8d.style.display !== "none") {
        targetDiv8d.style.display = "block";
      }
    };


  </script>
</body>

</html>