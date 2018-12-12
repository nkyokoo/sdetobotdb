<?php


include "includes/header.php";
include "includes/navbar.php";
include "includes/sidebar.php";


$url = 'http://localhost/api/getcategories.php';
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
        <div class='col'>
            <div class='container'>
                <form>
                    <div class='form-group'>
                        <label for='categoryList'>Message Category </label>
                        <select class='form-control' id='categoryList'>
                           ";
                            foreach($json as $i){
                               echo "<option value='".$i['id']."'>".$i['name']."</option> ";
                           }
                    echo "
                        </select>
                    </div>
                    <div class='form-group'>
                        <l for='messageTitle'>Title</l>
                        <input type='text' class='form-control' id='messageTitle' placeholder=''>
                    </div>
                    <div class='form-group'>
                        <label for='Message-input' class='bmd-label-floating' style=''>Message</label>
                        <textarea class='form-control' id='Message-input' maxlength='600' style='color: black !important;  resize: none;'></textarea>
                        <p>Number of chars: <span id='sessionNum_counter'>600</span></p>
                        <div class='form-group'>
                            <button type='button' onclick='sendMail()' class='btn btn-raised btn-primary' style='float: right; margin-left: auto'>
                                <i class='material-icons' style='font-size: 25px;'>send</i>
                            </button>
                        </div>
                    </div>
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
include "includes/footer.php";
echo "<script src='assets/js/contactform.js'></script>";

?>


