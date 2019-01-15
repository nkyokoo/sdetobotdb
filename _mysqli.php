<?php
$connection = new mysqli("localhost", "root", "root", "sdetest");
if ($connection->connect_errno)  {
   die('kan ikke forbinde (' . $connection->connect_errno . ')'.$connection->connect_error);
}
$connection->set_charset("utf8");
?>