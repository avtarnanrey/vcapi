<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/contractors.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$contractor = new Contractors($db);
 
// query products
$stmt = $contractor->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $contractor_arr=array();
    $contractor_arr["records"]=array();
    $contractor_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $contractor_item=array(
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
 
        array_push($contractor_arr["records"], $contractor_item);
    }
 
 
    // include paging
    $total_rows=$contractor->count();
    $page_url="{$home_url}product/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $contractor_arr["paging"]=$paging;
 
    echo json_encode($contractor_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>