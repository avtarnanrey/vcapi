<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/contractors.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare contractors object
$contractors = new Contractors($db);
 
// set ID property of contractors to be edited
$contractors->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of contractors to be edited
$contractors->readOne();
 
// create array
$contractors_arr = array(
    "id" => $contractors->id,
    "contractor_name" => $contractors->contractor_name,
    "company_name" => $contractors->company_name,
    "service_cat" => $contractors->service_cat,
    "about_him" => html_entity_decode($contractors->about_him),
    "areas_served" => $contractors->areas_served,
    "hst_number" => $contractors->hst_number,
    "company_address" => $contractors->company_address,
    "company_address2" => $contractors->company_address2,
    "zip" => $contractors->zip,
    "primary_email" => $contractors->primary_email,
    "secondary_email" => $contractors->secondary_email,
    "primary_phone" => $contractors->primary_phone,
    "secondary_phone" => $contractors->secondary_phone,
    "prefered_method" => $contractors->prefered_method,
    "created" => $contractors->created,
    "ranking" => $contractors->ranking
);
 
// make it json format
print_r(json_encode($contractors_arr));
?>