<?php 
session_start();
include 'sql_functions.php';

if (isset($_POST['user_login'])) {
  user_login();
}
else if (isset($_POST['user_logout'])){
  user_logout();
}
if (isset($_POST['user_register'])){
  header('Location: register.php');
}

function user_logout()
{
  if(session_destroy()) // Destroying All Sessions
  {
    header("Location: login.php"); // Redirecting To Home Page
    die();
  }
}

function user_login()
{

  $username = $_POST['Username_Textbox'];
  $password = $_POST['Password_Textbox'];

  $results = execute_sql_function("SELECT * FROM person WHERE '$username' = user_name AND '$password' = user_password");
  if ($row = $results->fetch_assoc())
  {
    $_SESSION['login_user'] = $username;
    $_SESSION['id_user'] = $row['id_user'];

    header('Location: index.php');
    die();
  }
  else
  {
    header('Location: login.php');
    die();
  }
}
?>