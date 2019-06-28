<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 22/03/2019
 * Time: 08.40
 */
include "../admin/admin_includes/adminprotection.php";
include_once "../backend_web/wishlistrequests.php";
$class = new WishListRequest();

//$accept = $_POST['accept'] == true ? true:false;
$wishlistID = $_POST['wishlistID'];
//false
$accept = $_POST['accept'];

//if accept is true then accept request else deny request
if ($accept === "1")
{
    $class->acceptRequest($wishlistID);
}

 else if ($accept === "0")
{
    $class->denyRequest($wishlistID);
}
else{
    echo "ERROR 405";
}