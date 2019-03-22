<?php


include_once "connect.php";

class WishListRequests
{

    function getRequestsFromDB()
    {
        $db = new DBConnection();
        $mysql = $db->getConnection();

        // Get Wish list Data
        $query = "Select * from wish_list where godkendt = 0";
        $result = $mysql->query($query);

        //If there's data to get
        if ($result->num_rows > 0)
        {

                    //Fetch all the associated data
            while ($row = $result->fetch_assoc())
            {
                //Upper body of the Elements ** Element = Html & Attributes
                echo
                    "
                    <div class='row'> 
                    <div class='col'>
                    <div class='card'>
                    <div class='card-body'>
                    ";

                //Get User Data
                $query2 = "select * from users where id =" . $row['user_id'] . " LIMIT 1";
                $result2 = $mysql->query($query2);
                if ($row2 = $result2->fetch_assoc())
                {


                    //get the user_group_id and find the correct group.
                    $group = "";
                    switch ($row2['user_group_id'])
                    {
                        case 1:
                            $group = "Admin";
                            break;
                        case 2:
                            $group = "Superuser";
                            break;
                        case 3:
                            $group = "User";
                            break;
                        default:
                            $group = "Failed to get data from user group";
                            break;
                    }
                    //Element Content
                    echo
                        "                    
                        <h5 class='card-title'>Username: " . $row2['name'] . "</h5>
                        <p class='card-subtitle mb-2 text-muted'>Group: <i>".$group."</i></p>
                        <p class='card-text'><b>Email: " . $row2['email'] . "</b></p>
                        ";
                }


                //Get Wish list Items Data
                $query3 = "select * from connection_product_wishlist where wish_list_id =".$row['id'];
                $result3 = $mysql->query($query3);
                while ($row3 = $result3->fetch_assoc())
                {
                    $query4 = "select product_name from school_products where id =".$row3['school_products_id']." LIMIT 1";
                    $result4 = $mysql->query($query4);
                    if ($result4->num_rows == 1)
                    {
                        $row4 = $result4->fetch_assoc();
                        //Element content
                        echo "<p><b>Product:</b> ".$row4['product_name']."<b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Quantity:</b> ".$row3['quantity']."</p>
                          ";

                    }
                }
                //Lower body of the Elements
                echo
                    "
                    <button id='btn-accept-" . $row['id'] . "')>Accept </button>
                    <button id='btn-deny-" . $row['id'] . "')>Deny </button>

                    </div>
                    </div>
                    </div>
                    </div>
                    ";
            }
        }
        else
        {
           echo "<b>There are no appending requests</b>";
        }
    }
    function acceptRequest($wislistID){
        $db = new DBConnection();
        $mysql = $db->getConnection();
        $wislistID = $mysql->real_escape_string($wislistID);
        $sql = "UPDATE `wish_list` SET `godkendt`= 1 WHERE id =".$wislistID;
        $stmt = $mysql->prepare('UPDATE `wish_list` SET `godkendt`= 1 WHERE id = ?');
        $stmt->bind_param('i',$wislistID);
        $stmt->execute();
    }
    function denyRequest($wislistID){
        $db = new DBConnection();
        $mysql = $db->getConnection();
        $wislistID = $mysql->real_escape_string($wislistID);
        $sql = "UPDATE `wish_list` SET `godkendt`= -1 WHERE id =".$wislistID;
        $stmt = $mysql->prepare('UPDATE `wish_list` SET `godkendt`= 1 WHERE id = ?');
        $stmt->bind_param('i',$wislistID);
        $stmt->execute();
    }

}