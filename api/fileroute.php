<?php
//var_dump($_POST);

$register  = $_POST['register_btn'] ?? false;
$logind  = isset($_POST['login_btn']) ? true : false;
$logout = $_POST['logout'] ?? false;

if( $register or $logind ){
  include './auth.php';
  $name = $_POST['name'];
  $password = $_POST['password'];
  // call the register() function if register_btn is clicked
  $class = new auth2test();
  if($register){
    $class->register();
  }
  if($logind){
    $class->login($name,$password);
  }
}

if($logout){
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    echo "done";
    exit();
}