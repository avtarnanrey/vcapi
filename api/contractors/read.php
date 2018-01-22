<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/contractors.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$contractors = new Contractors($db);
 
// query products
$stmt = $contractors->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $contractor_arr=array();
    $contractor_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $contractor_item=array(
            "id" => $id,
            "contractor_name" => $contractor_name,
            "company_name" => $company_name,
            "service_cat" => $service_cat,
            "about_him" => html_entity_decode($about_him),
            "areas_served" => $areas_served,
            "hst_number" => $hst_number,
            "company_address" => $company_address,
            "company_address2" => $company_address2,
            "zip" => $zip,
            "primary_email" => $primary_email,
            "secondary_email" => $secondary_email,
            "primary_phone" => $primary_phone,
            "secondary_phone" => $secondary_phone,
            "prefered_method" => $prefered_method,
            "created" => $created
        );
 
        array_push($contractor_arr["records"], $contractor_item);
    }
 
    echo json_encode($contractor_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>