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
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    <!--Main CSS-->
    <link rel="stylesheet" href="styles/main.css">

    <title>ParaEase'O</title>

</head>
<body class="body-packages">
  <?php include 'inc/header.php'?>
      <header class="masthead-packages">
          <div class="container-fluid text-center d-flex justify-content-center">
          
            <div class="row justify-content-center ">
                <div>
                </div>
                <div class="col-4 box card py-5 mx-5 my-2" style="width: 12rem; height: auto;">
                    <div class=" card-body py-5 align-items-center">
                        <h2>Tour A</h2>
                        <h1>₱ 1,200</h1>
                        <p>per pax</p>
                        <a href="#">
                        <button type="button" class="btn-lg btn select-btn px-3 py-1" id="button">SELECT PACKAGE</button>
                        </a>                
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
                    </div>
                </div>
            </div>

            <!---modal section-->
            <div class="bg-modal">
              <div class="modal-content">

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
                    <form name="myForm" onsubmit="return validateForm()" method="post" >
                      <div class="row">
                        <div class="col">
                          <input type="text" name="fname" placeholder="First Name">
                        </div>
                        <div class="col">
                          <input type="text" name="lname" placeholder="Last Name">
                        </div>
                      </div>

                          <input type="text" name="email" placeholder="Email / Contact Number">
                          <input type="text" name="subject" placeholder="Subject">
                          <br>
                          <textarea placeholder="Message / Concerns / Requests" class="textarea-forms" name="message" id="message"></textarea>
                      
                      <div class="container container-bg">
                      <div class="row">
                        <p class="p-forms text-start">BREAKDOWN OF EXPENSES</p>
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-end">Total: PHP 1200.00</p></div>
                      </div>  
                      </div>
                      <a href="#">
                        <button type="submit" class="btn-lg btn select-btn-forms px-3 py-1" style="float: right;" value="Submit">Book</button>
                      </a>
                    </form>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- end of modal -->

            <!---modal section-->
            <div class="bg-modal-2">
              <div class="modal-content">

                <div class="close-2">+</div>
                <h1 class="h1-forms">Ready to Explore?</h1>
                <hr class="hr-forms">
                <div class="row">
                  <div class="col-4 text-center">
                    <h1 class="h1-tour">Tour B</h1>
                    <h2 class="h2-tour">₱ 1,200<h2>
                    <h6 class="h6-tour">per pax</h6>
                  </div>
                  <div class="col-7">
                    <form name="myForm" onsubmit="return validateForm()" method="post">
                      <div class="row">
                        <div class="col">
                          <input type="text" name="fname" placeholder="First Name">
                        </div>
                        <div class="col">
                          <input type="text" name="lname" placeholder="Last Name">
                        </div>
                      </div>

                          <input type="text" name="email" placeholder="Email / Contact Number">
                          <input type="text" name="subject" placeholder="Subject">
                          <br>
                          <textarea placeholder="Message / Concerns / Requests" class="textarea-forms" name="message" id="message"></textarea>
                      
                      <div class="container container-bg">
                      <div class="row">
                        <p class="p-forms text-start">BREAKDOWN OF EXPENSES</p>
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-end">Total: PHP 1200.00</p></div>
                      </div>  
                      </div>
                      <a href="#">
                        <button type="submit" class="btn-lg btn select-btn-forms px-3 py-1" style="float: right;" value="Submit">Book</button>
                      </a>
                    </form>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- end of modal -->

            <!---modal section-->
            <div class="bg-modal-3">
              <div class="modal-content">

                <div class="close-3">+</div>
                <h1 class="h1-forms">Ready to Explore?</h1>
                <hr class="hr-forms">
                <div class="row">
                  <div class="col-4 text-center">
                    <h1 class="h1-tour">Tour C</h1>
                    <h2 class="h2-tour">₱ 1,200<h2>
                    <h6 class="h6-tour">per pax</h6>
                  </div>
                  <div class="col-7">
                    <form name="myForm" onsubmit="return validateForm()" method="post">
                      <div class="row">
                        <div class="col">
                          <input type="text" name="fname" placeholder="First Name">
                        </div>
                        <div class="col">
                          <input type="text" name="lname" placeholder="Last Name">
                        </div>
                      </div>

                          <input type="text" name="email" placeholder="Email / Contact Number">
                          <input type="text" name="subject" placeholder="Subject">
                          <br>
                          <textarea placeholder="Message / Concerns / Requests" class="textarea-forms" name="message" id="message"></textarea>
                      
                      <div class="container container-bg">
                      <div class="row">
                        <p class="p-forms text-start">BREAKDOWN OF EXPENSES</p>
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-start">Package Inclusions </p></div>
                        <div class="col"><p class="p-forms text-end">PHP 600.00</p></div>
                      </div>
                      <div class="row">
                        <div class="col"><p class="p-forms text-end">Total: PHP 1200.00</p></div>
                      </div>  
                      </div>
                      <a href="#">
                        <button type="submit" class="btn-lg btn select-btn-forms px-3 py-1" style="float: right;" value="Submit">Book</button>
                      </a>
                    </form>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- end of modal -->

          </div>
        </div>
      </header>
      
      <section class="map-section" id="about">
        <div class="container-fluid text-center">
            <img class="map my-5" src="assets/map.jpg" alt="Map">

        </div>
      
    </section>
  <!--Bootstrap JS bundle-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="scripts/main.js"></script>
</body>
</html>

<!--  <div class="row">
          <div class="col-6 border">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241609.576289215!2d119.45416559033447!3d11.192972260553368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b65515ef5c9e0f%3A0xfc4e665b599b0455!2sEl%20Nido%2C%20Palawan!5e0!3m2!1sen!2sph!4v1668441207367!5m2!1sen!2sph" width="680" height="680" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="col-6 text-center pt-5">
            <h1 class=""> Welcome to El Nido!</h1>
              <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse repellendus est, debitis cumque dicta maiores non minima aspernatur pariatur, maxime quam, ut sit nisi reprehenderit fuga. At veritatis nisi magnam? lorem Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi cupiditate, possimus dicta illo veniam quis unde eos adipisci perspiciatis, et architecto quas eius expedita excepturi porro, officiis accusamus consequuntur consequatur. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia veniam necessitatibus sit deleniti aliquid consequuntur suscipit dolore natus nesciunt voluptates, expedita itaque eveniet quia nemo? Distinctio excepturi ratione voluptatem repudiandae?</p>
            </div>
          </div> -->