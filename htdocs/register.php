<?php
	include 'sql_functions.php';
	include 'index_onload.php';

  session_start();
  if(isset($_SESSION['login_user'])){
  header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Bootstrap.min CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" style="padding-top: 0px;" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Dod Maker</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <div class="content-wrapper">

    <div>
        <form action="/register_process.php" method="POST">
          <table class="mx-auto">
            <th><center><h1>Register</h1></center></th>
              <tr>
                <td class="text-center">Username</td>
              </tr>
              <tr>
                <td><input class="form-control form-control-rounded" type="text" name="Username_Textbox"></td>
              </tr>
              <tr>
                <td class="text-center"><div class="mt-2">Password</div></td>
              </tr>
              <tr>
                <td><input class="form-control form-control-rounded" type="password" name="Password_Textbox"></td>
              </tr>
              <tr>
                <td class="text-center"><div class="mt-2">Confirm Password</div></td>
              </tr>
              <tr>
                <td><input class="form-control form-control-rounded" type="password" name="Confirm_Password_Textbox"></td>
              </tr>
              <tr>
                <td class="text-center">
                  <input class="mb-1 mt-2 btn btn-primary btn-rounded" name="user_register" type="submit" value="Register">
                  <input class="mb-1 mt-2 btn btn-primary btn-rounded" name="user_cancel" type="submit" value="Cancel">
                </td>
              </tr>
          </table>
        </form>
    </div>    

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Team 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Jquery and Treeviewscripts-->
    <script src="vendor/jquery/jquery.js"></script>

  </div>

</body>

</html>
