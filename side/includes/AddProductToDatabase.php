<?php
echo "INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL, '".$_POST['produkt_navn'] ."', '".$_POST['']."', '".$_POST['flytbar']."', '".$_POST['kategori']."', '".$_POST['leverandoer']."', '".$_POST['description']."');";


include ('connect.php');

$mysql = new mysqli('localhost','root','root','booking',3307);

$sql = "INSERT INTO booking.products (`id`, `product_name`, `product_location_id`, `flytbar`, `category_id`, `leverandør_id`, `description`) VALUES (NULL, '".$_POST['product_navn'] ."', '".$_POST['']."', 'ja', '2', '1', 'No comment.');";


                                                                                                         //                             data: {kategori,produkt_navn,virksomhed,lokale,hylde,plads,antal,description},
