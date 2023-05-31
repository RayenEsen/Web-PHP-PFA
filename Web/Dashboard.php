<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Dachboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/Dashboard.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=Jev1Qv7GS7dnI9oZ2TwZRoTpkTVa6MBM_vLqRT03Pm5qGy7ZFQPtJymjpyiG2Xtfxg0ES7Tb0O9YDYbG9SNLoW512MPVz_9v42k0NZp229M" charset="UTF-8"></script>
</head>
<body style="margin-top: -5px; background-color: #eee;">
<?php
    session_start();
    require_once '../Controller/UserController.php';
?>
  <div class="hero_area">
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="../View/index.php">
            <span>
              ESEN
            </span>
          </a>

          <div class="navbar-collapse" id="">
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
            <div class="overlay-content">
            <a href="../View/index.php">Home</a>
              <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="../View/Profil.php">
                      <span>Profil</span>
                  </a>
                  <?php if ($verif==true) { ?>
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
          </div>
        </nav>
      </div>
    </header>
  </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<div class="container" style="padding-top: 50px;">
<div class="row align-items-center">
<div class="col-md-6">
<div class="mb-4">
<h5 class="card-title">Students List <span class="text-muted fw-normal ms-2">(<?php echo $nb ?>)</span></h5>
</div>
</div>

</div>

<div class="row">
<?php
  $users = $userModel->getUsers();
  foreach ($users as $user) {
    if ($verif!=true)
    {
?>
<div class="col-xl-3 col-sm-6">
  <div class="card">
    <div class="card-body">
      <div class="dropdown float-end">
        <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"><i class="bx bx-dots-horizontal-rounded"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
        <form method="post" action="../Controller/UserController.php">
        <input type="hidden" name="ID" value="<?php echo $user['ID']; ?>">
        <button type="submit" class="dropdown-item" name="Delete_User">Remove</button>
        </form>
        </div>
      </div>
      <div>
        <div class="d-flex align-items-center">
          <div>      
          <?php
          if (isset($user['PFP']))
          {
          // If the user has a profile picture
          ?>
          <img src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>"  alt="User Image" class="avatar-md rounded-circle img-thumbnail" />
          <?php
          }
          else
          {
          // If the user doesn't have a profile picture, display the default image
          ?>
          <img src="../View/images/User.png"  alt="User Image" class="avatar-md rounded-circle img-thumbnail" >
          <?php
          }
          ?>
          </div>
          <div class="flex-1 ms-3">
            <h5 class="font-size-16 mb-1"><a href="#" class="text-dark"><?php echo $user['FIRST']; ?></a></h5>
            <span class="badge badge-soft-success mb-0"><?php echo $user['POSITION']; ?></span>
          </div>
        </div>
        <div class="mt-3 pt-1">
          <p class="text-muted mb-0"><i class="mdi mdi-phone font-size-15 align-middle pe-2 text-primary"></i><?php echo $user['PHONE']; ?></p>
          <p class="text-muted mb-0 mt-2"><i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i><?php echo $user['EMAIL']; ?></p>
          <p class="text-muted mb-0 mt-2"><i class="mdi mdi-google-maps font-size-15 align-middle pe-2 text-primary"></i><?php echo $user['BIRTHDAY']; ?></p>
        </div>
        <div class="d-flex gap-4 pt-4" style="margin-left: 50px;">
        <form method="POST" action="../Controller/UserController.php">
        <input type="hidden" name="FIRST" value="<?php echo $user['FIRST']; ?>">
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-soft-primary btn-sm " name="search4"><i class="bx bx-user me-1"></i> Profile</button>
        </div>
       </form>
          <button type="button" class="btn btn-primary btn-sm w-50"><i class="bx bx-message-square-dots me-1"></i> Contact</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  }
}
?>

</div>



<div class="row g-0 align-items-center pb-4" style="padding-top: 30px;">
<div class="col-sm-6">
<div><p class="mb-sm-0">ESEN , We Invest in Intelligence</p></div>
</div>
<div class="col-sm-6">
<div class="float-sm-end">
<ul class="pagination mb-sm-0">
<li class="page-item disabled">
<a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
</li>
<li class="page-item active"><a href="#" class="page-link">1</a></li>
<li class="page-item"><a href="#" class="page-link">2</a></li>
<li class="page-item"><a href="#" class="page-link">3</a></li>
<li class="page-item"><a href="#" class="page-link">4</a></li>
<li class="page-item"><a href="#" class="page-link">5</a></li>
<li class="page-item">
<a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
</li>
</ul>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
      function openNav() {
        document.getElementById("myNav").classList.toggle("menu_width");
        document
          .querySelector(".custom_menu-btn")
          .classList.toggle("menu_btn-style");
      }
    </script>
</body>
</html>