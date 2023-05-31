<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Forum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet"/>
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=uYDfkmLyG2CKLCXdqIS5lcmiGw40H0wBRJQkR2El5RS2Ht97jLiCs-Jq7wijkZW026RTW4YfFpp7enBNBtEIxD9vi2O5q9RWkdfXOMtbcHQ" charset="UTF-8"></script><style type="text/css">
    	body{
    margin-top:0px;
    background:#eee;
    color: #708090;
}
.icon-1x {
    font-size: 24px !important;
}
a{
    text-decoration:none;    
}
.text-primary, a.text-primary:focus, a.text-primary:hover {
    color: #00ADBB!important;
}
.text-black, .text-hover-black:hover {
    color: #000 !important;
}
.font-weight-bold {
    font-weight: 700 !important;
}
    </style>
</head>
<body>
<?php 
session_start();
require_once "UserController.php";
?>
<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<div class="hero_area" style="margin-bottom: 40px;">
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
<div class="container">
<div class="row">

<div class="col-lg-9 mb-3">
<div class="row text-left mb-5">
  <div class="col-lg-6 mb-3 mb-sm-0">
    <?php $type = ""; ?>
    <form action="UserController.php" method="post" id="filterForm">
      <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
        <select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select" tabindex="-98" name="type" onchange="updateType(this.value)">
          <option value="">Type</option>
          <option value="ASC">Ascendant</option>
          <option value="DESC">Descendant</option>
        </select>
      </div>
      <input type="hidden" name="option" id="optionInput" value="<?php echo $option; ?>">
      <input type="hidden" name="category" value="<?php echo $_GET['category']; ?>">
      <input type="hidden" name="selectedType" id="selectedTypeInput" value="<?php echo $type; ?>">
    </form>
  </div>
  <div class="col-lg-6 text-lg-right">
    <?php $option = 0; ?>
    <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" style="width: 100%;">
      <select class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" data-toggle="select" tabindex="-98" name="filterOption" onchange="updateOption(this.value)">
        <option>Filter by</option>
        <option value="1">Replies</option>
        <option value="2">Dates</option>
        <option value="3">Views</option>
      </select>
    </div>
    <input type="hidden" name="option" id="optionInput" value="<?php echo $option; ?>">
    <input type="hidden" name="category" value="<?php echo $_GET['category']; ?>">
  </div>
</div>

<script>
  function updateOption(value) {
    var optionInput = document.getElementById('optionInput');

    if (value == '2') {
      optionInput.value = '2';
    } else if (value === '3') {
      optionInput.value = '3';
    } else if (value === '1') {
      optionInput.value = '1';
    } else {
      optionInput.value = '0';
    }
    document.getElementById('filterForm').submit();
  }
  function updateTypeAndOption() {
    var selectedType = document.getElementById('selectedTypeInput').value;
    var selectedOption = document.getElementById('optionInput').value;

    if (selectedType !== '' && selectedOption !== '') {
      document.getElementById('filterForm').submit();
    }
  }

</script>

<?php
if (isset($_GET['option'])) {
  $option = $_GET['option'];
}
if (isset($_GET['type'])) {
    $type = $_GET['type'];
  }
if ($option == 0) {
  $forums = $userModel->GetForums($_GET['category'], null, $type);
} else if ($option == 1) {
  $forums = $userModel->GetForums($_GET['category'], 1, $type);
} else if ($option == 2) {
  $forums = $userModel->GetForums($_GET['category'], 2, $type);
} else {
  $forums = $userModel->GetForums($_GET['category'], 3, $type);
}


