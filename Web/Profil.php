<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Profile</title>
    <link rel="stylesheet" href="css/Profil.css">
  </head>
<body>
  <?php
    session_start();
    require_once "UserController.php";
    $user = $userModel->getUserBy_Id_Name($_SESSION['user_id'],$_SESSION['user_name']); 
  ?>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark"  id="navbar-main">
      <div class="container-fluid">
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.php">ESEN Manouba</a>
          <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="UserController.php" method="post">
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
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <?php if (isset($user['PFP'])) { ?>
                <img id="user-image-2" alt="Default profile picture" src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>" width="200" height="40">
                <?php } else { ?>
                    <img id="user-image-2" alt="Default profile picture" src="images/User.png" width="200" height="40">
                <?php } ?>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['user_name'] ?></span>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
<form method="post" action="UserController.php" enctype="multipart/form-data">   
 <!-- Clickable place for background image -->
 <?php if (isset($user['BACKGROUND_IMAGE'])) { ?>
  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url('data:image/jpeg;base64, <?php echo base64_encode($user['BACKGROUND_IMAGE']); ?>'); background-size: cover; background-position: center top;">
<?php } else { ?>
  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(images/esen.jpg); background-size: cover; background-position: center top;">
<?php } ?>
  <span class="mask bg-gradient-default opacity-8"></span>
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Hello <?php echo $_SESSION['user_name'] ?></h1>
        <p class="text-white mt-0 mb-5">Personalize your profile page to match your preferences and reflect your unique style. This will allow you to professionally represent yourself.</p>
      </div>
    </div>
  </div>
</div>
<!-- Hidden file input -->
<input type="file" id="upload-input" style="display: none;" name="backgroundUpload">

<script>
  document.querySelector('.header').addEventListener('click', function() {
    document.getElementById('upload-input').click();
  });

  document.getElementById('upload-input').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
      var backgroundImage = e.target.result;
      document.querySelector('.header').style.backgroundImage = 'url(' + backgroundImage + ')';
    };

    reader.readAsDataURL(file);
  });
</script>
<!-- End of Clickable place for background image -->


    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
          <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
              <?php if (isset($user['PFP'])) { ?>
              <img id="user-image-1" src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>" class="rounded-circle" width="200" height="200">
              <?php } else { ?>
                  <img id="user-image-1" src="images/User.png" class="rounded-circle" width="200" height="200">
              <?php } ?>  
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
                <div class="custom-file" style="float: right;">
                    <input type="file" class="btn btn-info" id="imageUpload" name="imageUpload" aria-describedby="inputGroupFileAddon">
                    <label class="btn btn-info" for="imageUpload">Choose file</label>
                </div>
              </a>
            </div>
          </div>
        </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="text-center">

                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Student - <?php echo $_SESSION['user_name'] ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Esen Manouba
                </div>
                <hr class="my-4">
                <p><?php echo $_SESSION['user_about'] ?></p>
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
                <div style="margin-left: 90%; margin-top :-8%">
                <style>
                select {
                  font-size: 1rem;
                  padding: 0.5rem;
                  border: 2px solid #ccc;
                  border-radius: 4px;
                  appearance: none;
                }
              </style>
              <select id="status" name="status">
                <option value="online" <?php echo $_SESSION['user_status'] == 'online' ? 'selected' : '' ?>>Online</option>
                <option value="offline" <?php echo $_SESSION['user_status'] == 'offline' ? 'selected' : '' ?>>Offline</option>
                <option value="busy" <?php echo $_SESSION['user_status'] == 'busy' ? 'selected' : '' ?>>Busy</option>
                <option value="away" <?php echo $_SESSION['user_status'] == 'away' ? 'selected' : '' ?>>Away</option>
              </select>
                </div>
                <h6 class="heading-small text-muted mb-4" style="padding-top: 40px;">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" name ="username" placeholder="Username" value="<?php echo $_SESSION['user_name'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="email" value="<?php echo $_SESSION['user_email'] ?>" class="form-control form-control-alternative" name="email" placeholder="<?php echo $_SESSION['user_email'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Position</label>
                        <input name="position" type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Student" value="<?php echo $_SESSION['user_position'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Gender</label>
                        <input name="gender" type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Gender" value="<?php echo $_SESSION['user_gender'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4" >Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Phone Number</label>
                        <input name="phone" id="input-address" class="form-control form-control-alternative" placeholder="Phone" value="<?php echo $_SESSION['user_phone'] ?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">Birthdate</label>
                        <input name="birthdate" type="text" id="input-city" class="form-control form-control-alternative" placeholder="Birthdate" value="<?php echo $_SESSION['user_date'] ?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">ID</label>
                        <input name="id" type="text" id="input-country" readonly value="<?php echo $_SESSION['user_id'] ?>" class="form-control form-control-alternative" placeholder="Cin" value="<?php echo $_SESSION['user_id'] ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    <label>About Me</label>
                    <textarea name="about" rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..."><?php echo $_SESSION['user_about'] ?></textarea>
                  </div>
                  <button type="submit" name="edit" class="btn btn-info">Edit Profile</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById("imageUpload").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("user-image-1").src = e.target.result;
            document.getElementById("user-image-2").src = e.target.result;
        };

        reader.readAsDataURL(this.files[0]);
    };

    document.getElementById("profile-picture-form").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent the form from submitting
        // Handle the file upload using AJAX or submit the form to UserController.php
    });
</script>

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