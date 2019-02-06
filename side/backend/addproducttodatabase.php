
<?php
//echo "INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL, '".$_POST['produkt_navn'] ."', '".$_POST['']."', '".$_POST['flytbar']."', '".$_POST['kategori']."', '".$_POST['leverandoer']."', '".$_POST['description']."');";
include_once "../includes/connect.php";
class addProductToDatabase{
    private $kategori;
    private $produktNavn ;
    private $virksomhed ;
    private $lokale;
    private $svf ;
    private $thp ;
    private $flytbar;
    private $antal ;
    private $leverandoer;
    private $description;
    private $product;
    // get data from AJAX Call from Addproducts.js
    // Setter, Set data on a Variable
    public function setProduct($id){

        $this->product = $id;
    }
    public function setKategori($kategori){
        $this->kategori = $kategori;
    }
    public function setProduktNavn($produktNavn){
        $this->produktNavn = $produktNavn;
    }
    public function setVirksomhed($virksomhed){
        $this->virksomhed = $virksomhed;
    }
    public function setLokale($lokale){
        $this->lokale = $lokale;
    }
    public function setSVF($svf){
        $this->svf = $svf;
    }
    public function setTHP($thp){
        $this->thp = $thp;
    }
    public function setLeverandoer($leverandoer){
        $this->leverandoer = $leverandoer;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setAntal($antal){
        $this->antal = $antal;
    }
    public function setFlytbar($flytbar){
        $this->flytbar = $flytbar;
    }
    // Getter, Get data from a Variable
    public function getProduct(){
        return $this->product ;
    }
    public function getKategori(){
        return $this->kategori ;
    }
    public function getProduktNavn(){
        return $this->produktNavn ;
    }
    public function getVirksomhed(){
        return $this->virksomhed ;
    }
    public function getLokale(){
        return  $this->lokale ;
    }
    public function getSVF(){
        return $this->svf ;
    }
    public function getTHP(){
        return $this->thp ;
    }
    public function getLeverandoer(){
        return $this->leverandoer ;
    }
    public function getDescription(){
        return  $this->description ;
    }
    public function getAntal(){
        return  $this->antal ;
    }
    public function getFlytbar(){
        return $this->flytbar ;
    }
    //running all my functions and execute in main ###############################################################################
    public function main()
    {
        try {
            $this->checkIfLocationExist();
            $this->checkIfCategoryExist();
            $this->checkifSupplierExist();
            $this->checkIfSVFExist();
            $this->checkIfTHPExist();
            $this->checkIfAddressExist();
            $this->addProductToDB();
            $this->addEnhedtoDB();
        } catch (Exception $e) {
        }
    }
    //Insert all Product Data into an array for easier way to do group 'Prevent html special char and string'
    private function arraysAndSecurity()
    {
        //                              ar[0]            ar[1]               ar[2]             ar[3]           ar[4]         ar[5]         ar[6]               ar[7]
        $connection = new DBConnection();
        $mysql = $connection->getConnection();
        $array = array($this->getKategori(), $this->getProduktNavn(), $this->getVirksomhed(), $this->getLokale(), $this->getSVF(), $this->getTHP(), $this->getLeverandoer(), $this->getDescription());
//Check for html special char and string from input to prevent weak sql injection
        $count = count($array);
        for ($i = 0; $i < $count; $i++)
        {
            $container = $array[$i];
            $container = htmlspecialchars($container);
            $container = mysqli_real_escape_string($mysql, $container);
            $array[$i] = $container;
        }
        $mysql->close();
        return $array;
    }
    private function checkIfLocationExist()
    {
//Check if Location exist else make new.
        try {
            //$mysql = new mysqli('localhost', 'root', 'root', 'booking', 3307);
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();

            $result = $mysql->query("SELECT id FROM location_room WHERE location_room.id = " . $array[3]." OR location_room.room =".$array[3]);
            //Check if Location Exist in Database
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $container = $row['id'];
                $this->setLokale($container);
            }

            //else Insert a new Location to Database with prepared statement
            else
            {
                $location = $mysql->prepare('INSERT INTO `location_room` (`room`) VALUES (?)');
                $location->bind_param("s", $array[3]);
                $location->execute();
                //Get the ID from new Location and set setLocation variable with the new data
                $this->setLokale($location->insert_id);
            }
            $mysql->close();
        } catch (Exception $e) {
            die("Error " . $e->getMessage());
        }
    }
// Check if SVF Exist
    private function checkIfSVFExist(){
        try {
            //$mysql = new mysqli('localhost', 'root', 'root', 'booking', 3307);
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            //Substring
            //if the value is P8 then it takes first index => P
            if (!is_numeric($array[4])){

                $firstletter = substr($array[4],0,1);
                //Substring
                //if the value is P8 then it start at index 1 and end when string ends.
                $number = substr($array[4],1);
            }
            else{

                $firstletter = "False";
                $number = -1;
            }


            $result = $mysql->query("SELECT id FROM product_location_type_svf WHERE id = '" . $array[4]."' or type = '".$firstletter."' and nr =".$number);
            //Check if svf Exist in Database
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $container = $row['id'];
                $this->setSVF($container);
            }
            //else Insert a new svf row to Database with prepared statement
            else
            {
                $substring = $array[4];
                //get string from index 0 to 1 char length.
                $substring1 = substr($substring,0,1);
                //get string from index 1 till end.
                $substring2 = substr($substring,1);
                //Convert string to int
                $substring2 = (int)$substring2;
                //Convert string to Upper case.
                $substring1 = strtoupper($substring1);
                $location = $mysql->prepare('INSERT INTO `product_location_type_svf` (`type`,nr) VALUES (?,?)');
                $location->bind_param("si",$substring1 ,$substring2);
                $location->execute();
                //Get the ID from new Location and set setLocation variable with the new data
                $this->setSVF($location->insert_id);
            }
            $mysql->close();
        } catch (Exception $e) {
            die("Error " . $e->getMessage());
        }
    }
