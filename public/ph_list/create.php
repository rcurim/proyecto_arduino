<?php
// required headers

// database connection will be here
// include database and object files
include_once "../config/database.php";
include_once "../objects/ph_list.php";

$database = new Database();
$db = $database->getConnection();

$value = $_GET['value'];

if (isset($value)) {
    $ph_listv = new Ph_List($db);

    // read products will be here
    // query product
    $ph_listv->value = $value;

    // check if more than 0 record found
    if ($ph_listv->create()) {
        echo "<div class='alert alert-success'>Exito al guardar</div>";
        // show products data in json format
        //echo json_encode($products_arr);
    } else {

        echo "<div class='alert alert-warning'>Error al guardar</div>";
    }
}
