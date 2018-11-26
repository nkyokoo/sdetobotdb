<?php
  include "connect.php";
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

  if($_SERVER["REQUEST_METHOD"] === "POST"){

      $myusername = $_POST['username'];
      $mypassword = $_POST['password'];

      $sql = "SELECT 'id', 'username', 'password', 'rank' FROM sdetest WHERE 'username' = $myusername AND 'password' = $mypassword";


    die;


    $result = $success->query($sql);
    /*Skal lave et loop for result*/

    $row = mysqli_fetc_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if($count == 1) {
      ses("myusername");
      $_SESSION['rank'] = $row['rank'];
      $_SESSION['login_user'] = $myusername;

       redirect("./frontinclude/welcome.php",200);
    } else {
        redirect("login.php",200);
      $error = "Dit brugernavn eller adgangskode er forkert";
    }

  }
/*$_SERVER['REQUEST_METHOD']
contains the request method. It is used to check request method.This variable also says if the request is a 'GET', 'HEAD', 'POST' or 'PUT' request.*/

?>
