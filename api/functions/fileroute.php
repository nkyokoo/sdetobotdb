<?php
//var_dump($_POST);

$register  = isset($_POST['register_btn']) ? true : false;
$logind  = isset($_POST['login_btn']) ? true : false;
$logout = isset($_POST['logout']) ? true : false;
//check if the vaiable get any post.

if( $register or $logind ){
  include './auth.php';
  $name = isset($_POST['name']) ? $_POST['name'] : false;
  $password = isset($_POST['password']) ? $_POST['password'] : false;
  // call the register() function if register_btn is clicked
  $class = new auth2test();
  if($register){
    $class->register();
    //call the function form auth.php
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
    //close and kill sessions. 
}