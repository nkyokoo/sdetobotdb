<?php

$con = new mysqli("localhost", "root", "", "dbtest");
$exe = $con->prepare("SELECT he.ID, he.Name FROM he");
$exe->execute();
$exe->store_result();
$exe->bind_result($id, $name);

while($exe->fetch()){

    print($id. " ". $name);

}
$exe->close();
$con->close();

?>