<?php
//login.php
include_once "./config/database.php";
include_once "./objects/user.php";

if (isset($_COOKIE["type"])) {
  header("location:home.php");
}

$message = '';

if (isset($_POST["login"])) {
  if (empty($_POST["user_email"]) || empty($_POST["user_password"])) {
    $message = "<div class='alert alert-danger'>Both Fields are required</div>";
  } else {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    // read products will be here
    // query products
    $user->username = $_POST["user_email"];
    $user->password = $_POST["user_password"];
    if ( $user->verifyUserAndPass() ) {      
      setcookie("type", $user->type, time() + 3600); //one hour
      header("location:home.php");
    } else {
      $message = "<div class='alert alert-danger'>Email o contraseña incorrecta.</div>";
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Reporte pH del Agua</title>
  <script src="styles/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="styles/css/bootstrap.min.css" />
  <script src="styles/js/bootstrap.min.js"></script>
</head>

<body>
  <br />
  <div class="container">
    <h2 align="center">Ingresa tus datos</h2>
    <br />
    <div class="panel panel-default">

      <div class="panel-body">
        <span><?php echo $message; ?></span>
        <form method="post">
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="user_email" id="user_email" class="form-control" />
          </div>
          <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="user_password" id="user_password" class="form-control" />
          </div>
          <div class="form-group">
            <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
          </div>
        </form>
      </div>
    </div>
    <br />
  </div>
</body>

</html>