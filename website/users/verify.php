<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (isset($_SESSION['user'])) {
    header('location: ../index.php');
}
$jsondata = null;
if(!isset($_GET['key'])){
    header("Location: /index");
}else{
    $url = 'http://localhost:8000/api/users/verification/check';
    $data = array(
        'key' => $_GET['key'],
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/json",
            'method' => 'POST',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);
    $jsondata = json_decode($result, true);


}
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>

<div class="container">

    <div class="row">
        <div class="col-6 col-md-4"></div>
        <div class="col-6 col-md-4">
            <div class="card">
                <div class="card-header">
                    Verifcation
                </div>
                <div class="card-body">
                    <?php
                        if($jsondata["code"] !== 200){
                            echo "<p>".$jsondata['error']."<p>";
                        }else{
                            echo"<p>Hej, ".$jsondata['data']['name']."<p>";
                            $url = 'http://localhost:8000/api/users/verify';
                            $data = array(
                                'email' => $jsondata['data']['email'],
                            );

// use key 'http' even if you send the request to https://...
                            $options = array(
                                'http' => array(
                                    'header' => "Content-type: application/json",
                                    'method' => 'PATCH',
                                    'content' => json_encode($data)
                                )
                            );
//send request to api and get result
                            $context = stream_context_create($options);
                            $result = file_get_contents($url, false, $context);
                            $jsondata = json_decode($result, true);

                            if ($jsondata['code'] == 200) {

                                echo $jsondata['message'];


                            } else {

                                echo $jsondata['error'];

                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4"></div>
    </div>


</div>

<?php
include '../includes/footer.php';


