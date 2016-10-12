<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    include '../config.php';
    // getting data 
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
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

