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

    // get id
    private $location;
    // Setter, Set data on Variable
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
        $this->checkIfLocationExist();
        $this->checkIfCategoryExist();
        $this->checkifSupplierExist();
        $this->addToDB();
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
                $location = $mysql->prepare('INSERT INTO `product_location` (`id`, `adress`, `lokale`, `hylde`, `plads`) VALUES (NULL, ?, ?, ?, ?)');
                $location->bind_param("ssss", $array[2], $array[3], $array[4], $array[5]);
                $location->execute();
                $this->setLocation($location->insert_id);

            }

        } catch (Exception $e) {
            die("Error " . $e->getMessage());
        }
        $mysql->close();

    }


//Check for Category if exist

    private function checkIfCategoryExist()
    {


        try{
            $connection = new DBConnection();
            $mysql = $connection->getConnection();
            $array = $this->arraysAndSecurity();
            if (is_numeric($this->getKategori())){
                echo "am I died1";

                $result = $mysql->query("SELECT id FROM `category` WHERE id = ".$this->getKategori());
                $row = $result->fetch_assoc();
                $this->setKategori($row['id']);

            }
            else
            {
                $intIdTest = 4;
                $stmt = $mysql->prepare('INSERT INTO `category` (`id`, `category_name`) VALUES (NULL, ?)');
                $stmt->bind_param("is" ,$array[0]);
                $stmt->execute();
                $idContainer = $stmt->insert_id;
                echo "is this ".$this->getKategori();

                echo "am I died2";
                $this->setKategori($idContainer);
            }


        }catch (Exception $exception){
            die("Error ". $exception->getMessage()) ;
        }
        $mysql->close();
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
                echo $splittedValueArray[0]." ".$splittedValueArray[1]." ".$splittedValueArray[2];
                $stmt = $mysql->prepare("INSERT INTO leverandoer (id,leverandoer_name,leverandoer_adress,leverandoer_phonenr) values (null,?,?,?)");
                $stmt->bind_param("ssi",$splittedValueArray[0],$splittedValueArray[1],$splittedValueArray[2]);
                $stmt->execute();
                $this->setLeverandoer($stmt->insert_id);
                echo $stmt->insert_id;
            }
        }catch (Exception $exception){
            die("Error: ". $exception);
        }
        $mysql->close();
    }
//Add Product to Database

        private function addToDB(){


            try {
                $con = new DBConnection();
                $mysql = $con->getConnection();
                $product = $this->getProduktNavn();
                $location = (int)$this->getLocation();
                $flytbar = $this->getFlytbar();
                $category = (int)$this->getKategori();
                $leverandoer = (int)$this->getLeverandoer();
                $description = $this->getDescription();
                $execute = $mysql->prepare('INSERT INTO `products` (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL,?,?,?,?,?,?)');
                echo $this->getProduktNavn() ."Location =". $this->getLocation() . $this->getFlytbar() ." Kategori =". $this->getKategori() . " leverandoer =". $this->getLeverandoer() . $this->getDescription();
                $execute->bind_param("sisiis", $product,$location, $flytbar, $category, $leverandoer, $description);
                $execute->error_list;
                $execute->execute();
            } catch (Exception $e) {
                die("Error: ".$e);
            }

            $mysql->close();
        }



}







