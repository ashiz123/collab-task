<?php


if(isset($_SESSION['auth_user'])){
    $user = $_SESSION['auth_user'];
    
    echo $user['firstname']. ' is logged in';
}else{
    echo 'not logged in';
}
?>