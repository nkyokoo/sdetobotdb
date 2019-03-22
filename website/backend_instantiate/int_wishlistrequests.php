<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 22/03/2019
 * Time: 08.40
 */
include "../admin/adminprotection.php";
include_once "../backend_web/wishlistrequests.php";
$class = new WishListRequest();

$accept = $_POST['accept'] ? true:false;
$wishlistID = $_POST['wishlistID'];
//if accept is true then accept request else deny request
if ($accept)
{
    $class->acceptRequest($wishlistID);
}
else
{
    $class->denyRequest($wishlistID);
}