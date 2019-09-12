<?php
session_start();
$url = 'http://localhost:8000/api/users/get';
$options = array(
    'http' => array(
        'method' => 'GET',
        'header' => 'Authorization: '.$_SESSION['user']['token'],
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
