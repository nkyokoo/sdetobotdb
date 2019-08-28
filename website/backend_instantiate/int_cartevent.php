<?php
session_start();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

if (isset($_SESSION['cart'])) {
   echo count($_SESSION['cart']);
    flush();

}
