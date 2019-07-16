<?php 

include 'db_connect.php';
  
if(empty($_SESSION))
   session_start();

$login = (isset($_POST['login'])) ? $_POST['login'] : '' ;
$pass  = (isset($_POST['password'])) ? $_POST['password'] : '' ;
 
 $sql = "Select * FROM user WHERE
 usr_login = '$login' AND usr_pwd = '$pass' ;" ;
 
 $res = $dbs->query($sql);
 $data=$res->fetch();

if($data['usr_id']){
	$_SESSION['userid'] = $data["usr_id"];
	header('Location: manage_ticket.php');
}
else{
	header('Location: index.php');
}

?>