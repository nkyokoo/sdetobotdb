<?php

$selectedItem = $_POST['item_id'];

$mysqli = new mysqli("localhost", "root", "root", "booking", 3307);
if (!empty($_POST['item_id'])){
    $enhedCounter = 1;

    $sql = "SELECT product_enhed.Enhed_number FROM booking.product_enhed where products_id = ".$selectedItem." AND product_status_id = 3";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        echo '<option value="">Select Enheder</option>';

        while($row = $result->fetch_assoc()){


            // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";
            // foreach ($row as $value){
            // echo "<option value=''>".$row['Enhed_number']."</option>";
            echo '<option value="'.$enhedCounter.'">'.$enhedCounter.'</option>';
            $enhedCounter +=1;
            // }

        }
    }else{
        echo '<option value="">Ingen Enheder Ledige</option>';

    }


}

$mysqli->close();
