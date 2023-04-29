<?php

// Import the UserModel class
require_once '../Model/UserModel.php';
// Create a new instance of the UserModel with the database connection
$userModel = new UserModel($db);

if (isset($_POST['signup'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $cin = $_POST['id'];

  // Call the registerUser method of the UserModel and pass the user input as arguments
  $userModel->registerUser($name, $email, $password, $cin);
}
if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = $_POST['pass'];

  // Call the registerUser method of the UserModel and pass the user input as arguments
  $userModel->LoginUser($email, $password);
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
  // Call the edit method of the UserModel and pass the user inputs as arguments
  $userModel->Edit_profile($FIRST,$EMAIL,$POSITION,$GENDER,$ID,$PHONE,$BIRTHDAY,$ABOUT,$STATUS);
}

if (isset($_POST['search']) || isset($_POST['search2']) || isset($_POST['search3']) || isset($_POST['search4']))
{
  $FIRST = $_POST['FIRST'];
  $userModel->View_profile($FIRST);
}

if (isset($_POST['send']))
{
  session_start();
  $message = $_POST['message'];
  $userModel->Insert_Message($_SESSION['user_id'],$message);
}

if (isset($_POST['Delete_User']))
{
  $ID = $_POST['ID'];
  $userModel->Delete_User($ID);
}

$users = $userModel->getUsers();
$messages = $userModel->getMessages();
$nb = $userModel->getUsers_nb();
?>