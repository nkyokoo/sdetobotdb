<?php
//var_dump($_POST);

$register  = isset($_POST['register_btn']) ? true : false;
$logind  = isset($_POST['login_btn']) ? true : false;
$logout = isset($_POST['logout']) ? true : false;

if( $register or $logind ){
  include './auth.php';
  $name = isset($_POST['name']);
  $password = isset($_POST['password']);
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
