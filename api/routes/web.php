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

    return $data;

});

$router->get('/', function () use ($router) {

    echo "SDE BOOKING API";

});
//Check if there's enough quantity of specific item
$router->post('/api/booking/eventsforcart/productunitsinstock', function (Illuminate\Http\Request $request) use ($router) {

    include_once "../backend/eventsforcart.php";
    $class = new API_Cart();
    return $class->productUnitsInStock($request->input('pid'));

});

//Display cart items
$router->post('/api/booking/eventsforcart/display', function (Illuminate\Http\Request $request) use ($router) {

    include_once "../backend/eventsforcart.php";
    $class = new API_Cart();
    $class->display($request->input('pid'),$request->input('quantity'));

});

//Send booking request to acceptrequest.php
$router->post('/api/booking/bookingsend', function (Illuminate\Http\Request $request) use ($router) {
    include "../backend/bookingsend.php";

    $class = new BookingSendRequest();
    return $class->sendBooking($request->input('item'),$request->input('unitQuantity'));

});

//Display List of item you can book
$router->post('/api/booking/bookinglist', function () use ($router) {

    include "../backend/dropdownlistproducts_function.php";
    $class = new DropDownlistProducts_Function();
    $class->addProductsForSelection();

});

//Display acceptrequest.php Wishlist
$router->post('/api/admin/displayrequest', function () use ($router) {

        include "../backend/acceptrequest.php";
        $class = new WishListRequests();
        $class->getRequestsFromDB();

});

$router->post('/api/admin/acceptrequest', function (Illuminate\Http\Request $request) use ($router) {

    include "../backend/acceptrequest.php";
    $class = new WishListRequests();
    $class->acceptRequest($request->input('wishlistID'));

});
$router->post('/api/admin/denyrequest', function (Illuminate\Http\Request $request) use ($router) {

    include "../backend/acceptrequest.php";
    $class = new WishListRequests();
    $class->denyRequest($request->input('wishlistID'));

});