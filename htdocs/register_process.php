<?php 
session_start();
include 'sql_functions.php';

if (isset($_POST['user_register'])) {
  user_register();
}
else if (isset($_POST['user_cancel'])) {
  header('Location: login.php');
}

function user_register()
{

  $username = $_POST['Username_Textbox'];
  $password = $_POST['Password_Textbox'];
  $confirm_password = $_POST['Confirm_Password_Textbox'];

  if ($password !== $confirm_password){
    header('Location: register.php');
  }
  else{
    $results = execute_sql_function("SELECT * FROM person WHERE '$username' = user_name");
    if ($row = $results->fetch_assoc()){
      header('Location: register.php');
    }
    else{
      execute_non_query("INSERT INTO person (user_name,user_password) VALUES ('$username','$password');");
      header('Location: login.php');
    }
  }
}
?>