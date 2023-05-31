<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Forum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php 
session_start();
?>
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=a6Z9rNbr3lvhnsyUcQOAUJ_nLElnfp-kqDsuymKcUw2nrnjLRsm8xjhR8tGX_17YfjPZBxWwcLpf8zfparwF26DRUCwyCIHyYNuWTrDbdXg" charset="UTF-8"></script>

<style type="text/css">
    	body{margin-top:0px;}
/* Add a hover effect to the post container */
.post:hover {
  background-color: #f0f0f0;
  transition: background-color 0.3s ease;
}

/* Add a hover effect to the user image */
.user-image:hover {
  transform: scale(1.05);
  transition: transform 0.3s ease;
}

/* Add a hover effect to the username */
.username:hover {
  text-decoration: underline;
}

/* Add a hover effect to the share button */
.btn-download:hover {
  background-color: #269abc;
  color: #fff;
}

/* Add animation to the share button */
.btn-download {
  transition: background-color 0.3s ease, color 0.3s ease;
}

/* Add a professional font to the post description */
.post .description {
  font-family: "Arial", sans-serif;
}

/* Add a professional font to the share button */
.btn-download {
  font-family: "Arial", sans-serif;
}

/* Add a subtle box-shadow to the panel */
.panel {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Update the form input and button styles */
.form-control {
  border-radius: 4px;
  border: 1px solid #ddd;
  font-family: "Arial", sans-serif;
}

.btn-primary {
  border-radius: 4px;
  background-color: #269abc;
  color: #fff;
  font-family: "Arial", sans-serif;
}

.btn-primary:hover {
  background-color: #1084FF;
}

.add-tooltip:hover {
  color: #1084FF;
}

.post-list {
  position: relative;
  padding: 5px 0;
}

.post-list .picture {
  max-width: 400px;
  overflow: hidden;
  height: auto;
  border-radius: 6px;
}

.post-list .label{
    font-weight:normal;    
}

.post-list .picture {
  max-width: 210px;
}

.post-list .picture img {
  width: 100%;
}

.post-list h4 {
  font-size: 20px;
}

.post-list h5 {
  color: #888;
}

.post-list p {
  float: left;
}

.post-list:after {
  height: 1px;
  background: #EEEEEE;
  width: 83.3333%;
  bottom: 0;
  right: 0;
  content: "";
  display: block;
  position: absolute;
}

.post-list .btn-download {
  margin-top: 45px;
}

.btn-info {
  color: #1084FF;
  border-color: #269abc;
}

.btn-round {
  border-width: 1px;
  border-radius: 30px !important;
  opacity: 0.79;
  padding: 9px 18px;
}
.btn {
  border-width: 2px;
  background-color: rgba(0,0,0,0);
  font-weight: 400;
  opacity: 0.8;
  padding: 7px 16px;
}
.panel {
    box-shadow: 0 2px 0 rgba(0,0,0,0.075);
    border-radius: 0;
    border: 0;
    margin-bottom: 15px;
}

.panel .panel-footer, .panel>:last-child {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.panel .panel-heading, .panel>:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.panel-body {
    padding: 25px 20px;
}
.btn-trans {
    background-color: transparent;
    border-color: transparent;
    color: #929292;
}

.btn-icon {
    padding-left: 9px;
    padding-right: 9px;
}

.btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
    padding: 5px 10px !important;
}
.post {
    background-color: #f5f5f5;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.post .user-image {
    height: 170px;
}

.post h4 {
    margin-bottom: 10px;
}

.post .label-info {
    background-color: #5bc0de;
    color: #fff;
    font-size: 12px;
    padding: 3px 6px;
    border-radius: 3px;
    margin-left: 5px;
}

.post h5 {
    font-size: 14px;
    color: #888;
    margin-bottom: 5px;
}

.post .description {
    font-size: 16px;
    margin-top: 10px;
}

.post a.btn-download {
    padding: 8px 15px;
    border-radius: 20px;
    background-color: #5bc0de;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
}

    </style>
</head>
<body>
<link href="css/style.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<?php 
require_once "UserController.php";
$forum_id = $_GET['ID'];
$forum = $userModel->getForum($forum_id);
$posts = $userModel->GetPost($forum_id);
?>
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<div class="hero_area" style="margin-bottom: 70px;">
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
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
                    <a class="nav-link" href="Profil.php">
                  <span>Profil</span>
                  </a>
                  <?php } else { ?>
                    <a class="nav-link" href="Login.php">
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
              <a href="index.php">Home</a>
              <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="Profil.php">
                      <span>Profil</span>
                  </a>
                  <?php if ($verif==true) { ?>
                      <a class="nav-link" href="Dashboard.php">
                          <span>Dashboard</span>
                      </a>
                  <?php } else { ?>
                      <a class="nav-link" href="Forum.php">
                          <span>Forum Page</span>
                      </a>
                  <?php } ?>
                  <a class="nav-link" href="Chat.php">
                      <span>Chat</span>
                  </a>
              <?php } else { ?>
                  <a class="nav-link" href="Login.php">
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

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
<div class="row">


<div class="post-list">

<?php
$i = 0;
foreach ($posts as $post) {
    $i++;
    $user = $userModel->getPerson_byID2($post['poster_id']);
    $nb_upvotes = $userModel->SumUpvotes($forum_id)
    ?>
    <div class="row post" style="padding-bottom: 50px;">
        <div class="col-sm-2">
            <div class="picture">
                <?php
                if (isset($user['PFP'])) {
                    // If the user has a profile picture
                    ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['PFP']); ?>" alt="User Image" class="user-image">
                    <?php
                } else {
                    // If the user doesn't have a profile picture, display the default image
                    ?>
                    <img alt="Default User Image" src="images/User.png" class="user-image">
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>
            <form id="userForm_<?php echo $user['FIRST']; ?>" action="UserController.php" method="post" style="display: inline;">
              <input type="hidden" name="FIRST" value="<?php echo $user['FIRST'] ?>">
              <a href="#" class="username" onclick="submitForm('<?php echo $user['FIRST'] ?>')"><?php echo $user['FIRST'] ?></a>
              <input type="hidden" name="search5">
            </form>

            <script>
              function submitForm(id) {
                document.getElementById("userForm_"+id).submit();
              }
            </script>
                <label class="label label-info">#<?php echo $forum['tags'] ?></label>
            </h4>
            <h5>
                <i class="fa fa-calendar"></i>
                <?php echo date("M d, H:i", strtotime($post['timestamp'])); ?>
            </h5>
            <p class="description"><?php echo $post['content']; ?></p>
        </div>
<div class="col-sm-4" data-no-turbolink>
    <?php if ($i == 1) { ?>
        <a class="btn btn-info btn-download btn-round pull-right makeLoading" href="UserController.php?upvote_id=<?php echo $forum_id; ?>">
            <i class="fa fa-arrow-up"></i> <?php echo $nb_upvotes ?> Upvote
        </a>
    <?php } else { ?>
        <a class="btn btn-info btn-download btn-round pull-right makeLoading" href="#">
            <i class="fa fa-arrow-up"></i>
        </a>
    <?php } ?>
</div>

    </div>
    <?php
}
?>

<div class="panel" style="margin-top: 20px;">
    <div class="panel-body">
        <form action="UserController.php" method="post"> 
            <textarea class="form-control" name="message" rows="2" placeholder="What are you thinking?"></textarea>
            <input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>"> <!-- Add a hidden input field to hold the forum_id value -->
            <div class="mar-top clearfix" style="margin-top: 6px;">
                <button class="btn-sm btn-primary pull-right" type="submit" name="post"><i class="fa fa-pencil fa-fw"></i> Share</button>
                <a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#"></a>
                <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#"></a>
                <a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#"></a>
            </div>
        </form>
    </div>
</div>


</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>

<section class="info_section layout_padding" style="margin-top: 60px;">
      <div class="container info_content">
        <div>
          <div class="row">
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Contact
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.google.com/maps/place/ESEN+Manouba/@36.8078603,10.0714706,17z/data=!4m5!3m4!1s0x12fd2d8cf72265cb:0x7fc41ab7e1b5bd62!8m2!3d36.8075155!4d10.0731547?hl=en-US">
                      Adresse
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Email
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Tél
                    </a>
                  </li>
                  <li>
                    <a href="">
                       Fax
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/">
                      Site
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="">
                      Manouba CP 2010 
                    </a>
                  </li>
                  <li>
                    <a href="">
                      contact@esen.tn 
                    </a>
                  </li>
                  <li>
                    <a href="">
                      +216 70 526 343
                    </a>
                  </li>
                  <li>
                    <a href="">
                      +216 70 526 385
                    </a>
                  </li>
                  <li>
                    <a href="">
                      https://www.esen.tn/portail/
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Nos Clubs
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.esen.tn/portail/club/apollo-esen-7.html">
                      Appolo Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/aspire-esen-6.html">
                      Aspire Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/elite-council-esen-entourage-12.html">
                      Elite Council 
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/enactus-esen-2.html">
                      Enactus Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/esen-android-club-1.html">
                      Esen Android
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="https://www.esen.tn/portail/club/esen-hive-club-11.html">
                      Esen Hive
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/joker-esen-3.html">
                      Joker Esen
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club/startup-nation-esen-5.html">
                      Esen Startup Nation
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Esen Microsoft
                    </a>
                  </li>
                  <li>
                    <a href="">
                      Club Sportif
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="d-flex">
                <h5>
                  Liens Rapides
                </h5>
              </div>
              <div class="d-flex ">
                <ul>
                  <li>
                    <a href="https://www.esen.tn/ePFE/">
                      Accès ePFE
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/reglement-interne-54.html">
                      Bibliothèque
                    </a>
                  </li>
                  <li>
                    <a href="http://www.biruni.tn/cgi-bin/gw_2009_4_3/chameleon?lng=fr&inst=77">
                      Biruni
                    </a>
                  </li>
                  <li>
                    <a href="https://www.google.com/maps/place/ESEN+Manouba/@36.8078603,10.0714706,17z/data=!4m5!3m4!1s0x12fd2d8cf72265cb:0x7fc41ab7e1b5bd62!8m2!3d36.8075155!4d10.0731547?hl=en-US">
                      Géolocalisation
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/club-events.html">
                      Activités des clubs
                    </a>
                  </li>
                </ul>
                <ul class="ml-3 ml-md-5">
                  <li>
                    <a href="https://www.esen.tn/portail/page/partenariats-6.html">
                      Partenariat
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/homepage.html">
                      Enseignants
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/notre-equipe-9.html">
                      Notre équipe
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/guide-lmd-de-letudiant-51.html">
                      Guide LMD
                    </a>
                  </li>
                  <li>
                    <a href="https://www.esen.tn/portail/page/documents-de-scolarite-77.html">
                      Documents de scolarité
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-lg-row justify-content-between align-items-center align-items-lg-baseline>
          <div class="social-box">
            <a href="https://www.facebook.com/esenien">
              <img src="images/fb.png" alt="" />
            </a>

            <a href="https://twitter.com/ESEN66569607">
              <img src="images/twitter.png" alt="" />
            </a>
            <a href="https://tn.linkedin.com/school/esenien/">
              <img src="images/linkedin1.png" alt="" />
            </a>
            <a href="https://www.youtube.com/@esen-ecolesuperieuredecono6485">
              <img src="images/instagram1.png" alt="" />
            </a>
          </div>
          <div class="form_container mt-5">
            <form action="">
              <label for="subscribeMail">
                FEEDBACK
              </label>
              <input
                type="email"
                placeholder="Give us your feedback"
                id="subscribeMail"
              />
              <button type="submit">
                Send
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
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