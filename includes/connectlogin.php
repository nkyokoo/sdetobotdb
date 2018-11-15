<?php
  include "../includes/connect.php";

  var_dump($link);
  die;
  if($_SERVER["REQUEST_METHOD"] === "POST"){

    $sql = "SELECT `id`, `username`, `password`, `rank` FROM `usertest` WHERE username = ".$myusername." AND password = ".$mypassword;

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];



    $result = $success->query($sql);
    /*Skal lave et loop for result*/

    $row = mysqli_fetc_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if($count == 1) {
      session_register("myusername");
      $_SESSION['rank'] = $row['rank'];
      $_SESSION['login_user'] = $myusername;

      header("../frontinclude/welcome.php");
    } else {
      $error = "Dit brugernavn eller adgangskode er forkert";
    }

  }
/*$_SERVER['REQUEST_METHOD']
contains the request method. It is used to check request method.This variable also says if the request is a 'GET', 'HEAD', 'POST' or 'PUT' request.*/

?>
