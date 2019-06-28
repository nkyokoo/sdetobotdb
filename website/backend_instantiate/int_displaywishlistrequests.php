
<?php
include_once '../backend_web/displaywishlistrequests.php';
try{
    $class = new displaywishlistrequests();
    $class->getWishlistRequests();
}
catch (Exception $e){


}