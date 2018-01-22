<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/contractors.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare contractors object
$contractors = new Contractor($db);
 
// get id of contractors to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of contractors to be edited
$contractors->id = $data->id;
 
// set contractors property values
$contractor->contractor_name = $data->contractor_name;
$contractor->company_name = $data->company_name;
$contractor->service_cat = $data->service_cat;
$contractor->about_him = $data->about_him;
$contractor->areas_served = $data->areas_served;
$contractor->hst_number = $data->hst_number;
$contractor->company_address = $data->company_address;
$contractor->company_address2 = $data->company_address2;
$contractor->zip = $data->zip;
$contractor->primary_email = $data->primary_email;
$contractor->secondary_email = $data->secondary_email;
$contractor->primary_phone = $data->primary_phone;
$contractor->secondary_phone = $data->secondary_phone;
$contractor->prefered_method = $data->prefered_method;
$contractor->ranking = $data->ranking;
 
// update the contractors
if($contractors->update()){
    echo '{';
        echo '"message": "contractors was updated."';
    echo '}';
}
 
// if unable to update the contractors, tell the user
else{
    echo '{';
        echo '"message": "Unable to update contractors."';
    echo '}';
}
?>