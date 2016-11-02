<?php
session_start();
if (isset($_POST['uCreds']['uName']) && isset($_POST['uCreds']['uPass'])) {
    
    include '../../phpCode/config.php';
    echo "GREAT JOB! CONNECTED TO SERVER!!";
    // getting data 
    $username = trim($_POST['uCreds']['uName']);
    $password = trim($_POST['uCreds']['uPass']);
    $password = hash("sha256",$password);
    $sql = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
    echo "SENDING QUERY !!!";
    $result = $conn->query($sql);
    echo "QUERY COMPLETE!!"

     if ($result->num_rows > 0) {
         $_SESSION['username'] = $username;
       echo json_encode(TRUE);
    } else {
        echo json_encode(FALSE);
    }
    $conn->close();
}
else
{
   $_SESSION['username'] = 'root';
}
?>

