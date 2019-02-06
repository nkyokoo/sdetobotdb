<?php

include "../backend/addproducttodatabase.php";

try
{

    $class = new addProductToDatabase();
    $class->setKategori($_POST['kategori']);
    $class->setProduktNavn($_POST['produkt_navn']);
    $class->setVirksomhed($_POST['virksomhed']);
    $class->setLokale($_POST['lokale']);
    $class->setSVF($_POST['SVF']);
    $class->setTHP($_POST['THP']);
    $class->setFlytbar($_POST['flytbar']);
    $class->setAntal($_POST['antal']);
    $class->setLeverandoer($_POST['leverandoer']);
    $class->setDescription($_POST['description']);


    $class->main();
}
catch (Exception $e)
{
    echo "Error ".$e;
}
