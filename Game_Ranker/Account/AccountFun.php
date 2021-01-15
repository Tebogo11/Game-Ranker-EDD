<?php

include("../functions.php");

function login($username,$password){
$conn = connect();
$result =$conn->prepare("SELECT * FROM user WHERE username = ? AND password ? ");
$result->execute([$username,$password]);
if ($result==true) 
{
     // Correct password : set up the authentication session variable
    // and store the username in it

    // Redirect to the main menu
    header ("Location: ../index.php");
}
else
{
   // The wrong password was supplied!
    echo "
    <div style='margin-top: 25px;' class='alert alert-danger' role='alert'>
    Incorrect password or Username
    </div>";
}
}

function Signup($username,$password){
    
    $conn = connect();
    $result =$conn->prepare("INSERT INTO user (username,password) VALUES (?,?) ");
    $result->execute([$username,$password]);
    if ($result == true) 
    {
    // Redirect to the main menu
    header ("Location: Login.php");
        }
        else
    {
   // The wrong password was supplied!
        echo "
            <div style='margin-top: 25px;' class='alert alert-danger' role='alert'>
            Something went wrong please try again
        </div>";
}

}  

?>
