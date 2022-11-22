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
    <link rel="stylesheet" href="styles/aboutUsDesign.css">
    <!--Form JS-->
    <script src="scripts/forms.js"></script>
    <title>ParaEase'O | About Us</title>
  </head>
  <body class="body-aboutUs">
    <?php include 'inc/header.php'?>
    <!--Main body-->
    <!--About Us start-->
    <?php require_once 'php/logic_form.php'; ?>
    <div class="container conatiner-aboutUs d-flex">
      <div class="row row-aboutUS sm-mt-2">
        <div class="col-lg-6 col-sm-12 center-image-aboutUs">
          <img src="assets/ParaEaseO_AboutUs_Picture.png" class="image-responsive" alt="">
        </div>
        <div class="col-lg-6 col-sm-12 text-responsive-aboutUs">
          <h3 style="font-family: Feeling Passionate; font-size: 60px; margin-top: 2vw;">About Us </h3> 
          <h4 style="font-family: Poppins; font-size: 30px;"> Project Implementers</h4>
          <p style="margin-top: 2vh; font-size: 20px;">
         We are students of the University of Santo Tomas. We made this website to showcase the charm of Palawan--one of the tourist hotspots here in the Philippines.
         Using our skills and knowledge, we would like to contribute in sharing the Filipino lifestyle by showing the beauty of the Philippines' geography, culture, and people.
          </p>
        </div>
        <!--About Us end-->
        <hr class="hr-style-aboutUs">
        <!--Connect with Us-->
        <div class="row row-connectWithUs">
          <div class="col-md-4 col-4-connectWithUs-Adjust">
            <h2 class="connectWithUs-title-adjust" style="font-family: Poppins; font-weight: bolder; margin-left: 1.8vw; font-size: 30px; width: max-content;"> Connect with us</h2>
              <!--Location Div-->
              <div class="container container-logos-connectWithUs">
                <img src="assets/Location_logo.png" class="image-responsive" style="width: 60px; height: 50px;" alt="">
                  <p class="p-connectWithUs" style="font-family: Poppins;">
                    UNIVERSITY OF SANTO TOMAS
                    Blessed Pier Giorgio Frassati Building
                    Blvd, Sampaloc, Manila, 1000 Metro Manila
                  </p>
              </div>
              <!--End of Location Div-->
              <!--Mail Div-->
              <div class="container container-logos-connectWithUs">
                <img src="assets/Mail_Logo.png" class="image-responsive" style="width: 50px; height: 50px;" alt="">
                <p class="p-connectWithUs" style="font-family: Poppins; margin-top: 1vh;">
                  someone@gmail.com
                </p>
              </div>
              <!--End of Mail Div-->
              <!--Person Div-->
              <div class="container container-logos-connectWithUs">
                <img src="assets/Person_logo.png" class="image-responsive" style="width: 60px; height: 50px;" alt="">
                <p class="p-connectWithUs" style="font-family: Poppins;">
                  09477947033<br>
                  Hans Simon Ramos<br>
                  <b>Contact Person</b>
                </p>
              </div>
              <!--Person Div-->
            <!--End of Col-8-->
        </div>
        <!-- forms -->
        <div class="col-md-8">
          <form id="form_feedback" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return form_submit(this)">
            <!--Fname Lname-->
            <div class="row g-2 form-adjust-connectWithUs" style="gap: 1vw;">
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control form-adjust-connectWithUs" id="name_first" name="name_first" placeholder="First Name" onchange="check_field_validity(this, 'first name')" required>
                  <label for="name_first">First Name</label>
                  <div class="invalid-feedback">Error text here</div>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <input type="text" class="form-control form-adjust-connectWithUs" id="name_last" name="name_last" placeholder="Last Name" onchange="check_field_validity(this, 'last name')" required>
                  <label for="name_last">Last Name</label>
                  <div class="invalid-feedback">Error text here</div>
                </div>
              </div>
            </div>
            <!--End of Fname Lname-->
            <!--Email-->
            <div class="form-floating">
              <input type="email" class="form-control form-adjust-connectWithUs" id="email" name="email" placeholder="Email (Example: name@domain.com)" onchange="check_field_validity(this, 'email')" required>
              <label for="email">Email Address</label>
              <div class="invalid-feedback">Error text here</div>
            </div>
            <!--Address-->
            <div class="form-floating">
              <input class="form-control form-adjust-connectWithUs" id="subject" name="subject" placeholder="Subject" onchange="check_field_validity(this, 'subject')" required>
              <label for="subject">Subject</label>
              <div class="invalid-feedback">Error text here</div>
            </div>
            <!--Text Area-->
            <div class="form-floating form-adjust-connectWithUs">
              <textarea class="form-control" placeholder="Leave a comment here" id="message" name="message" style="height: 100px" onchange="check_text_area_validity(this, 'message')" required></textarea required>
              <label for="message">Message</label>
              <div class="invalid-feedback">Error text here</div>
            </div>
            <!--Button-->
            <div class="container container-button-connectWithUs" style="margin-top: 3vh;">
              <button type="submit" id="btnSendMessage" class="btn btn-custom-connectWithUs" name="submit" value="feedback">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
