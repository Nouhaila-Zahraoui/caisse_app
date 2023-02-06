<?php
session_start();
$error = '';
$pageTitle = 'Login Page';
include 'infos-Functions.php';

if (isset($_SESSION['pseudo'])) {
  // session_destroy();
  header('location: server.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include "connexion.php";
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username) || empty($password)){
    $error = "Veuillez remplir tous les champs s'il vous plait !";
  }else{
  // $hashedpass = sha1($password);
  $stmt = $con->prepare("select * from client where Pseudo='$username' and Password='$password' limit 1");
  $stmt->execute();
  $row = $stmt->fetch();
  $count = $stmt->rowCount();
  if ($count <= 0)
    $error = "Le Pseudo ou le mot de passe est incorrect !";

  if ($count > 0) {
    $_SESSION['pseudo'] = $username;
    $_SESSION['code'] = $row['Code_Client'];
    $_SESSION['nom'] = $row['Nom'];
    header('location:server.php');
    exit();

  } else {
    $error = "Le Pseudo ou le mot de passe est incorrect !";

    //header('location:index.php');
  }
  }
}


?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php getTitle() ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/fontawesome.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

<link href="assets/css/login.css" rel="stylesheet">

<section class="login-block">
  <div class="container">
    <div class="row">
      <div class="col-md-4 login-sec">
        <h2 class="text-center text-capitalize">Login to Your account</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="login-form" method="POST" class="needs-validation"
          validate>
          <?php
                  if ($error != '')
                    echo '<div class="alert alert-danger m-0 text-center" role="alert">
                  <b>' . $error . '</b>
                </div>';
          ?>

          <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="text-capitalize">Votre pseudo : </label>
            <input type="text" name="username" id="username" class="form-control" placeholder="entrer votre pseudo" required="true">
            <div class="valid-feedback">
                    pseudo valide
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="text-capitalize">Votre mot de passe : </label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrer votre mot de passe">
          </div>


          <div class="mt-3">
            <button type="submit" class="btn btn-login mr-0">Se connecter</button>
          </div>


        </form>
        <div class="copy-text">Created with <i class="fa fa-heart"></i> by <b>Nouhaila Zahraoui</b></div>
      </div>
      <div class="col-md-8 banner-sec">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <!-- <img class="d-block img-fluid" width="80%" src="https://wallpapercave.com/wp/wp3537548.png" alt="First slide"> -->
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                  <h2>Ecommerce Meriem</h2>
                  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
</section>




<!-- <?php include 'include/template/footer.php' ?> -->