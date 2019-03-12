<?php
session_start();

include "includes/connect.php";
//call for the class of connect.php and the function getConnection.

$_SESSION['errors'] = array();

//$_SESSION['user_group_id'] = 0;
// call these variables with the global keyword to make them available in function
// variable declaration



class auth2test {

    //------------------------------------------------------------------------------------//

    // return user array from their id
    function getUserById($id){
        //Create connection to db.
        $DBConnections = new DBConnection();
        $db = $DBConnections->getConnection();

        $query = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);

        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    // REGISTER USER
    function register(){


        //Create connection to db.
        $DBConnections = new DBConnection();
        $db = $DBConnections->getConnection();


        // receive all input values from the form. Call the sqlinjection() function
        // defined below to escape form values
        $name    =  $db->real_escape_string($_POST['name']);
        $email       =  $db->real_escape_string( $_POST['email']);
        $password_1  =  $db->real_escape_string( $_POST['password_1']);
        $password_2  =  $db->real_escape_string( $_POST['password_2']);

        // form validation: ensure that the form is correctly filled
        if (empty($name)) {
            array_push($_SESSION['errors'], "Navn er påkrævet");
        }
        if (empty($email)) {
            array_push($_SESSION['errors'], "Email er påkrævet");
        }
        if (empty($password_1)) {
            array_push($_SESSION['errors'], "Password er påkrævet");
        }
        if ($password_1 != $password_2) {
            array_push($_SESSION['errors'], "passwords matcher ikke hinanden");
        }
        // name of this array dictionary.
        // $errordict = [
        //   empty($name) => "Navn er påkrævet",
        //   empty($email) => "Email er påkrævet",
        //   empty($password_1) => "Password er påkrævet",
        //   $password_1 != $password_2 => "Passwords matcher ikke hinanden"
        // ]
        // foreach($errordict as $error => $message){
        //   if($error){
        //     array_push($_SESSION['errors'], $message);
        //   }
        // }
        // register user if there are no errors in the form
        if (count($_SESSION['errors']) == 0) {
            $password = md5($password_1);//encrypt the password before saving in the database

            if (isset($_POST['user_group_id'])) {
                $user_group_id = $db->real_escape_string($_POST['user_group_id']);
                $query = "INSERT INTO users (name, email, password, user_group_id)
  					  VALUES('".$name."', '".$email."','".$password."', '".$user_group_id."')";
                $db->query($query);
                $_SESSION['success']  = "Ny bruger er oprettet!";
                header('location: admin/home.php');
            }else{
                $query = "INSERT INTO users (name, email, password, user_group_id)
  					  VALUES('".$name."', '".$email."', '".$password."', '3')";
                $db->query($query);



                // get id of the created user
                $logged_in_user = $db->insert_id;

                // check if id and group_id has matching values.
                $query = 'SELECT * FROM users WHERE id ='. $logged_in_user .' AND user_group_id = "3"';

                // execute $query.
                $results = $db->query($query);


                //fetch data to array
                $logged_in_user_val  = mysqli_fetch_assoc($results);
                /*    echo "tjekker om der er værdi i results som er konvertet til string til navn logged_in_user_val skal kigge efter http://php.net/manual/en/mysqli-result.fetch-array.php";
                    die;*/


                if ($logged_in_user_val['user_group_id'] == '3') {

                    //make a container for user_group_id data from  $logged_in_user_val
                    //make the vaiable for $logged_in_user.
                    if(empty($_SESSION['user_group_id'])) {
                        $_SESSION['user_group_id'] = $logged_in_user_val['user_group_id'];

                    }
                    if ($_SESSION['user_group_id'] == 3) {
                        $_SESSION['success']  = "Du er nu logget ind. og user_group_id burde sættes videre ";
                        $_SESSION['user_group_id'] = $logged_in_user_val['user_group_id'];
                        echo "Værdi på user_group_id   " . $_SESSION['user_group_id'];
                        header('location: index.php');

                    }elseif ($_SESSION['user_group_id'] == 0) {
                        $_SESSION['success']  = "Du er nu logget ind. men user_group_id sættes ikke videre ";
                        echo 'success'. $_SESSION['success'];
                    }else {
                        $_SESSION['success']  = "Du er ikke logget ind, user_group_id ikke retuneret.";
                        echo 'success'. $_SESSION['success'];
                    }
                }
            }
        }
    }
    //------------------------------------------------------------------------------------//



    function display_error() {
        if (count($_SESSION['errors']) > 0){
            echo '<div class="error">';
            foreach ($_SESSION['errors'] as $error){
                echo $error .'<br>';
            }
            echo '</div>';
        }
    }

    function isLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }else{
            return false;
        }
    }


    // LOGIN USER
    function login($name, $password){
        //Connection to db.
        $DBConnections = new DBConnection();
        $db = $DBConnections->getConnection();
        //  $errors = $_SESSION['errors'];


        // make sure form is filled properly
        if (empty($name)) {
            array_push($_SESSION['errors'], "Navn er påkrævet");
        }
        if (empty($password)) {
            array_push($_SESSION['errors'], "Password er påkrævet");
        }
        // attempt login if no errors on form
        if (count($_SESSION['errors']) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE name='".$name."' AND password='".$password."' LIMIT 1";
            $results = mysqli_query($db, $query);


            if (mysqli_num_rows($results) == 1) { // user found
                // check if user is admin or user
                $logged_in_user = mysqli_fetch_assoc($results);

                if ($logged_in_user['user_group_id'] == '1') {

                    $_SESSION['user_group_id'] = $logged_in_user['user_group_id'];

                    $_SESSION['success']  = "Du er nu logget ind som admin!";


                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success']  = "Du er nu logget ind!";
                    //header('location: admin/home.php');*/
                }elseif ($logged_in_user['user_group_id'] == '2'){

                    $_SESSION['user_group_id'] = $logged_in_user['user_group_id'];


                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success']  = "Du er nu logget ind som Superuser!";

                    //for statement $logged_in_user['user_group_id']
                }elseif ($logged_in_user['user_group_id'] == '3') {

                    ;
                    $_SESSION['success']  = "Du er nu logget ind user!";
                    $_SESSION['user_group_id'] = $logged_in_user['user_group_id'];


                }
                $_SESSION['user_group_id'] = $logged_in_user['user_group_id'];

            }
            else {
                array_push($_SESSION['errors'], "Wrong name/password combination");
            }

        }
    }
    //------------------------------------------------------------------------------------//
    function isAdmin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_group_id'] == '1' ) {
            return true;
        }else{
            return false;
        }
    }
}
//------------------------------------------------------------------------------------//
