<?php
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
$item = $_POST['item_1'];
$enheder = $_POST['item_2'];
$enhedCounter = 0;
$mysqli = new mysqli("localhost", "root", "root", "booking", 3307);
if (!empty($_POST['item_2'])) {
    $sql = "SELECT product_enhed.id FROM product_enhed INNER JOIN products ON product_enhed.products_id = products.id WHERE products.id = " . $item .
        " AND product_enhed.product_status_id = 3";

    $result = $mysqli->query($sql);

    if ($result->num_rows >= $enheder) {



        while ($row = $result->fetch_assoc() AND $enhedCounter < $enheder) {

            $newSql = "UPDATE product_enhed SET product_status_id = 1 WHERE product_enhed.id = " . $row['id'];
            // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";
            $mysqli->query($newSql);
            $enhedCounter += 1;
        }
        // ########################################################
        // ############ Change this Location To Match #############
        // ########################################################

        redirect("../Booking.php",false);
    }
}
$mysqli->close();
//SELECT * FROM `product_enhed` INNER JOIN products ON product_enhed.Enhed_number = products.id WHERE products.id = 1