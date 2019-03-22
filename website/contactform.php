<?php
include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";
$url = 'http://localhost:8000/api/mail/category/get';
$content = file_get_contents($url);
$json = json_decode($content, true);
echo "
 <div class='container'>
    <div class='row'>
        <div class='col col-sm-4'>
        </div>
        <div class='col col-sm-4'>
        </div>
        <div class='col col-sm-4'>
        </div>
    </div>
    <div class='row'>
        <div class='col'></div>
        <div class='col'></div>
  <div class=\"card\" style=\"width: 18rem;\">
    <div class=\"card-header\">
        Contact form
    </div>
    <div class=\"card-body\">
        <form>
           <div class=\"form-group\">
            <label for=\"exampleSelect1\" class=\"bmd-label-floating\">Example select</label>
            <select class=\"form-control\" id=\"exampleSelect1\">
                    ";
                    foreach($json as $i){
                    echo "<option value='".$i['id']."'>".$i['name']."</option> ";
                    }
                    echo "
                </select>
           </div>
            <div class='form-group'>
                <label class='bmd-label-floating' for='messageTitle'>Title</label>
                <input type='text' class='form-control' id='messageTitle' placeholder=''>
            </div>
            <div class='form-group'>
                <label for='Message-input' class='bmd-label-floating' style=''>Message</label>
                <textarea class='form-control' id='Message-input' maxlength='600' style='color: black !important;  resize: none;'></textarea>
                <p>Number of chars: <span id='sessionNum_counter'>600</span></p>
                <div class='form-group'>
                    <button type='button' onclick='sendMail()' class='btn btn-raised btn-danger' >
                        <i class='material-icons'>send</i>
                    </button>
                </div>
            </div>
            </form>
    </div>
</div>
    <div class='col'></div>
    <div class='col'></div>
    <div class='col'></div>
</div>
<div class='row'>
    <div class='col col-sm-4'>
    </div>
    <div class='col ol-sm-4'>
    </div>
    <div class='col col-sm-4'>
    </div>
</div>
</div>
";

echo "<script src='assets/js/contactform.js'></script>";
include "includes/footer.php";
?>
