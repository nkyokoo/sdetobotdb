<?php
include "connect.php";

class MessageCategory
{


    public function __getMessageCategory()
    {
        $connection = new DBConnection();

        $con = $connection->getConnection();
        $sql = "SELECT id_message_category, name FROM booking.message_category";
        $result = $con->prepare($sql);
        $result->execute();
        $result->store_result();
        $result->bind_result($id_message_category, $name);

        if ($result->num_rows > 0) {
            $json = array();
            while ($result->fetch()) {
                $json[] = array(
                    'id' => $id_message_category,
                    'name' => $name,
                );
            }
            $jsonstring = json_encode($json);
            return $jsonstring;
        } else {
            $json = array();
            $json[] = array(
                'error' => "database is empty",
            );

            $jsonstring = json_encode($json);
            return $jsonstring;
        }
    }

}

?>
