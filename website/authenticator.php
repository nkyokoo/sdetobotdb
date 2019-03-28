<?php
session_start();
$logout = isset($_POST['logout']) ? true : false;

if (isset($_POST['login_btn'])) {
    $url = 'http://localhost:8000/api/users/login';
    $data = array(
        'email' => $_POST['email'],
        'password' =>  $_POST['password']
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $jsondata = json_decode($result,true);
    if ($jsondata['code'] == 200 ) {

        $_SESSION['user'] = $jsondata['user'][0];
        header('Location: ../index.php');



    }else{

        header('Location: ../login.php');

    }

}
if (isset($_POST['register_btn'])) {
    $url = 'http://localhost:8000/api/users/register';
    $data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' =>  $_POST['password_1']
    );

// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
//send request to api and get result
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $jsondata = json_decode($result,true);

    if ($jsondata["message"] == 200) {

        header('Location: /login.php');

    }else{

        header('Location: /register.php');

    }
}

if($logout){
    unset($_SESSION);
    session_destroy();
    session_write_close();
    echo "done";
    exit();
    //close and kill sessions.
}