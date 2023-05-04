
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>Register</title>
    <!-- Calling css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/Login2.css">
  </head>
  <body>
    
    <div class="hero_area">
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="http://localhost/web/View/index.php">
              <span>
                ESEN
              </span>
            </a>

            <div class="navbar-collapse" id="">
              <div
                class="d-none d-lg-flex ml-auto flex-column flex-lg-row align-items-center mt-3">
                <form class="form-inline mb-3 mb-lg-0 ">
                  <button
                    class="btn  my-sm-0 nav_search-btn"
                    type="submit"></button>
                </form>
                <ul class="navbar-nav  mr-5">
                  <li class="nav-item mr-5">
                    <a class="nav-link" href="http://localhost/Web/View/Login.php">
                      <span>Login</span>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="custom_menu-btn">
                <button onclick="openNav()">
                  <span class="s-1"> </span>
                  <span class="s-2"> </span>
                  <span class="s-3"> </span>
                </button>
              </div>
              <div id="myNav" class="overlay">
              <div class="overlay-content">
              <a href="http://localhost/web/View/index.php">Home</a>
              <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="../View/Profil.php">
                      <span>Profil</span>
                  </a>
                  <?php if (isset($_SESSION['user_position']) && $_SESSION['user_position'] == "Teatcher") { ?>
                      <a class="nav-link" href="../View/Dashboard.php">
                          <span>Dashboard</span>
                      </a>
                  <?php } else { ?>
                      <a class="nav-link" href="">
                          <span>Calculator</span>
                      </a>
                  <?php } ?>
                  <a class="nav-link" href="../View/Chat.php">
                      <span>Chat</span>
                  </a>
              <?php } else { ?>
                  <a class="nav-link" href="../View/Login.php">
                      <span>Login</span>
                  </a>
              <?php } ?>
              </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <div class="main" style="padding: 2%;">
      <section class="sign-in">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" class="register-form" action="/Web/Controller/UserController.php">
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email"/>
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <label for="id"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="number" name="id" id="id" placeholder="Cin"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                <a href="http://localhost/Web/View/Login.php" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>

        <section class="container-fluid footer_section">
      <p>
        &copy; 2023 All Rights Reserved.
        <a>ESEN, We Invest in Intelligence</a>
      </p>
    </section>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script>
      function openNav() {
        document.getElementById("myNav").classList.toggle("menu_width");
        document
          .querySelector(".custom_menu-btn")
          .classList.toggle("menu_btn-style");
      }
    </script>
    </div>
    </div>
  </body>
</html>
    
