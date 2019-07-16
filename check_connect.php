<?php 
session_start();
$login =  (isset($_POST['login']))? $_POST['login'] : '' ;
$pass  =  (isset($_POST['password']))? $_POST['password'] : '' ;

if(($login == "admin") and ($pass == "admin")){
	$_SESSION['isloged'] = "true";
    header('Location: board.php');
}
else{
    header('Location: index.php');
}


?>