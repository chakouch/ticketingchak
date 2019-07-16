<?php 


include 'connect_to_database.php'; //connect the connection page
  
if(empty($_SESSION)) // if the session not yet started 
   session_start();

$login = (isset($_POST['login'])) ? $_POST['login'] : '' ;
$pass  = (isset($_POST['password'])) ? $_POST['password'] : '' ;

 //$username = $_POST['user'];
 //$password = $_POST['pass'];
 
// $bdd = new PDO("mysql:host=localhost;dbname=ticketing", "root", "");
 
 //$sql = "Select COUNT(*) AS nbr FROM utilisateurs WHERE
 //user_login = '$login' AND user_pass = '$pass' ;" ;
 
 $sql = "Select * FROM user WHERE
 usr_login = '$login' AND usr_pwd = '$pass' ;" ;
 
 $res = $dbs->query($sql);
 $data=$res->fetch();

if($data['usr_id']){
	//$_SESSION['isloged'] = "true";
	//$_SESSION['username'] = $_POST['moha'];
	$_SESSION['userid'] = $data["usr_id"];
	header('Location: manage_ticket.php');
}
else{
	header('Location: index.php');
}

?>