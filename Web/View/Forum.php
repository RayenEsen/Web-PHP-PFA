<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Forum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link href="css/style.css" rel="stylesheet" />
<?php session_start(); ?>
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=zVHdz22F6noZdIMigjdyqIYn0d4Y-6LPLCTC1H2kWgX_EDqDOWuZ1wEfDvYNQhB41ywEvJlq8mlntn5I18L83u0XYCVUNy_SyTfO5PtxXBc" charset="UTF-8"></script><style type="text/css">
    	body{margin-top:0px;
background:#eee;
}

.white-bg {
    background-color: #ffffff;
}
.page-heading {
    border-top: 0;
    padding: 0 10px 20px 10px;
}

.forum-post-container .media {
  margin: 10px 10px 10px 10px;
  padding: 20px 10px 20px 10px;
  border-bottom: 1px solid #f1f1f1;
}
.forum-avatar {
  float: left;
  margin-right: 20px;
  text-align: center;
  width: 110px;
}
.forum-avatar .img-circle {
  height: 48px;
  width: 48px;
}
.author-info {
  color: #676a6c;
  font-size: 11px;
  margin-top: 5px;
  text-align: center;
}
.forum-post-info {
  padding: 9px 12px 6px 12px;
  background: #f9f9f9;
  border: 1px solid #f1f1f1;
}
.media-body > .media {
  background: #f9f9f9;
  border-radius: 3px;
  border: 1px solid #f1f1f1;
}
.forum-post-container .media-body .photos {
  margin: 10px 0;
}
.forum-photo {
  max-width: 140px;
  border-radius: 3px;
}
.media-body > .media .forum-avatar {
  width: 70px;
  margin-right: 10px;
}
.media-body > .media .forum-avatar .img-circle {
  height: 38px;
  width: 38px;
}
.mid-icon {
  font-size: 66px;
}
.forum-item {
  margin: 10px 0;
  padding: 10px 0 20px;
  border-bottom: 1px solid #f1f1f1;
}
.views-number {
  font-size: 24px;
  line-height: 18px;
  font-weight: 400;
}
.forum-container,
.forum-post-container {
  padding: 30px !important;
}
.forum-item small {
  color: #999;
}
.forum-item .forum-sub-title {
  color: #999;
  margin-left: 50px;
}
.forum-title {
  margin: 15px 0 15px 0;
}
.forum-info {
  text-align: center;
}
.forum-desc {
  color: #999;
}
.forum-icon {
  float: left;
  width: 30px;
  margin-right: 20px;
  text-align: center;
}
a.forum-item-title {
  color: inherit;
  display: block;
  font-size: 18px;
  font-weight: 600;
}
a.forum-item-title:hover {
  color: inherit;
}
.forum-icon .fa {
  font-size: 30px;
  margin-top: 8px;
  color: #9b9b9b;
}
.forum-item.active .fa {
  color: #1ab394;
}
.forum-item.active a.forum-item-title {
  color: #1ab394;
}
@media (max-width: 992px) {
  .forum-info {
    margin: 15px 0 10px 0;
    /* Comment this is you want to show forum info in small devices */
    display: none;
  }
  .forum-desc {
    float: none !important;
  }
}


.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}

.message-input {
    height: 90px !important;
}
.form-control, .single-line {
    background-color: #FFFFFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
    font-size: 14px;
}
.text-navy {
    color: #1ab394;
}
.mid-icon {
    font-size: 66px !important;
}
.m-b-sm {
    margin-bottom: 10px;
}
    </style>
</head>
<body>
<?php 
require_once "../Controller/UserController.php";

// Define the categories
$categories = ['staff', 'new', 'intro', 'general', 'education', 'gaming', 'clubs', 'help'];

// Fetch the counts for all categories in a single query
$categoryCounts = [];
foreach ($categories as $category) {
    $categoryCounts[$category] = $userModel->getForums_nb2($category);
}

// Calculate the total counts
$total_forums = array_sum($categoryCounts);

// Fetch the forums and post counts for each category
$postCounts = [];
$viewCounts = [];
foreach ($categories as $category) {
    $forums = $userModel->GetForums($category,null,null);
    $SumPosts = 0;
    $SumViews = 0;
    foreach ($forums as $forum) {
        $postCounts[$forum['Forum_id']] = $userModel->GetnbPost($forum['Forum_id']);
        $viewCounts[$forum['Forum_id']] = $userModel->getViewCount($forum['Forum_id']);
        $SumPosts += $postCounts[$forum['Forum_id']];
        $SumViews += $viewCounts[$forum['Forum_id']];
    }

    // Assign the calculated sum to the corresponding variables
    ${"SumPosts_" . $category} = $SumPosts;
    ${"SumViews_" . $category} = $SumViews;
}

