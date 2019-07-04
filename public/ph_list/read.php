<?php
// required headers
 
// database connection will be here
// include database and object files
include_once "../config/database.php";
include_once "../objects/ph_list.php";

$database = new Database();
$db = $database->getConnection();

$ph_listv = new Ph_List($db);

// read products will be here
// query products
$stmt = $ph_listv->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){

    require_once '../view/ph_table.php';
 
    // show products data in json format
    //echo json_encode($products_arr);
}else{
    
    echo "<div class='alert alert-danger'>Error, no hay registros disponibles </div>";
 
}
?>