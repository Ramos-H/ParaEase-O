<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Feeling Passionate Font-->
    <link href="http://fonts.cdnfonts.com/css/feeling-passionate" rel="stylesheet">
    <!--Poppins Font-->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!--Page title Icon-->
    <link rel="shortcut icon" href="assets/icon.jpg" type="image/x-icon">
    <!--Main CSS-->
    <link rel="stylesheet" href="styles/index.css">
    <title>ParaEase'O | El Nido, Palawan Tourism Portal</title>
  </head>

  <body class="body-homepage">
    <?php include 'inc/header.php'?>

    <header class="masthead-homepage d-flex justify-content-center align-items-center">
      <div class="container px-4 px-lg-5 text-center">
        <h1 class = "h1-homepage">ParaEase'O</h1>
        <p class= "p-homepage">El Nido, Palawan Tourism Portal</p>
        <a href="#about">
          <button type="button" class="btn-lg btn btn-outline-light explore-btn px-3 py-1">Let's go!</button>
        </a>
      </div>
    </header>

    <section class="content-section" id="about">
      <div class="container-fluid text-center">
        <div class="row align-items-center">
          <div class="col-lg-6 order-2 order-lg-1 map-responsive" data-aos="fade-left" data-aos-delay="100">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241609.576289215!2d119.45416559033447!3d11.192972260553368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b65515ef5c9e0f%3A0xfc4e665b599b0455!2sEl%20Nido%2C%20Palawan!5e0!3m2!1sen!2sph!4v1668441207367!5m2!1sen!2sph" width="600" height="680" style="border:0;" allowfullscreen></iframe>            
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-2 content">
            <h1 class="pt-5"> Welcome to El Nido!</h1>
            <p class="pt-md-5 px-5">El Nido is the primary base for exploring Palawan's star attraction thanks to its paradise-like attractions of white sand, turquoise waters, vibrant coral reefs, and stunning limestone cliffs The gateway to the magnificent Bacuit Archipelago, which consists of 45 islands and islets, each with its own geological formation highlight the true wonders of the Municipality. It's no surprise that El Nido has consistently been ranked as one of the best island destinations in the world, not just in the Philippines.There are a ton of things to do in El Nido, so what are you waiting for? Pack your bags and get ready for an unforgettable adventure with the islands, nature and the sea all packed with beautiful scenery!</p>
          </div>
        </div>
      </div>
    </section>

    <section class="sticky-section">
      <div class="sticky-container package-a-container">
        <div class="left-column left-column-package-a">
          <h2 class="package-title package-title-a">Tour A</h2>
          <div class="package-content package-content-a">
            <p class="package-content-text">Big Lagoon</p>
            <p class="package-content-text">Secret Lagoon</p>
            <p class="package-content-text">Seven Commando</p>
            <p class="package-content-text">Small Lagoon</p>
            <p class="package-content-text">Shimizu Island</p>
          </div>
        </div>
        <div class="right-column package-bg-a"></div>
      </div>

      <div class="sticky-container package-b-container">
        <div class="left-column">
          <h2 class="package-title package-title-b">
            Tour B
          </h2>
          <div class="package-content package-content-b">
            <p class="package-content-text">Cudugnon Cave</p>
            <p class="package-content-text">Entalula Beach</p>
            <p class="package-content-text">Pinagbuyutan Island</p>
            <p class="package-content-text">Snake Island</p>
          </div>
        </div>
        <div class="right-column package-bg-b"></div>
      </div>

      <div class="sticky-container package-c-container">
        <div class="left-column">
          <h1 class="package-title package-title-c">Tour C</h1>
          <div class="package-content package-content-c">
            <p class="package-content-text">Helicopter Island</p>
            <p class="package-content-text">Matinloc Shrine</p>
            <p class="package-content-text">Hidden Beach</p>
            <p class="package-content-text">Star Beach</p>
            <p class="package-content-text">Secret Beach</p>
          </div>
        </div>
        <div class="right-column package-bg-c"></div>
      </div>
    </section>
    <!--Bootstrap JS bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

