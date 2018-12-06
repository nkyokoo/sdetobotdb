<?php
include_once "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";

$connection = new DBConnection();
$mysqli = $connection->getConnection();
$sql = "SELECT * FROM products";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {

    echo "<option value=''>Select Item</option>";
    while($row = $result->fetch_assoc()){


        // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";

        echo "<option value=".$row['id'].">".$row['product_name']."</option>";


    }
}
$mysqli->close();


?>

