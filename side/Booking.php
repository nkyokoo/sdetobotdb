
<html>
<?php


include 'includes/connect.php';
include "includes/header.php";
include "includes/navbar.php";
include "includes/footer.php";



?>

<script>
    /*
   $(document).ready(function ChangeEnhed(){
      $(document.getElementsByName("item_1")).on('change',function(){

            let countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:'POST',
                    url:'includes/BookingDropDownList.php',
                    data:'item_id='+countryID,
                    success:function(html){
                        $('#enhed_2').html(html);
                        //$('#city').html('<option value="">Select state first</option>');
                    }
                });
            }else{
                $('#enhed_2').html('<option value="">Select an Item</option>');
                //$('#city').html('<option value="">Select state first</option>');
            }

  });
   });*/
    function ChangeLayers() {

        // Switch to different layer
        if($('#layer_1').css('display') === 'block')
        {
            window.alert("layer 1 is block");

            document.getElementById("layer_2").style.display = "block";
            document.getElementById("layer_1").style.display = "none";


        }
        else {
            window.alert("layer 1 is none");

            document.getElementById("layer_1").style.display = "block";
            document.getElementById("layer_2").style.display = "none";

        }
    }
    function ChangeEnhed(id) {
        window.alert("www");
        let product_id = "#item_" + id.toString();
        let countryID = $(product_id).val();//$('#'+product_id.).val();
        let enheds = "enhed_" + id.toString();
        window.alert(countryID);
        window.alert(enheds);

        //Ajax go to php site to get the Enheds of Chosen Product
        if(countryID){
            $.ajax({
                type:'POST',
                url:'./includes/BookingDropDownList.php',
                data:'item_id='+countryID,
                success:function(html){
                    $('#'+enheds).html(html);
                    //$('#city').html('<option value="">Select state first</option>');
                }
            });
        }else{
            $('#'+enheds).html('<option value="">Select an Item</option>');
            //$('#city').html('<option value="">Select state first</option>');
        }

    }
</script>
<button onclick="ChangeLayers()">Change Layer</button>
<form action="./includes/BookingSend.php" method="post">
    <div id="layer_1" class="layer1">
        <p>Layer 1</p>
        <select id="item_1" name="item_1" onchange="ChangeEnhed(1)">
            <option value="">Select Item</option>
            <?php

            $mysqli = new mysqli("localhost", "root", "root", "booking", 3307);
            $sql = "SELECT * FROM booking.products";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){


                    // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";

                    echo "<option value=".$row['id'].">".$row['product_name']."</option>";


                }
            }
            $mysqli->close();

            ?>
        </select>
        <select id="enhed_1" name="enhed_1">
            <option>Select an Item</option>
        </select>
    </div>

    <!-- ################################################################################################################ -->

    <div id="layer_2" class="layer2" >
        <p>Layer 2</p>
        <select id="item_2" name="item_2" onchange="ChangeEnhed(2)">
            <option value="">Select Item</option>
            <?php

            $mysqli = new mysqli("localhost", "root", "root", "booking", 3307);
            $sql = "SELECT * FROM booking.products";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){


                    // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";

                    echo "<option value=".$row['id'].">".$row['product_name']."</option>";


                }
            }
            $mysqli->close();

            ?>
        </select>
        <select id="enhed_2" name="enhed_2">
            <option>Select an Item</option>
        </select>
    </div>

<div style="display: block">
    <p>
        hello world
    </p>
</div>
    <input type="submit" value="Book">
</form>

</body>
</html>