<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- stylesheet -->
  <link rel="stylesheet" href="./style.css">
  <!--bootstrap icon-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!---font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Righteous&display=swap"
    rel="stylesheet">

  <title>Urban Soles</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top pb-2">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="./img/logo.png" class="img-fluid"
          alt="Urban Soles logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-3 mb-lg-0">
          <li class="nav-item m-2"> <!--Home-->
            <a class="nav-link active" aria-current="page" href="#">
              Home
            </a>
          </li>
          <li class="nav-item m-2"> <!--Shop-->
            <a class="nav-link" href="../Froilan_Catalog/catalog.php">
              Shop
            </a>
          </li>
          <li class="nav-item m-2"> <!--About Us-->
            <a class="nav-link" href="../Francine_About-Contact/about_us.php">
              About Us
            </a>
          </li>
          <li class="nav-item m-2">
            <a class="nav-link" href="../Francine_About-Contact/contact_us.php"> <!--Contact Us-->
              Contact Us
            </a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="px-2 search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn1 me-3 px-3" type="submit">Search</button>
          <a href="../Clark_Cart-Checkout/index.php" data-toggle="tooltip" title="Your Cart"><i class="bi bi-cart"></i></a>
        </form>
      </div>
    </div>
  </nav>


  <!---MAIN SECTION-->

  <section class="main py-5">
    <div class="container py-5">
      <div class="row py-5">
        <div class="col-lg-6 py-5">
          <p class="m-0">Shop Quality. Shop Urban.</p>
          <h1>Urban Soles</h1>
          <p style="color: rgb(243, 43, 83);">Your one-stop online shop for all things shoes.</p>
          <button class="mbtn1 mt-4">Shop now</button>
        </div>
      </div>
    </div>
  </section>

  <!--ABOUT US SECTION-->
  <section class="about py-5">
    <div class="container py-5">
      <div class="row py-5">
        <div class="col-lg-5 py-5 offset-lg-6 col-md-6 col-sm-12 col-12">
          <h1>About Urban Soles</h1>
          <div class="line my-3"></div>
          <p>
          <h3>Urban Soles</h3>is your premier destination for the latest in footwear fashion. Founded with a passion for
          quality and style, we are dedicated
          to offering an extensive range of shoes that cater to every taste and occasion. From sleek, professional
          office wear to casual,
          comfortable everyday options, our collection is curated to meet the diverse needs of our customers.<br>
          Here at <strong>Urban Soles</strong>,
          we believe that the perfect pair of shoes can transform your look and elevate your confidence. Our commitment
          to exceptional
          customer service, competitive pricing, and fast, reliable shipping ensures a seamless shopping experience.
          Discover your perfect fit today
          and step out in style with <strong>Urban Soles</strong>!
          </p>
          <button class="mbtn2 mt-4"><a href="#"></a>More</button>
        </div>
      </div>
    </div>
  </section>

  <section class="footer py-3">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-6 m-auto">
          <p>
            <a href="https://github.com/aubs7/AppDevFinalProj.git"><i class="bi bi-github"></i></a>
            Made by NEU 3BSCS-1 students
          </p>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script>
    const navEl = document.querySelector('.navbar',);


    window.addEventListener('scroll', () => {
      if (window.scrollY >= 56) {
        navEl.classList.add('navbar-scrolled');
      } else if (window.scrollY < 56) {
        navEl.classList.remove('navbar-scrolled');
      }
    });

  </script>
</body>

</html>