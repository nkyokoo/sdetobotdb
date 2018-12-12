
<?php

include ('includes/session.php');
//include 'includes/connect.php';
include ("includes/header.php");
include ("includes/navbar.php");



?>
<script src="assets/js/booking.js">

<button onclick="ChangeLayers()">Change Layer</button>
<form action="./includes/bookingsend.php" method="post">
    <div id="layer_1" class="layer1" >
        <span id="increment_1" style="display: none">1</span>

        <p>Layer 1</p>
        <div id="select_list_1">
            <div>
                <select id="item_1" name="item_1" onchange="ChangeEnhed(1)">
                    <?php
                    include ('includes/dropdownlistproducts_function.php');
                    ?>
                </select>
                <select id="enhed_1" name="enhed_1">
                    <option>Select an Item</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="AddSelect(1);">Add new</button>

    </div>

    <!-- ################################################################################################################ -->

    <div id="layer_2" class="layer2" >
        <data id="increment_2" value="11"></data>

        <p>Layer 2</p>
        <div id="select_list_2">
            <div>
                <select id="item_11" name="item_11" onchange="ChangeEnhed(11)">
                    <?php
                    include ('includes/dropdownlistproducts_function.php');
                    ?>
                </select>
                <select id="enhed_11" name="enhed_11">
                    <option>Select an Item</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="AddSelect(2)">+</button>

    </div>


    <input type="submit" value="Book">
</form>

include "includes/footer.php";

?>