// Check if THP Exist
    private function checkIfTHPExist(){
        try {
            //$mysql = new mysqli('localhost', 'root', 'root', 'booking', 3307);
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            //Substring
            //if the value is P8 then it takes first index => P
            if (!is_numeric($array[5])){

                $firstletter = substr($array[5],0,1);
                //Substring
                //if the value is P8 then it start at index 1 and end when string ends.
                $number = substr($array[5],1);
            }
            else{

                $firstletter = "False";
                $number = -1;
            }
            //Check in database if what you've input is in the database.
            $result = $mysql->query("SELECT id FROM product_location_type_svf WHERE id = '" . $array[5]."' or type ='".$firstletter."' and nr = ".$number);
            //Check if thp exist Exist in Database
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $container = $row['id'];
                $this->setTHP($container);
            }
            //else Insert a new SVF row to Database with prepared statement
            else
            {
                $substring = $array[5];
                // Substring because the value(S2) needs to be split into type and number (Type = S, Number = 2)
                //get string from index 0 to 1 char length.
                $substring1 = substr($substring,0,1);
                //get string from index 1 till end.
                $substring2 = substr($substring,1);
                //Convert string to int
                $substring2 = (int)$substring2;
                //Convert string to Upper case.
                $substring1 = strtoupper($substring1);
                $location = $mysql->prepare('INSERT INTO `product_location_type_thp` (`type`,nr) VALUES (?,?)');
                $location->bind_param("si",$substring1 ,$substring2);
                $location->execute();
                //Get the ID from new Location and set setLocation variable with the new data
                $this->setTHP($location->insert_id);
            }
            $mysql->close();
        } catch (Exception $e) {
            die("Error " . $e->getMessage());
        }
    }
// Check if Product_school_Address Exist and insert into school_name_short
// Address/Virksomhed
    private function checkIfAddressExist(){
        try{
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            //Check if Address Exist in the Database.
            //If array doesn't contain ','
            if (strpos($array[2],',') == false){
                $result = $mysql->query("SELECT school_address_short.id FROM school_address_short INNER JOIN product_school_address ON school_address_short.product_school_address_id = ".$array[2]);
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $this->setVirksomhed($row['id']);
                }
            }
            // Else Insert a new Address to the Database with Prepared statement
            else
            {
                $explodedarray = explode(',',$array[2]);
                $stmt = $mysql->prepare('INSERT INTO `product_school_address` (school_name,city,zip_code,address) VALUES (?,?,?,?)');
                $stmt->bind_param("ssis" ,$explodedarray[0],$explodedarray[2],$explodedarray[3],$explodedarray[4]);
                $stmt->execute();
                //get the ID from the new Category
                $idContainer = $stmt->insert_id;
                $newSql = $mysql->prepare('INSERT INTO `school_address_short` (company_name_short,product_school_address_id) VALUES (?,?)');
                $newSql->bind_param("si",$explodedarray[1],$idContainer);
                $newSql->execute();
                $idContainer = $newSql->insert_id;
                //Set setkategori variable with the new data.
                $this->setVirksomhed($idContainer);
            }
            $mysql->close();
        }catch (Exception $exception){
            die("Error ". $exception->getMessage()) ;
        }
    }
