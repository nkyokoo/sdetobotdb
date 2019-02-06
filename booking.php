
<?php

include ('includes/session.php');
//include 'includes/connect.php';
include ("includes/header.php");
include ("includes/navbar.php");



?>
<script type="text/javascript" src="assets/js/booking.js"></script>
<script type="text/javascript" src="assets/js/bookingtimer.js"></script>
<div><p>Timer</p> <p id="test">0</p></div>
<button onclick="ChangeLayers()">Change Layer</button>
<p>Layer <p id="layerText">1</p> </p>

<!-- <form action="api/api_bookingsend.php" method="post"> -->
    <div id="layer_1" class="layer1" style="display: block" >
        <span id="increment_1" style="display: none">1</span>

        <div id="select_list_1">
            <div id="rows">
            <!--  <select id="item_1" name="item_1" onchange="ChangeEnhed(1)">
                </select>
                <select id="enhed_1" name="enhed_1">
                    <option>Select an Item</option>
                </select>-->
                <?php
                include_once ('api/api_dropdownlistproducts_function.php');
                ?>
            </div>
        </div>
      <!--  <button type="button" onclick="AddSelect(0);">Add New Item</button> -->

    </div>

    <!-- ################################################################################################################ -->

   <!-- <div id="layer_2" class="layer2" style="display: none" >
        <span id="increment_1" style="display: none">1</span>
        <div id="select_list_2">
            <div>
                <select id="item_11" name="item_11" onchange="ChangeEnhed(11)">
                    <?php
                 //   $class->addProductsForSelection();
                    ?>
                </select>
                <select id="enhed_11" name="enhed_11">
                    <option>Select an Item</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="AddSelect(1)">Add New Item</button>

    </div> -->


  <!--  <input type="submit" value="Book">
</form> -->

<?php
include "includes/footer.php";

?>