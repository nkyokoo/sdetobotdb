<?php

include "../backend/addproducttodatabase.php";

try
{

    $class = new addProductToDatabase();
    //get POST data from addproducts.php
    $kategori =$_POST['kategori'];
    $produkt_navn =$_POST['produkt_navn'];
    $virksomhed =$_POST['virksomhed'];
    $lokale =$_POST['lokale'];
    $SVF =$_POST['SVF'];
    $THP =$_POST['THP'];
    $flytbar =$_POST['flytbar'];
    $antal =$_POST['antal'];
    $leverandoer =$_POST['leverandoer'];
    $description =$_POST['description'];
    //Insert them into getter and setters of private field variables in addProductsToDatabase.
    $class->setKategori($kategori);
    $class->setProduktNavn($produkt_navn);
    $class->setVirksomhed($virksomhed);
    $class->setLokale($lokale);
    $class->setSVF($SVF);
    $class->setTHP($THP);
    $class->setFlytbar($flytbar);
    $class->setAntal($antal);
    $class->setLeverandoer($leverandoer);
    $class->setDescription($description);


    $class->main();
}
catch (Exception $e)
{
    echo "Error ".$e;
}
