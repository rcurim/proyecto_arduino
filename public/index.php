<?php
//index.php
if(isset($_COOKIE["type"]))
{
 header("location:home.php");
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Lecturas del agua con arduino</title>
  <script src="styles/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="styles/css/bootstrap.min.css" />
  <script src="styles/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Bienvenido</h2>
   <br/>
   <div align="center">
   <a class="btn btn-primary" href="login.php" role="button">Iniciar sesion</a>
   </div>
   <br />
  </div>
 </body>
</html>
