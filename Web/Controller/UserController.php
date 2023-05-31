<?php

// Import the UserModel class
require_once '../Model/UserModel.php';
$userModel = new UserModel($db);

if (isset($_POST['signup'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $cin = $_POST['id'];

  if (!empty($name) && !empty($email) && !empty($password) && !empty($cin)) {
    $userModel->registerUser($name, $email, $password, $cin);
  }
  else header('Location: ../View/Register.php');
}

if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = $_POST['pass'];

  if (!empty($email) && !empty($password)) {
    $userModel->LoginUser($email, $password);
  }
  else header('Location: ../View/Login.php');

}

if (isset($_POST['edit'])) {
  $FIRST = $_POST['username'];
  $EMAIL = $_POST['email'];
  $POSITION = $_POST['position'];
  $GENDER = $_POST['gender'];
  $ID = $_POST['id'];
  $PHONE = $_POST['phone'];
  $BIRTHDAY = $_POST['birthdate'];
  $ABOUT = $_POST['about'];
  $STATUS = $_POST['status'];

  // Check if an image was uploaded for the user profile picture
  if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
    // Get the content of the image and convert it to binary format
    $imgContent = file_get_contents($_FILES['imageUpload']['tmp_name']);
  } else {
    $imgContent = null; // Set the image content to null if no image is uploaded
  }

  // Check if an image was uploaded for the background image
  if (isset($_FILES['backgroundUpload']) && $_FILES['backgroundUpload']['error'] == 0) {
    // Get the content of the background image and convert it to binary format
    $backgroundContent = file_get_contents($_FILES['backgroundUpload']['tmp_name']);
  } else {
    $backgroundContent = null; // Set the background image content to null if no image is uploaded
  }

  // Call the Edit_profile function with the updated arguments
  $userModel->Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS, $imgContent, $backgroundContent);
}

if (isset($_POST['search']) || isset($_POST['search2']) || isset($_POST['search3']) || isset($_POST['search4']) || isset($_POST['search5']))
{
  $FIRST = $_POST['FIRST'];
  header('Location: ../View/Profil_show.php?FIRST=' . urlencode($FIRST));
}




if (isset($_POST['forum'])) {
  $forum_id = $_POST['forum_id'];
  $userModel->NewView($forum_id);
  header('Location: ../View/Forum_page.php?ID=' . urlencode($forum_id));
}


if (isset($_POST['send']))
{
  session_start();
  $message = $_POST['message'];

  if (!empty($message)) {
    $userModel->Insert_Message($_SESSION['user_id'],$message);
  }
  else header('Location: ../View/Chat.php');
}

if (isset($_POST['Delete_User']))
{
  $ID = $_POST['ID'];

  if (!empty($ID)) {
    $userModel->Delete_User($ID);
  }
  else header('Location: ../View/Dashboard.php');
}

if (isset($_POST['create_forum'])) {
  session_start();
  $title = $_POST['title'];
  $tags = $_POST['tags'];
  $category = $_POST['category'];
  $userModel->Create_forum($title, $tags, $_SESSION['user_id'], $category);
}


if (isset($_POST['post']))
{
  session_start();
  $content = $_POST['message'];
  $poster_id = $_SESSION['user_id'];
  $forum_id = $_POST['forum_id'];
  $userModel->InsertPost($content,$poster_id,$forum_id);
}

if (isset($_GET['upvote_id']))
{
  session_start();
  $userModel->CreateUpvote($_SESSION['user_id'],$_GET['upvote_id']);
}


if (isset($_POST['option']) && isset($_POST['type']) && isset($_POST['category'])) {
  $selectedOption = $_POST['option'];
  $selectedType = $_POST['type'];
  $category = $_POST['category'];

  // Redirect to the updated URL
  $url = "../View/Forum_list.php?category=" . urlencode($category) . "&option=" . urlencode($selectedOption) . "&type=" . urlencode($selectedType);
  header("Location: " . $url);  
  exit;
}



$users = $userModel->getUsers();
$messages = $userModel->getMessages();
$nb = $userModel->getUsers_nb();
$nb_forums_total=$userModel->getForums_nb();
if (isset($_SESSION['user_id']))
$verif = $userModel->verify_teatcher($_SESSION['user_id']);

?> 