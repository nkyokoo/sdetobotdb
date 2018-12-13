<?php
//echo "INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL, '".$_POST['produkt_navn'] ."', '".$_POST['']."', '".$_POST['flytbar']."', '".$_POST['kategori']."', '".$_POST['leverandoer']."', '".$_POST['description']."');";
include_once "../includes/connect.php";

class addproducttodatabase{

    private $kategori;
    private $produktNavn ;
    private $virksomhed ;
    private $lokale;
    private $hylde ;
    private $plads ;
    private $flytbar;
    private $antal ;
    private $leverandoer;
    private $description;
    private $product;
    // get id
    private $location;
    // Setter, Set data on Variable
    public function setProduct($id){
        $this->product = $id;

    }
    public function setLocation($location){
        $this->location = $location;

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
    public function setHylde($hylde){
        $this->hylde = $hylde;
    }
    public function setPlads($plads){
        $this->plads = $plads;
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

    // Getter, Get data from Variable
    public function getProduct(){
        return $this->product ;
    }
    public function getLocation(){
        return $this->location ;
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
    public function getHylde(){
        return $this->hylde ;
    }
    public function getPlads(){
        return $this->plads ;
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
    //running all my functions ###############################################################################
    public function main()
    {
        try {
            $this->checkIfLocationExist();
            $this->checkIfCategoryExist();
            $this->checkifSupplierExist();
            $this->addProductToDB();
            $this->addEnhedtoDB();
        } catch (Exception $e) {
        }

    }

    private function arraysAndSecurity()
    {
        //                              ar[0]            ar[1]               ar[2]             ar[3]           ar[4]         ar[5]         ar[6]               ar[7]

        return $array = array($this->getKategori(), $this->getProduktNavn(), $this->getVirksomhed(), $this->getLokale(), $this->getHylde(), $this->getPlads(), $this->getLeverandoer(), $this->getDescription());


    }

    private function checkIfLocationExist()
    {


//Check if Location exist else make new.
        try {
            //$mysql = new mysqli('localhost', 'root', 'root', 'booking', 3307);
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            $count = count($array);


//Check for html special char and string from input to prevent weak sql injection
            for ($i = 0; $i < $count; $i++)
            {
                $container = $array[$i];
                $container = htmlspecialchars($container);
                $container = mysqli_real_escape_string($mysql, $container);
                $array[$i] = $container;
            }
            $result = $mysql->query("SELECT id FROM product_location WHERE product_location.adress = '" . $array['2'] . "' AND product_location.lokale = '" . $array[3] . "' AND product_location.hylde = '" . $array[4] . "' AND product_location.plads = '" . $array[5] . "'");
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $container = $row['id'];
                $this->setLocation($container);


            } else
            {
                $location = $mysql->prepare('INSERT INTO `product_location` (`adress`, `lokale`, `hylde`, `plads`) VALUES (?, ?, ?, ?)');
                $location->bind_param("ssss", $array[2], $array[3], $array[4], $array[5]);
                $location->execute();
                $this->setLocation($location->insert_id);

            }
            $mysql->close();

        } catch (Exception $e) {
            die("Error " . $e->getMessage());
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
            if (is_numeric($this->getKategori())){

                $result = $mysql->query("SELECT id FROM `category` WHERE id = ".$this->getKategori());
                $row = $result->fetch_assoc();
                $this->setKategori($row['id']);

            }
            else
            {
                $stmt = $mysql->prepare('INSERT INTO `category` (`category_name`) VALUES (?)');
                $stmt->bind_param("s" ,$array[0]);
                $stmt->execute();
                $idContainer = $stmt->insert_id;

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

            if (is_numeric($array[6])){
                $result = $mysql->query("SELECT id FROM `leverandoer` WHERE id = ".$array[6]);
                $row = $result->fetch_assoc();
                $this->setLeverandoer($row['id']);
            }
            else
            {
                $valueToSplitContainer = $array[6];
                $splittedValueArray = explode(',', $valueToSplitContainer);
                $stmt = $mysql->prepare("INSERT INTO leverandoer (leverandoer_name,leverandoer_adress,leverandoer_phonenr) values (?,?,?)");
                $stmt->bind_param("ssi",$splittedValueArray[0],$splittedValueArray[1],$splittedValueArray[2]);
                $stmt->execute();
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

            $product = $this->getProduktNavn();
            $flytbar = $this->getFlytbar();
            $description = $this->getDescription();
            $location = $this->getLocation();
            $category = $this->getKategori();
            $leverandoer = $this->getLeverandoer();



            $con = new DBConnection();
            $mysql = $con->getConnection();
            $stmt = $mysql->prepare('INSERT INTO `products` (`product_name`,  `flytbar` , `description`,`product_location_id`, `category_id`, `leverandør_id`) VALUES (?,?,?,?,?,?)');
            $stmt->bind_param("sssiii", $product, $flytbar, $description, $location, $category, $leverandoer);
            $stmt->execute();
           $this->setProduct($mysql->insert_id);
            $mysql->close();

        } catch (Exception $e) {
            die("Error: ".$e);
        }

    }

    //Add enheds to Database
    private function addEnhedtoDB(){

        try {
            $con = new DBConnection();
            $mysql = $con->getConnection();
            $productID =$this->getProduct();
            $stmt = $mysql->prepare("INSERT INTO `product_enhed` (`Enhed_number`, `product_status_id`, `products_id`) VALUES (?, 4, ?)");

            for ($enhedNumber = 1; $enhedNumber<= $this->getAntal(); $enhedNumber++) {
                $convertEnhedNumberToString = (string)$enhedNumber;
                $stmt->bind_param("si", $convertEnhedNumberToString, $productID);
                $stmt->execute();
            }
            $mysql->close();
        } catch (Exception $e) {
            die("Error: ".$e);
        }
    }
}







