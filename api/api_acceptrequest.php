<?php
include "../backend/acceptrequest.php";

try {
    $class = new AcceptRequestFromDB();
    $class->getRequestsFromDB();

}
    catch (Exception $e) {
}