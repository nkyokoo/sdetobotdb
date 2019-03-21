<?php

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
    include_once "../backend/messagecategory.php";

    $category = new MessageCategory();
    $data = $category->__getMessageCategory();

    echo $data;

});

$router->get('/', function () use ($router) {

    echo "SDE BOOKING API";

});

$router->post('/api/booking/eventsforcart/productunitsinstock', function (Illuminate\Http\Request $request) use ($router) {

    include_once "../backend/eventsforcart.php";
    $class = new API_Cart();
    return $class->productUnitsInStock($request->input('pid'));

});

$router->post('/api/booking/eventsforcart/display', function (Illuminate\Http\Request $request) use ($router) {

    include_once "../backend/eventsforcart.php";
    $class = new API_Cart();
    $class->display($request->input('pid'),$request->input('quantity'));

});

$router->post('/api/booking/bookingsend', function (Illuminate\Http\Request $request) use ($router) {
    include "../backend/bookingsend.php";

    $class = new BookingSendRequest();
    return $class->sendBooking($request->input('item'),$request->input('unitQuantity'));

});

$router->post('/api/booking/bookinglist', function () use ($router) {

    include "../backend/dropdownlistproducts_function.php";
    $class = new DropDownlistProducts_Function();
    $class->addProductsForSelection();

});

$router->post('/api/booking/acceptrequest', function () use ($router) {

        include "../backend/acceptrequest.php";
        $class = new AcceptRequestFromDB();
        $class->getRequestsFromDB();

});