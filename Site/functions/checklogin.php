<?php
session_start();
if (isset($_POST['uName']) && isset($_POST['uPass'])) {
    
    include '../../phpCode/config.php';
    // getting data 
    $username = trim($_POST['uName']);
    $password = trim($_POST['uPass']);
    $password = hash("sha256",$password);
    $sql = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
    $result = $conn->query($sql);
 
     if ($result->num_rows > 0) {
         $_SESSION['username'] = $username;
       echo json_encode(TRUE);
    } else {
        echo json_encode(FALSE);
    }
    $conn->close();
}
?>