$nb_forums=$userModel->getForums_nb2($_GET['category']);
// Retrieve the post count for each forum   
$SumPosts=0;
$postCounts = [];
foreach ($forums as $forum) {
    $postCounts[$forum['Forum_id']] = $userModel->GetnbPost($forum['Forum_id']);
    $SumPosts+=$postCounts[$forum['Forum_id']];
}
$maxPostCount = 0;
$forumIDWithMaxPosts = null;
if (!empty($postCounts)) {
    $maxPostCount = max($postCounts);
    $forumIDsWithMaxPosts = array_keys($postCounts, $maxPostCount);
    $forumIDWithMaxPosts = $forumIDsWithMaxPosts[0];
    $hotest = $userModel->getForum($forumIDWithMaxPosts);
}
$i = 0;
foreach ($forums as $forum) {
    $Sum_upvotes = $userModel->SumUpvotes($forum['Forum_id']);
    $name = $userModel->getPerson_byID($forum["person_id"]);
    $nbpost = $postCounts[$forum['Forum_id']];
    $nb_view = $userModel->getViewCount($forum['Forum_id']);
    $i++;
    if ($i % 2 == 0) {
        ?>
        <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-sm-0">
                    <h5>
                        <form action="UserController.php" method="post" style="display: inline;">
                            <input type="hidden" name="forum_id" value="<?php echo $forum["Forum_id"]; ?>">
                            <button type="submit" class="text-primary" name="forum" style="background: none; border: none; padding: 0;">
                                <?php echo $forum["Title"]; ?>
                            </button>
                        </form>
                    </h5>
                    <p class="text-sm">
                        <span class="op-6">Posted</span>
                        <a class="text-black" href="#">
                            <?php
                            $timestamp = $forum["Timestamp"];
                            $dateTime = new DateTime($timestamp);
                            $currentDateTime = new DateTime();
                            $interval = $currentDateTime->diff($dateTime);
                            $minutes = $interval->i;
                            echo $minutes;
                            ?>
                            minutes ago
                        </a>
                        <span class="op-6">by</span>
                        <a class="text-black" href="#">
                            <?php echo $name["FIRST"]; ?>
                        </a>
                    </p>
                    <div class="text-sm op-5">
                        <a class="text-black mr-2" href="#"><?php echo "#", $forum["tags"]; ?></a>
                    </div>
                </div>
                <div class="col-md-4 op-7">
                    <div class="row text-center op-7">
                        <div class="col px-1">
                            <i class="ion-connection-bars icon-1x"></i>
                            <span class="d-block text-sm"><?php echo $Sum_upvotes ?> Votes</span>
                        </div>
                        <div class="col px-1">
                            <i class="ion-ios-chatboxes-outline icon-1x"></i>
                            <span class="d-block text-sm"><?php echo ($nbpost-1 >= 0) ? ($nbpost-1) : 0 ?> Replies</span>
                        </div>
                        <div class="col px-1">
                            <i class="ion-ios-eye-outline icon-1x"></i>
                            <span class="d-block text-sm"><?php echo $nb_view ?>Views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-sm-0">
                    <h5>
                        <form action="UserController.php" method="post" style="display: inline;">
                            <input type="hidden" name="forum_id" value="<?php echo $forum["Forum_id"]; ?>">
                            <button type="submit" class="text-primary" name="forum" style="background: none; border: none; padding: 0;">
                                <?php echo $forum["Title"]; ?>
                            </button>
                        </form>
                    </h5>
                    <p class="text-sm">
                        <span class="op-6">Posted</span>
                        <a class="text-black" href="#">
                            <?php
                            $timestamp = $forum["Timestamp"];
                            $dateTime = new DateTime($timestamp);
                            $currentDateTime = new DateTime();
                            $interval = $currentDateTime->diff($dateTime);
                            $minutes = $interval->i;
                            echo $minutes;
                            ?>
                            minutes ago
                        </a>
                        <span class="op-6">by</span>
                        <a class="text-black" href="#">
                            <?php echo $name["FIRST"]; ?>
                        </a>
                    </p>
                    <div class="text-sm op-5">
                        <a class="text-black mr-2" href="#"><?php echo "#", $forum["tags"]; ?></a>
                    </div>
                </div>
                <div class="col-md-4 op-7">
                    <div class="row text-center op-7">
                        <div class="col px-1">
                            <i class="ion-connection-bars icon-1x"></i>
                            <span class="d-block text-sm"><?php echo $Sum_upvotes ?> Votes</span>
                        </div>
                        <div class="col px-1">
                            <i class="ion-ios-chatboxes-outline icon-1x"></i>
                            <span class="d-block text-sm"><?php echo ($nbpost-1 >= 0) ? ($nbpost-1) : 0 ?> Replies</span>
                        </div>
                        <div class="col px-1">
                            <i class="ion-ios-eye-outline icon-1x"></i>
                            <span class="d-block text-sm"><?php echo $nb_view ?> Views</span>
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

<div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
<div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;"></div><div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;"><div class="sticky-inner">
<a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="Create_forum.php?categorie=<?php echo $_GET['category']; ?>">Ask Question</a>
<div class="bg-white mb-3">
<h4 class="px-3 py-4 op-5 m-0">
Active Topics
</h4>
<?php
$counter = 0;
foreach ($forums as $forum) {
$name = $userModel->getPerson_byID($forum["person_id"]);
?>
<hr class="m-0">
<div class="pos-relative px-3 py-3">
<h6 class="text-primary text-sm">
<a href="#" class="text-primary"><?php  echo $forum["Title"] ?></a>
</h6>
<p class="text-sm">
    <span class="op-6">Posted</span>
    <a class="text-black" href="#">
        <?php
        $timestamp = $forum["Timestamp"];
        $dateTime = new DateTime($timestamp);
        $currentDateTime = new DateTime();
        $interval = $currentDateTime->diff($dateTime);
        $minutes = $interval->i;
        echo $minutes;
        ?>
        minutes ago
    </a>
    <span class="op-6">by</span>
    <a class="text-black" href="#">
        <?php echo $name["FIRST"]; ?>
    </a>
</p></div>
<?php
$counter++;
if ($counter>2) break;
}
?>
</div>
<div class="bg-white text-sm">
<h4 class="px-3 py-4 op-5 m-0 roboto-bold">
Stats
</h4>
<hr class="my-0">
<div class="row text-center d-flex flex-row op-7 mx-0">
<div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#"><?php echo $nb_forums ?></a> Topics </div>
<div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $SumPosts ?></a>Posts</div>
</div>
<div class="row d-flex flex-row op-7">
<div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $nb ?></a> Members </div>
<div class="col-sm-6 flex-ew text-center py-3 mx-0">
    <a class="d-block lead font-weight-bold" href="#">
        <?php if(isset($hotest['tags'])) { echo '#'.$hotest['tags']; } else { echo "None"; } ?>
    </a>
    Hotest Topic
</div>
</div>
</div>
</div></div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
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