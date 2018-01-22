<?php
class Contractors{
 
    private $conn;
    private $table_name = "contract3rs";
 
    // object properties
    public $id;
    public $contractor_name;
    public $company_name;
    public $service_cat;
    public $about_him;
    public $areas_served;
    public $hst_number;
    public $company_address;
    public $company_address2;
    public $zip;
    public $primary_email;
    public $secondary_email;
    public $primary_phone;
    public $secondary_phone;
    public $prefered_method;
    public $created;
    public $modified;
    public $ranking;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                     id, contractor_name, company_name, service_cat, about_him, areas_served, hst_number, company_address, company_address2, zip, primary_email, secondary_email, primary_phone, secondary_phone, prefered_method, created, modified, ranking
                FROM
                    " . $this->table_name
                    // . " p
                    // LEFT JOIN
                    //     categories c
                    //         ON p.contractor_id = c.id
                 . " ORDER BY
                    created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " 
                SET
                contractor_name=:contractor_name, company_name=:company_name, service_cat=:service_cat, about_him=:about_him, areas_served=:areas_served, hst_number=:hst_number, company_address=:company_address, company_address2=:company_address2, zip=:zip, primary_email=:primary_email, secondary_email=:secondary_email, primary_phone=:primary_phone, secondary_phone=:secondary_phone, prefered_method=:prefered_method, created=:created, ranking=:ranking";

        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->contractor_name=htmlspecialchars(strip_tags($this->contractor_name));
        $this->company_name=htmlspecialchars(strip_tags($this->company_name));
        $this->about_him=htmlspecialchars(strip_tags($this->about_him));
        $this->hst_number=htmlspecialchars(strip_tags($this->hst_number));
        $this->company_address=htmlspecialchars(strip_tags($this->company_address));
        $this->company_address2=htmlspecialchars(strip_tags($this->company_address2));
        $this->zip=htmlspecialchars(strip_tags($this->zip));
        $this->primary_email=htmlspecialchars(strip_tags($this->primary_email));
        $this->secondary_email=htmlspecialchars(strip_tags($this->secondary_email));
        $this->primary_phone=htmlspecialchars(strip_tags($this->primary_phone));
        $this->prefered_method=htmlspecialchars(strip_tags($this->prefered_method));
    
        // bind values
        $stmt->bindParam(":contractor_name", $this->contractor_name);
        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":service_cat", $this->service_cat);
        $stmt->bindParam(":about_him", $this->about_him);
        $stmt->bindParam(":areas_served", $this->areas_served);
        $stmt->bindParam(":hst_number", $this->hst_number);
        $stmt->bindParam(":company_address", $this->company_address);
        $stmt->bindParam(":company_address2", $this->company_address2);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":primary_email", $this->primary_email);
        $stmt->bindParam(":secondary_email", $this->secondary_email);
        $stmt->bindParam(":primary_phone", $this->primary_phone);
        $stmt->bindParam(":secondary_phone", $this->secondary_phone);
        $stmt->bindParam(":prefered_method", $this->prefered_method);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":ranking", $this->ranking);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                     id, contractor_name, company_name, service_cat, about_him, areas_served, hst_number, company_address, company_address2, zip, primary_email, secondary_email, primary_phone, secondary_phone, prefered_method, created, ranking
                FROM
                    " . $this->table_name
                    // . " p
                    // LEFT JOIN
                    //     categories c
                    //         ON p.contractor_id = c.id
                 . " WHERE
                    id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->contractor_name = $row['contractor_name'];
        $this->company_name = $row['company_name'];
        $this->service_cat = $row['service_cat'];
        $this->about_him = $row['about_him'];
        $this->areas_served = $row['areas_served'];
        $this->hst_number = $row['hst_number'];
        $this->company_address = $row['company_address'];
        $this->company_address2 = $row['company_address2'];
        $this->zip = $row['zip'];
        $this->primary_email = $row['primary_email'];
        $this->secondary_email = $row['secondary_email'];
        $this->primary_phone = $row['primary_phone'];
        $this->secondary_phone = $row['secondary_phone'];
        $this->prefered_method = $row['prefered_method'];
        $this->created = $row['created'];
        $this->ranking = $row['ranking'];
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . " 
                SET
                contractor_name=:contractor_name, company_name=:company_name, service_cat=:service_cat, about_him=:about_him, areas_served=:areas_served, hst_number=:hst_number, company_address=:company_address, company_address2=:company_address2, zip=:zip, primary_email=:primary_email, secondary_email=:secondary_email, primary_phone=:primary_phone, secondary_phone=:secondary_phone, prefered_method=:prefered_method, created=:created, ranking=:ranking
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->contractor_name=htmlspecialchars(strip_tags($this->contractor_name));
        $this->company_name=htmlspecialchars(strip_tags($this->company_name));
        $this->about_him=htmlspecialchars(strip_tags($this->about_him));
        $this->hst_number=htmlspecialchars(strip_tags($this->hst_number));
        $this->company_address=htmlspecialchars(strip_tags($this->company_address));
        $this->company_address2=htmlspecialchars(strip_tags($this->company_address2));
        $this->zip=htmlspecialchars(strip_tags($this->zip));
        $this->primary_email=htmlspecialchars(strip_tags($this->primary_email));
        $this->secondary_email=htmlspecialchars(strip_tags($this->secondary_email));
        $this->primary_phone=htmlspecialchars(strip_tags($this->primary_phone));
        $this->prefered_method=htmlspecialchars(strip_tags($this->prefered_method));
    
        // bind values
        $stmt->bindParam(":contractor_name", $this->contractor_name);
        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":service_cat", $this->service_cat);
        $stmt->bindParam(":about_him", $this->about_him);
        $stmt->bindParam(":areas_served", $this->areas_served);
        $stmt->bindParam(":hst_number", $this->hst_number);
        $stmt->bindParam(":company_address", $this->company_address);
        $stmt->bindParam(":company_address2", $this->company_address2);
        $stmt->bindParam(":zip", $this->zip);
        $stmt->bindParam(":primary_email", $this->primary_email);
        $stmt->bindParam(":secondary_email", $this->secondary_email);
        $stmt->bindParam(":primary_phone", $this->primary_phone);
        $stmt->bindParam(":secondary_phone", $this->secondary_phone);
        $stmt->bindParam(":prefered_method", $this->prefered_method);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":ranking", $this->ranking);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}