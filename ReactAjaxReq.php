<?php
include_once "dbcon.php";
$response="{'status': 'success'}";
$responsejson=json_encode($response);
/* function display()
{
    return $responsejson;
} */

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo 'post method recieved';
    $input = json_decode(file_get_contents('php://input'));
    $email = $input->email;
    $password = $input->password;

     //echo $email;
     //echo $password;
    if ($conn) {

        //echo "connection established successfully";

        $stmt = $conn->prepare('SELECT password FROM employeedetails WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $select = $stmt->execute();
        if ($select) {
            $result=$stmt->fetch(PDO::FETCH_OBJ);
           // echo "the password in request is".$password;  echo "<br/>";
            //echo "the password from database is ".$result->password;
            if($result->password == $password){
            
            echo $responsejson;
            }
            else {
                echo "credentials are wrong , enter valid credentials";
            }
        } else {
            echo "credentials are wrong , enter valid credentials";
        }
    } else {
        echo "connection not established";
    }
} else {
    echo 'not a post method';
}

?>