// Separate the categories for total count
$total_forums_general = $categoryCounts['general'];
$total_forums_intro = $categoryCounts['intro'];
$total_forums_new = $categoryCounts['new'];
$total_forums_staff = $categoryCounts['staff'];

$total_forums1=$total_forums_general + $total_forums_intro + $total_forums_new + $total_forums_staff;

$total_forums_education = $categoryCounts['education'];
$total_forums_gaming = $categoryCounts['gaming'];
$total_forums_clubs = $categoryCounts['clubs'];
$total_forums_help = $categoryCounts['help'];


$total_forums2=$total_forums_education + $total_forums_gaming + $total_forums_clubs + $total_forums_help;
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
              <a href="../View/index.php">Home</a>
              <?php if (!empty($_SESSION['user_id'])) { ?>
                  <a class="nav-link" href="../View/Profil.php">
                      <span>Profil</span>
                  </a>
                  <?php if (isset($_SESSION['user_position']) && $_SESSION['user_position'] == "Teatcher") { ?>
                      <a class="nav-link" href="../View/Dashboard.php">
                          <span>Dashboard</span>
                      </a>
                  <?php } else { ?>
                      <a class="nav-link" href="../View/Forum.php">
                          <span>Forum Page</span>
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container" style="margin-top: 50px;">
<div class="row">
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="ibox-content m-b-sm border-bottom">
<div class="p-xs">
<div class="pull-left m-r-md">
<i class="fa fa-globe text-navy mid-icon"></i>
</div>
<h2>Welcome to our forum</h2>
<span>Feel free to choose topic you're interested in.</span>
</div>
</div>
<div class="ibox-content forum-container">
<div class="forum-title">
<div class="pull-right forum-desc">
<samll>Total Topics: <?php echo $total_forums1 ?></samll>
</div>
<h3>General subjects</h3>
</div>
<div class="forum-item active">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-shield"></i>
</div>
<a href="../View/Forum_list.php?category=general" class="forum-item-title">General Discussion</a>
<div class="forum-sub-title">Talk about sports, entertainment, music, movies, your favorite color, talk about enything.</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_general ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['general']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>

<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_general ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-bolt"></i>
</div>
<a href="../View/Forum_list.php?category=intro" class="forum-item-title">Introductions</a>
<div class="forum-sub-title">New to the community? Please stop by, say hi and tell us a bit about yourself. </div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_intro ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['intro']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_intro ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item active">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-calendar"></i>
</div>
<a href="../View/Forum_list.php?category=new" class="forum-item-title">Announcements</a>
<div class="forum-sub-title">This forum features announcements from the community staff. If there is a new post in this forum, please check it out. </div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_new ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['new']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_new ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-star"></i>
</div>
<a href="../View/Forum_list.php?category=staff" class="forum-item-title">Staff Discussion</a>
<div class="forum-sub-title">This forum is for private, staff member only discussions, usually pertaining to the community itself. </div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_staff ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['staff']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_staff ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-title">
<div class="pull-right forum-desc">
<samll>Total topics: <?php echo $total_forums2 ?></samll>
</div>
<h3>Other subjects</h3>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-clock-o"></i>
</div>
<a href="../View/Forum_list.php?category=education" class="forum-item-title">Education</a>
<div class="forum-sub-title">Engage in educational discussions: learning, teaching, and academic pursuits for students, teachers, and enthusiasts alike.</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_education ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['education']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_education ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-bomb"></i>
</div>
<a href="../View/Forum_list.php?category=gaming" class="forum-item-title">Gaming</a>
<div class="forum-sub-title"> If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the . </div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_gaming ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['gaming']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_gaming?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-bookmark"></i>
</div>
<a href="../View/Forum_list.php?category=clubs" class="forum-item-title">Clubs</a>
<div class="forum-sub-title">Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_clubs ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['clubs']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_clubs ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
<div class="forum-item">
<div class="row">
<div class="col-md-9">
<div class="forum-icon">
<i class="fa fa-ambulance"></i>
</div>
<a href="../View/Forum_list.php?category=help" class="forum-item-title">Technical Help</a>
<div class="forum-sub-title">Internet tend to repeat predefined chunks as necessary, making this the</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumViews_help ?>
</span>
<div>
<small>Views</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $categoryCounts['help']; ?>
</span>
<div>
<small>Topics</small>
</div>
</div>
<div class="col-md-1 forum-info">
<span class="views-number">
<?php echo $SumPosts_help ?>
</span>
<div>
<small>Posts</small>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
    <section class="info_section layout_padding" style="margin-top: 80px;">
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
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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