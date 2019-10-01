<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
                        if($jsondata["code"] === 400){
                            echo "<p>".$jsondata['error']."<p>";
                        }else if($jsondata["code"] == 200){
                            echo"<p>Hej, ".$jsondata['data']['name']."<p>";
                            echo"<p>klik på knappen for aktivér din bruger";
                            echo "<form action='../backend_instantiate/int_user.php' method='post'>";
                            echo"<button class='btn btn-raised btn-primary' type='button' id='verifybutton'>aktivér bruger</button>";
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


