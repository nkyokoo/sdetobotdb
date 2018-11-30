<?php
include ('session.php');
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
echo "I'm on right site";
$length = 2;
for ($i = 1; $i < $length; $i++){
    $enhedCounter = 0;

    if (!empty($_POST['item_'.$i])) {



        $item = $_POST['item_'.$i];
        $enheder = $_POST['enhed_'.$i];
        $sql = "SELECT product_enhed.id FROM product_enhed INNER JOIN products ON product_enhed.products_id = products.id WHERE products.id = " . $item .
            " AND product_enhed.product_status_id = 3";

        $result = $mysqli->query($sql);

        if ($result->num_rows >= $enheder) {
            $length += 1;


            while ($row = $result->fetch_assoc() AND $enhedCounter < $enheder) {
                $newSql = "UPDATE product_enhed SET product_status_id = 1 WHERE product_enhed.id = " . $row['id'];
                // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";
                $mysqli->query($newSql);
                $enhedCounter += 1;
            }
            // ########################################################
            // ############ Change this Location To Match Real Path ###
            // ########################################################

        }
    }



}
//redirect("../Booking.php",false);

$mysqli->close();
//SELECT * FROM `product_enhed` INNER JOIN products ON product_enhed.Enhed_number = products.id WHERE products.id = 1
