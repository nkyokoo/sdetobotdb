<?php
//echo "INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL, '".$_POST['produkt_navn'] ."', '".$_POST['']."', '".$_POST['flytbar']."', '".$_POST['kategori']."', '".$_POST['leverandoer']."', '".$_POST['description']."');";

$kategori = $_POST['kategori'];
$produktNavn = $_POST['produkt_navn'];
$virksomhed = $_POST['virksomhed'];
$lokale = $_POST['lokale'];
$hylde = $_POST['hylde'];
$plads = $_POST['plads'];
$flytbar = $_POST['flytbar'];
$antal = $_POST['antal'];
$leverandoer = $_POST['leverandoer'];
$description = $_POST['description'];

$array = array($kategori,$produktNavn,$virksomhed,$lokale,$hylde,$plads,$leverandoer,$description);
$count = count($array);

$mysql = new mysqli('localhost','root','root','booking',3307);

//Check for html special char and string from input to prevent weak sql injection
for ($i = 0; $i < $count;$i++){

  $container = $array[$i];
  $container = htmlspecialchars($container);
  $container = mysqli_real_escape_string($mysql,$container);
  $array[$i] = $container;

}

//Check if Location exist else make new.
if ($result = $mysql->query("SELECT id FROM product_location WHERE product_location.adress = '".$array['2']."' AND product_location.lokale = '".$array[3]."' AND product_location.hylde = '".$array[4]."' AND product_location.plads = '".$array[5]."'")){

    if ($result->num_rows > 0){
        $location = $result->fetch_assoc();
    }
    else{
        $location = $mysql->prepare('INSERT INTO `product_location` (`id`, `adress`, `lokale`, `hylde`, `plads`) VALUES (NULL, ?, ?, ?, ?)');
        $location->bind_param("ssss", $array[2],$array[3],$array[4],$array[5]);
        $location->execute();
        $location = $location->insert_id;
        echo " location_id : ".$location;
    }
}

//Check for Category if existb

//Check for Leverandoer if exist

//Add Product to Database
if ($stmt = $mysql->prepare('INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL,?,?,?,?,?,?)')){

    $stmt->bind_param("sisiis");
}






