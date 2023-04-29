<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link href="css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="css/Chat.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=LFo8MHxyp-TifT0xHA4Ijk8MNlH29LdLQHrU1YdRjr1-vTLNRwpXvPvrkKRJ0wYDy5xF9Ia29aBB5BxBepzNQm-fIgML7-PKAGu04mEaTMA" charset="UTF-8"></script>
</head>
<body>
<?php
    session_start()
?>
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
                  <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="http://localhost/Web/View/Profil.php">
                  <span>Profil</span>
                  </a>
                  <?php } else { ?>
                  <a class="nav-link" href="http://localhost/Web/View/Login.php">
                  <span>Login</span>
                  </a>
                  <?php } ?>
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
</div>
<div class="container" style="padding-top : 20px">

<div class="page-title">
<div class="row gutters">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
<h5 class="title">Chat App</h5>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> </div>
</div>
</div>


<div class="content-wrapper">

<div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="card m-0">

<div class="row no-gutters">
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
<div class="users-container">
<div class="chat-search-box">
<form action="../Controller/UserController.php" method="post">
  <div class="input-group">
    <input class="form-control" type="text" placeholder="Search" name="FIRST">
    <div class="input-group-btn">
      <button type="submit" class="btn btn-info" name="search2">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</form>
</div>
<ul class="users">
  <?php
  require_once '../Controller/UserController.php';
  $users = $userModel->getUsers();
  foreach ($users as $user) {
    ?>
    <li class="person" onclick="submitForm('<?php echo $user['FIRST']; ?>')">
      <div class="user">
        <img src="images/User.png" alt="Retail Admin">
        <span class="status <?php echo $user['STATUS']; ?>"></span>
      </div>
      <p class="name-time">
        <span class="name"><?php echo $user['FIRST']; ?></span>
        <span class="time"><?php echo $user['POSITION']; ?></span>
      </p>
      <form id="profileForm_<?php echo $user['FIRST']; ?>" action="../Controller/UserController.php" method="post">
        <input type="hidden" name="FIRST" value="<?php echo $user['FIRST']; ?>">
        <input type="hidden" name="search3">
      </form>
    </li>
    <?php
  }
  ?>
</ul>

<script>
// I added this script to make all the <li> place clickable 
function submitForm(id) {
  document.getElementById("profileForm_"+id).submit();
}
</script>

</div>
</div>
<div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
<div class="selected-user">
<span>Esen: <span class="name">Group Chat</span></span>
</div>
<div class="chat-container">
<ul class="chat-box chatContainerScroll">
<?php
require_once '../Controller/UserController.php';
foreach ($messages as $message) {
    $id = $message['sender'];
    $name = $userModel->getName($id); 
    if ($message['sender'] == $_SESSION['user_id']) {
?>
        <li class="chat-right">
            <div class="chat-hour"><?= date("H:i", strtotime($message['Message_timestamp'])) ?> <span class="fa fa-check-circle"></span></div>
            <div class="chat-text"><?= $message['message'] ?></div>
            <div class="chat-avatar">
                <img src="images/User.png" alt="Retail Admin">
                <div class="chat-name"><?= $_SESSION['user_name'] ?></div>
            </div>
        </li>
<?php
    } else {
        // Message does not belong to session, show on the left
?>
        <li class="chat-left">
            <div class="chat-avatar">
                <img src="images/User.png" alt="Retail Admin">
                <div class="chat-name"><?= $name['FIRST'] ?></div> <!-- use the $name variable here -->
            </div>
            <div class="chat-text"><?= $message['message'] ?></div>
            <div class="chat-hour"><?= date("H:i", strtotime($message['Message_timestamp'])) ?> <span class="fa fa-check-circle"></span></div>
        </li>
<?php
    }
}
?>


</ul>
<form action="../Controller/UserController.php" method="post">
  <div class="form-group mt-3 mb-0">
    <textarea class="form-control" rows="3" name="message" placeholder="Type your message here..."></textarea>
  </div>
  <div class="form-group mt-3 mb-0">
    <button type="submit" class="btn btn-primary" name="send">Send</button>
  </div>
</form>


</div>
</div>
</div>

</div>
</div>
</div>

</div>

</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
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