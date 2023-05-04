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
  else header('Location: http://localhost/web/View/Register.php'); 
}

if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = $_POST['pass'];

  if (!empty($email) && !empty($password)) {
    $userModel->LoginUser($email, $password);
  }
  else header('Location: http://localhost/web/View/Login.php');   
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
  
  // Check if an image was uploaded
  if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
    // Get the content of the image and convert it to binary format
    $imgContent = file_get_contents($_FILES['imageUpload']['tmp_name']);
    // Call the Edit_profile function with the image content
    $userModel->Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS, $imgContent);
  }
  else {
    // Call the Edit_profile function without the image content
    $userModel->Edit_profile($FIRST, $EMAIL, $POSITION, $GENDER, $ID, $PHONE, $BIRTHDAY, $ABOUT, $STATUS);
  }
}

if (isset($_POST['search']) || isset($_POST['search2']) || isset($_POST['search3']) || isset($_POST['search4']))
{
  $FIRST = $_POST['FIRST'];
  header('Location: http://localhost/web/View/Profil_show.php?FIRST=' . urlencode($FIRST));
}

if (isset($_POST['send']))
{
  session_start();
  $message = $_POST['message'];

  if (!empty($message)) {
    $userModel->Insert_Message($_SESSION['user_id'],$message);
  }
  else header('Location: http://localhost/web/View/Chat.php');   
}

if (isset($_POST['Delete_User']))
{
  $ID = $_POST['ID'];

  if (!empty($ID)) {
    $userModel->Delete_User($ID);
  }
  else header('Location: http://localhost/web/View/Dashboard.php');   
}

$users = $userModel->getUsers();
$messages = $userModel->getMessages();
$nb = $userModel->getUsers_nb();
?> 