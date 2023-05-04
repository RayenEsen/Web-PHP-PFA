
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Esen_Chat</title>
    <link rel="stylesheet" href="css/Profil.css">
  </head>
<body>
<?php
require_once '../Controller/UserController.php';
$FIRST = $_GET['FIRST'];
$user = $userModel->getUserBy_Id_Name(null,$FIRST);
?>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark"  id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="http://localhost/web/View/index.php">ESEN Manouba</a>
          <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="/Web/Controller/UserController.php" method="post">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text" name="FIRST">
              <button type="submit" name="search" style="background-color: transparent; border: none;"><img src="images/search-icon.png"></button>
            </div>
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>" width="200" height="40">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"></span>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(images/esen.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
          <h1 class="display-2 text-white"><?php echo $user['FIRST']; ?></h1>
            <p class="text-white mt-0 mb-5"></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
          <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
                <img id="user-image" src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>" class="rounded-circle" width="200" height="200">
                <br>
                <br>
                <br>
                <br>
                <br>
                <style>
                  .custom-file input[type="file"] {
                    position: absolute;
                    left: -9999px;
                  }
                  .custom-file .btn {
                    margin-right: -20px;
                  } 
                  .rounded-circle {
                    object-fit: cover;
                  }
                </style>
                <br>

              </a>
            </div>
          </div>
        </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="text-center">

                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Student - <?php echo $user['FIRST']; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Esen Manouba
                </div>
                <hr class="my-4">
                <p><?php echo $user['ABOUT'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="/Web/Controller/UserController.php">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" readonly name ="username" placeholder="Username" value="<?php echo $user['FIRST'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="email" value="" class="form-control form-control-alternative" readonly name="email" placeholder="<?php echo $user['EMAIL']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Position</label>
                        <input name="position" type="text" id="input-first-name" readonly class="form-control form-control-alternative" placeholder="Student" value="<?php echo $user['POSITION'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Gender</label>
                        <input name="gender" type="text" id="input-last-name" readonly class="form-control form-control-alternative" placeholder="Gender" value="<?php echo $user['GENDER'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Phone Number</label>
                        <input name="phone" id="input-address" readonly class="form-control form-control-alternative" placeholder="Phone" value="<?php echo $user['PHONE'] ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">Birthdate</label>
                        <input name="birthdate" type="text" readonly id="input-city" class="form-control form-control-alternative" placeholder="Birthdate" value="<?php echo $user['BIRTHDAY'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">ID</label>
                        <input name="id" type="text" id="input-country" readonly value="" class="form-control form-control-alternative" placeholder="********">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <textarea name="about" rows="4" class="form-control form-control-alternative" readonly placeholder="A few words about you ..."><?php echo $user['ABOUT'] ?></textarea>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
          <p>ESEN, We Invest in Intelligence</p>
        </div>
      </div>
    </div>
  </footer>
</body>