//Check for Category if exist
//Can only work after I set my database column 'id' to A_I.
    private function checkIfCategoryExist()
    {
        try{
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            //Check if Category Exist in the Database.

            $result = $mysql->query("SELECT id FROM `category` WHERE id = ".$array[0]." OR category_name =".$array[0]);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $this->setKategori($row['id']);
            }

            // Else Insert a new Category to the Database with Prepared statement
            else
            {
                $stmt = $mysql->prepare('INSERT INTO `category` (`category_name`) VALUES (?)');
                $stmt->bind_param("s" ,$array[0]);
                $stmt->execute();
                //get the ID from the new Category
                $idContainer = $stmt->insert_id;
                //Set setkategori variable with the new data.
                $this->setKategori($idContainer);
            }
            $mysql->close();
        }catch (Exception $exception){
            die("Error ". $exception->getMessage()) ;
        }
    }
//Check for Leverandoer if exist
    private function checkifSupplierExist(){
        try{
            $con = new DBConnection();
            $mysql = $con->getConnection();
            $array = $this->arraysAndSecurity();
            //Check if Leverandoer/Supplier exist in the Database
            if (is_numeric($array[6])) {
                $result = $mysql->query("SELECT id FROM `supplier_company` WHERE id = " . $array[6]);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $this->setLeverandoer($row['id']);
                }
            }
            // Insert a new Leverandoer/Supplier to the Database with prepared statement
            else
            {
                $valueToSplitContainer = $array[6];
                $splittedValueArray = explode(',', $valueToSplitContainer);
                $stmt = $mysql->prepare("INSERT INTO supplier_company (name,address,call_number) values (?,?,?)");
                $stmt->bind_param("ssi",$splittedValueArray[0],$splittedValueArray[1],$splittedValueArray[2]);
                $stmt->execute();
                //Set setLeverandoer variable with the ID from new Leverandoer/Supplier
                $this->setLeverandoer($stmt->insert_id);
            }
            $mysql->close();
        }catch (Exception $exception){
            die("Error: ". $exception);
        }
    }
//Add Product to Database with bug.
    private function addProductToDB(){
        try {
            //Get all the data from the variables we've set and stored in empty variables.
            $product = $this->getProduktNavn();
            $flytbar = $this->getFlytbar();
            $description = $this->getDescription();
            $category = $this->getKategori();
            $leverandoer = $this->getLeverandoer();
            $virksomhed = $this->getVirksomhed();
            $con = new DBConnection();
            $mysql = $con->getConnection();
            // Adding the Information we've gathered and Create a Product which is inserted into the Dataabase.
            $stmt = $mysql->prepare('INSERT INTO `school_products` (product_name,  movable , description,`school_name_short_id`, `category_id`, `supplier_company_id`) VALUES (?,?,?,?,?,?)');
            $stmt->bind_param("sssiii", $product, $flytbar, $description, $virksomhed, $category, $leverandoer);
            $stmt->execute();
            //Set setProduct with ID from the new Product we've added.
            $this->setProduct($stmt->insert_id);
            $mysql->close();
        } catch (Exception $e) {
            die("Error: ".$e);
        }
    }
    //Add units/enheds to Database
    private function addEnhedtoDB(){
        try {
            $con = new DBConnection();
            $mysql = $con->getConnection();
            $product_id = (int)$this->getProduct();
            $lokale = (int)$this->getLokale();
            $svf = (int)$this->getSVF();
            $thp = (int)$this->getTHP();
            $antal = $this->getAntal();
            //Get the Product ID from the new Product and insert into a new variable.
            // prepare a sql script for inserting X Total of Units/Enheds for the new Product.
            $stmt = $mysql->prepare("INSERT INTO product_unit_e (unit_number, current_status_id, products_id,location_room_id,product_location_type_svf_id,product_location_type_thp_id) VALUES (?, 3, ?,?,?,?)");
            //Looping sql insert script X times for each Unit/Enhed.
            for ($enhedNumber = 1; $enhedNumber<= $antal; $enhedNumber++) {
                $convertEnhedNumberToString = "Unit_".(string)$enhedNumber;
                $stmt->bind_param("siiii", $convertEnhedNumberToString, $product_id,$lokale,$svf,$thp);
                $stmt->execute();
            }
            $mysql->close();
        } catch (Exception $e) {
            die("Error: ".$e);
        }
    }
}
