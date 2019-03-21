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
/*
 *  Use these 3 Lines for CORS (Access-Control-Allow-Origin) if nothing works.
 *
 *  header('Access-Control-Allow-Origin: *');
 *  header('Access-Control-Allow-Methods:POST,GET,DELETE,PUT');
 *  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');
 */



$router->get('api/mail/category/get', function () use ($router) {

    $category = new MessageCategory();
    $data = $category->__getMessageCategory();

    echo $data;

});
$router->get('/', function () use ($router) {

    echo "SDE BOOKING API";

});
$router->post('/api/booking/cart', function () use ($router) {

    include "../functions/api_displaycart.php";




});
$router->post('/api/booking/eventsforcarts', function () use ($router) {
    include_once "../backend/eventsforcart.php";



});
$router->post('/api/booking/bookingsend', function () use ($router) {
    include "../functions/api_bookingsend.php";


});
$router->post('/api/booking/bookinglist', function () use ($router) {
    include "../functions/api_dropdownlistproducts_function.php";

});
$router->post('/api/booking/acceptrequest', function () use ($router) {

    try {
        include "../backend/acceptrequest.php";

        $class = new AcceptRequestFromDB();
        $class->getRequestsFromDB();

    }
    catch (Exception $e) {
    }

});