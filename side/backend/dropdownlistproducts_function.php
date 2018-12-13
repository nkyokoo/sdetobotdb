<?php
include_once "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";

try {
    $connection = new DBConnection();
    $mysqli = $connection->getConnection();
    $selectedSelections = $_POST['selectedProducts'];
    $layer = $_POST['layer_id'];

        if (!isset($selectedSelections[$layer])){
            $selectedSelections = "0";
        }


    //$select = mysqli_real_escape_string($selectedSelections);
    $sql = "SELECT * FROM products WHERE id NOT IN (".$selectedSelections[$layer].")";
    echo $sql;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {

        echo "<option value=''>Select Item</option>";
        while ($row = $result->fetch_assoc()) {


            // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";

            echo "<option value=" . $row['id'] . ">" . $row['product_name'] . "</option>";


        }
    }
    $mysqli->close();
} catch (Exception $e) {
}


?>

