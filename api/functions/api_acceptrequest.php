<?php

try {
    include "../backend/acceptrequest.php";

    $class = new AcceptRequestFromDB();
    $class->getRequestsFromDB();

}
catch (Exception $e) {
}