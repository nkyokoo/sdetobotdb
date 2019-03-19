<?php
include_once "../backend/messagecategory.php";

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('api/mail/category/get', function () use ($router) {

    $category = new MessageCategory();
    $data = $category->__getMessageCategory();

    echo $data;

});
$router->get('/', function () use ($router) {

    echo "SDE BOOKING API";

});
$router->get('/api/booking/cart', function () use ($router) {

   include "../functions/api_displaycart.php";

});

