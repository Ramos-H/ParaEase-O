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
    <link rel="stylesheet" href="styles/main.css">
    <title>ParaEase'O | Travel Packages</title>
  </head>

  <body class="body-packages">
    <?php include 'inc/header.php'?>
    <?php require_once 'php/logic_form.php'; ?>

    <header class="masthead-packages">
      <div class="container-fluid text-center d-flex justify-content-center">
        <div class="row justify-content-center ">
          <div class="col-4 box card py-5 mx-5 my-2" style="width: 12rem; height: auto;">
            <div class=" card-body py-5 align-items-center">
              <h2>Tour A</h2>
              <h1>₱ 1,200</h1>
              <p>per pax</p>
              <a href="#">
                <button type="button" class="btn-lg btn select-btn px-3 py-1" id="button">SELECT PACKAGE</button>
              </a>
              <?php if($most_popular_package === 1): ?>
                <p>Most popular!</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-4 box card py-5 mx-5 my-2" style="width: 12rem; height: auto;">
            <div class="card-body py-5 align-items-center">
              <h2>Tour B</h2>
              <h1>₱ 1,300</h1>
              <p>per pax</p>
              <a href="#">
                <button type="button" class="btn-lg btn select-btn px-3 py-1" id="button-2">SELECT PACKAGE</button>
              </a>
              <?php if($most_popular_package === 2): ?>
                <p>Most popular!</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-4 box card py-5 mx-5 my-2" style="width: 12rem; height: auto;">
            <div class="card-body py-5 align-items-center">
              <h2>Tour C</h2>
              <h1>₱ 1,400</h1>
              <p>per pax</p>
              <a href="#">
                <button type="button" class="btn-lg btn select-btn px-3 py-1" id="button-3">SELECT PACKAGE</button>
              </a>
              <?php if($most_popular_package === 3): ?>
                <p>Most popular!</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!--- Package A Modal Start -->
        <div class="bg-modal">
          <div class="modal-content">
            <div class="modal-main">
              <div class="close">+</div>
              <h1 class="h1-forms">Ready to Explore?</h1>
              <hr class="hr-forms">
              <div class="row">
                <div class="col-4 text-center">
                  <h1 class="h1-tour">Tour A</h1>
                  <h2 class="h2-tour">₱ 1,200<h2>
                  <h6 class="h6-tour">per pax</h6>
                </div>
                <div class="col-7">
                  <form name="package_A" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
                    <!-- First and last name row start -->
                    <div class="row">
                      <!-- First name -->
                      <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control input-sm" name="name_first" id="name_first_1" placeholder="First Name" onchange="check_field_validity(this, 'first name')" required>
                          <label for="name_first_1">First Name</label>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
              
                      <!-- Last name -->
                      <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control input-sm" name="name_last" id="name_last_1" placeholder="Last Name" onchange="check_field_validity(this, 'last name')" required>
                          <label for="name_last_1">Last Name</label>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <!-- First and last name row end -->
                    <!-- Email -->
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control input-sm" name="email" id="email_1" placeholder="Email" onchange="check_field_validity(this, 'email')" required>
                      <label for="email_1">Email</label>
                      <div class="invalid-feedback"></div>
                    </div>
                    <!-- Subject -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control input-sm" name="subject" id="subject_1" placeholder="Subject" onchange="check_field_validity(this, 'subject')" required>
                      <label for="subject_1">Subject</label>
                      <div class="invalid-feedback"></div>
                    </div>
              
                    <!-- Message -->
                    <div class="form-floating mb-3">
                      <textarea class="form-control input-sm" name="message" id="message_1" placeholder="Message / Concerns / Requests" onchange="check_text_area_validity(this, 'message')" required></textarea>
                      <label for="message_1">Message</label>
                      <div class="invalid-feedback"></div>
                    </div>
                    <input type="hidden" name="submit" value="1">
                    <div class="book-btn-row">
                      <button type="button" class="btn btn-lg select-btn-forms" onclick="package_book_submit(1)">Book</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="response" style="display: none;">
              <div class="row">
                <div class="col">
                  <h2>Booked Successfully!</h2>
                  <p class="mb-5">See you in El Nido!</p>
                  <p class="mt-5">Please don't navigate away from this page. You will be redirected to the homepage after a few seconds.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Package A Modal End -->

        <!--- Package B Modal Start -->
        <div class="bg-modal-2">
          <div class="modal-content">
            <div class="modal-main">
              <div class="close-2">+</div>
                <h1 class="h1-forms">Ready to Explore?</h1>
                <hr class="hr-forms">
                <div class="row">
                  <div class="col-4 text-center">
                    <h1 class="h1-tour">Tour B</h1>
                    <h2 class="h2-tour">₱ 1,300<h2>
                    <h6 class="h6-tour">per pax</h6>
                  </div>
                  <div class="col-7">
                    <form name="package_B" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
                      <!-- First and last name row start -->
                      <div class="row">
                        <!-- First name -->
                        <div class="col-12 col-sm-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control input-sm" name="name_first" id="name_first_2" placeholder="First Name" onchange="check_field_validity(this, 'first name')" required>
                            <label for="name_first_2">First Name</label>
                            <div class="invalid-feedback"></div>
                          </div>
                        </div>
              
                        <!-- Last name -->
                        <div class="col-12 col-sm-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control input-sm" name="name_last" id="name_last_2" placeholder="Last Name" onchange="check_field_validity(this, 'last name')" required>
                            <label for="name_last_2">Last Name</label>
                            <div class="invalid-feedback"></div>
                          </div>
                        </div>
                      </div>
                      <!-- First and last name row end -->
                      <!-- Email -->
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control input-sm" name="email" id="email_2" placeholder="Email" onchange="check_field_validity(this, 'email')" required>
                        <label for="email_2">Email</label>
                        <div class="invalid-feedback"></div>
                      </div>
                      <!-- Subject -->
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control input-sm" name="subject" id="subject_2" placeholder="Subject" onchange="check_field_validity(this, 'subject')" required>
                        <label for="subject_2">Subject</label>
                        <div class="invalid-feedback"></div>
                      </div>
              
                      <!-- Message -->
                      <div class="form-floating mb-3">
                        <textarea class="form-control input-sm" name="message" id="message_2" placeholder="Message / Concerns / Requests" onchange="check_text_area_validity(this, 'message')" required></textarea>
                        <label for="message_2">Message</label>
                        <div class="invalid-feedback"></div>
                      </div>
                      <input type="hidden" name="submit" value="2">
                      <div class="book-btn-row">
                        <button type="button" class="btn btn-lg select-btn-forms" onclick="package_book_submit(2)">Book</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="response" style="display: none;">
              <div class="row">
                <div class="col">
                  <h2>Booked Successfully!</h2>
                  <p class="mb-5">See you in El Nido!</p>
                  <p class="mt-5">Please don't navigate away from this page. You will be redirected to the homepage after a few seconds.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Package B Modal End -->

        <!--- Package C Modal Start -->
        <div class="bg-modal-3">
          <div class="modal-content">
            <div class="modal-main">
              <div class="close-3">+</div>
              <h1 class="h1-forms">Ready to Explore?</h1>
              <hr class="hr-forms">

              <div class="row">
                <div class="col-4 text-center">
                  <h1 class="h1-tour">Tour C</h1>
                  <h2 class="h2-tour">₱ 1,400<h2>
                  <h6 class="h6-tour">per pax</h6>
                </div>

                <div class="col-7">
                  <form name="package_C" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
                    <!-- First and last name row start -->
                    <div class="row">
                      <!-- First name -->
                      <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control input-sm" name="name_first" id="name_first_3" placeholder="First Name" onchange="check_field_validity(this, 'first name')" required>
                          <label for="name_first_3">First Name</label>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      
                      <!-- Last name -->
                      <div class="col-12 col-sm-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control input-sm" name="name_last" id="name_last_3" placeholder="Last Name" onchange="check_field_validity(this, 'last name')" required>
                          <label for="name_last_3">Last Name</label>
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <!-- First and last name row end -->

                    <!-- Email -->
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control input-sm" name="email" id="email_3" placeholder="Email" onchange="check_field_validity(this, 'email')" required>
                      <label for="email_3">Email</label>
                      <div class="invalid-feedback"></div>
                    </div>

                    <!-- Subject -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control input-sm" name="subject" id="subject_3" placeholder="Subject" onchange="check_field_validity(this, 'subject')" required>
                      <label for="subject_3">Subject</label>
                      <div class="invalid-feedback"></div>
                    </div>
                    
                    <!-- Message -->
                    <div class="form-floating mb-3">
                      <textarea class="form-control input-sm" name="message" id="message_3" placeholder="Message / Concerns / Requests" onchange="check_text_area_validity(this, 'message')" required></textarea>
                      <label for="message_3">Message</label>
                      <div class="invalid-feedback"></div>
                    </div>

                    <input type="hidden" name="submit" value="3">
                    <div class="book-btn-row">
                      <button type="button" class="btn btn-lg select-btn-forms" onclick="package_book_submit(3)">Book</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="response" style="display: none;">
              <div class="row">
                <div class="col">
                  <h2>Booked Successfully!</h2>
                  <p class="mb-5">See you in El Nido!</p>
                  <p class="mt-5">Please don't navigate away from this page. You will be redirected to the homepage after a few seconds.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Package C Modal End -->
      </div>
    </header>

    <section class="map-section" id="about">
      <div class="container-fluid text-center">
        <img class="map my-5" src="assets/map.jpg" alt="Map">
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
    <script src="scripts/main.js"></script>
    <script src="scripts/forms.js"></script>
  </body>
</html>