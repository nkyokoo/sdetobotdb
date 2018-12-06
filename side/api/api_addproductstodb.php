<?php

include "../backend/addproducttodatabase.php";

try
{
    $class = new addproducttodatabase();
    $class->setKategori($_POST['kategori']);
    $class->setProduktNavn($_POST['produkt_navn']);
    $class->setVirksomhed($_POST['virksomhed']);
    $class->setLokale($_POST['lokale']);
    $class->setHylde($_POST['hylde']);
    $class->setPlads($_POST['plads']);
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
