<?php
if (!isset($_COOKIE["type"])) {
    header("location:login.php");
}
use Spipu\Html2Pdf\Html2Pdf;

if (isset($_POST["generar"])) {
    //Incluimos la librería
    require_once __DIR__ . '/../vendor/autoload.php';

    include_once "config/database.php";
    include_once "objects/ph_list.php";

    $database = new Database();
    $db = $database->getConnection();

    $ph_listv = new Ph_List($db);

    // read products will be here
    // query products
    $stmt = $ph_listv->readToPdf();
    $num = $stmt->rowCount();

    if ($num > 0) {
        //Recogemos el contenido de la vista
        ob_start();
        require_once 'view/report_ph_table.php';
        $html = ob_get_clean();

        //Pasamos esa vista a PDF

        //Le indicamos el tipo de hoja y la codificación de caracteres
        $mipdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');

        //Escribimos el contenido en el PDF
        $mipdf->writeHTML($html);

        //Generamos el PDF
        $mipdf->output('document.pdf','D');
    }
}
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="ISO-8859-1">
    <title>Reporte pH del Agua</title>
    <!-- Bootstrap 4 CSS and custom CSS -->
    <link rel="stylesheet" href="styles/css/bootstrap.min.css" />

</head>

<body>

    <div class="card">
        <div class="card-body">
            <h1>Reporte de lecturas de pH del agua</h1>
        </div>
    </div>
    <!-- container -->
    <main role="main" class="container starter-template mt-4">

        <div class="row">
            <div class="col">

                <!-- where prompt / messages will appear -->
                <div id="response"></div>


                <div class="form-row">
                    <div class="col-2">
                        <input type="text" class="form-control" id="keywordsin" placeholder="Buscar">
                    </div>
                    <div class="col-7">
                        <button class="btn btn-primary" id="search">Buscar</button>
                    </div>
                    <div class="col-2" align="right">
                        <input type="button" class="btn btn-success" id="readall" value="Actualizar">
                    </div>
                    <form action="" method="post" class="col-1" align="right" >
                        <input type="submit" class="btn btn-secondary" id="generar" name="generar" value="Exportar">
                    </form>
                </div>
                
                <!-- where main content will appear -->
                <div id="content" class="my-4">

                </div>
            </div>
        </div>
        

    </main>

    <footer>
        <div align="center">
            <a href="logout.php">Cerrar sesion</a>
        </div>
    </footer>

    <!-- jQuery & Bootstrap 4 JavaScript libraries -->
    <script src="styles/js/jquery-3.3.1.min.js"></script>
    <script src="styles/js/popper.min.js"></script>
    <script src="styles/js/bootstrap.min.js"></script>

    <!-- jquery scripts will be here -->
    <script src="styles/ajax/events.js"></script>

</body>

</html>