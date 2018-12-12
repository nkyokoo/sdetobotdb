<?php


include "includes/header.php";
include "includes/navbar.php";
include "includes/footer.php";

echo "<script src='assets/js/contactform.js'></script>";
  echo "
<form>
    <div class='form-group'>
        <label for='categoryList'>Example select</label>
        <select class='form-control' id='categoryList'>
            
        </select>
    </div>
    <div class='form-group'>
        <l for='FormControlInput1'>Title</l>
            <input type='text' class='form-control' id='FormControlInput1' placeholder=''>
    </div>
       <div class='form-group'>
           <label for='Message-input' class='bmd-label-floating' style=''>Message</label>
               <textarea  class='form-control' id='Message-input' maxlength='600' style='color: black !important;  resize: none;'></textarea>
                        <p>Number of chars: <span id='sessionNum_counter'>600</span></p>
                        <div class='form-group'>
                                <button type='button' onclick='sendMessage()' class='btn btn-raised btn-primary' style='float: right; margin-left: auto'>
                                    <i class='material-icons' style='font-size: 25px;'>send</i>
                                </button>
                            </div>
                        </div>
                    </div>
"


?>


