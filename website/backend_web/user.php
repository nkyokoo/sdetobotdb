<?php
session_start();

class user
{
    private $message = "";

    function getUser()
    {
        return user::class;
    }

    function createUser($name, $email, $password, $password2, $user_type)
    {

        if ($password == $password2) {
            $url = 'http://localhost:8000/api/admin/user/create';
            $data = array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'rank' => $user_type,

            );// use key 'http' even if you send the request to https://...
            $options = array(
                'http' => array(
                    'header' => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                    'method' => 'POST',
                    'content' => json_encode($data)
                )
            );//send request to api and get result
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $jsondata = json_decode($result, true);
            if ($jsondata["code"] == 200) {
                http_response_code($jsondata["code"]);
                $this->setMessage($jsondata["message"]);

            } else {

                http_response_code($jsondata["code"]);
                $this->setMessage($jsondata["error"]);

            }
        } else {
            http_response_code(400);
            echo "adgangskode matcher ikke";
        }
    }

    function changePassword($currentpassword, $newpaassword)
    {

        $url = 'http://localhost:8000/api/user/updatepassword';
        $data = array(
            'updatetype' => 'password',
            'id' => $_SESSION['user']['id'],
            'currentpassword' => $currentpassword,
            'newpassword' => $newpaassword,

        );// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                'method' => 'PATCH',
                'content' => json_encode($data)
            )
        );//send request to api and get result
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $jsondata = json_decode($result, true);
        if ($jsondata["code"] == 200) {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["message"]);
        } else {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["error"]);
        }


    }

    function disableUser($userid)
    {
        $url = 'http://localhost:8000/api/admin/user/disable';
        $data = array(
            'id' => $userid,

        );// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                'method' => 'DELETE',
                'content' => json_encode($data)
            )
        );//send request to api and get result
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $jsondata = json_decode($result, true);
        if ($jsondata["code"] == 200) {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["message"]);
        } else {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["error"]);
        }
    }

    function changeName($name){
        $url = 'http://localhost:8000/api/user/updatename';
        $data = array(
            'name' => $name,
            'id' => $_SESSION['user']['id'],


        );// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                'method' => 'PATCH',
                'content' => json_encode($data)
            )
        );//send request to api and get result
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $jsondata = json_decode($result, true);
        if ($jsondata["code"] == 200) {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["message"]);
        } else {
            http_response_code($jsondata["code"]);
            $this->setMessage($jsondata["error"]);
        }

    }

    function getMessage()
    {

        return $this->message;
    }

    private
    function setMessage($sentMessage)
    {
        $this->message = $sentMessage;
    }


}