<?php

include 'navbar.php';
$dbc = new PDO("mysql:host=localhost;dbname=ticketing" , "root", "");
$action = (isset($_POST["act"])) ? $_POST["act"] : ""; 
$id = (isset($_POST["id"])) ? $_POST["id"] : ""; 


$usr_id_upd       = "";
$usr_nom_upd      = "";
$usr_prenom_upd   = "";
$usr_email_upd    = "";
$usr_login_upd    = "";
$usr_pwd_upd      = "";
$usr_address_upd  = "";
$usr_tel_upd      = "";
$usr_del_upd      = "";   

if ($action == "N"){
    
	
    $usr_nom     = (isset($_POST["usr_nom"]))? $_POST["usr_nom"] : '';
    $usr_prenom  = (isset($_POST["usr_prenom"]))? $_POST["usr_prenom"] : '';
	$usr_email	 = (isset($_POST["usr_email"]))? $_POST["usr_email"] : '';
	$usr_login   = (isset($_POST["usr_login"]))? $_POST["usr_login"] : '';
	$usr_pwd     = (isset($_POST["usr_pass"]))? $_POST["usr_pass"] : '';
	$usr_address = (isset($_POST["usr_ville"]))? $_POST["usr_ville"] : '';
	$usr_tel     = (isset($_POST["usr_tel"]))? $_POST["usr_tel"] : '';
	$usr_del     = 0;
	
    
    if ($id == ""){
        $cmd = "INSERT INTO user (usr_id, usr_nom, usr_prenom, usr_email, usr_login, usr_pwd, usr_address, usr_tel, usr_del)
        VALUES
        (NULL, '$usr_nom', '$usr_prenom', '$usr_email', '$usr_login', '$usr_pwd', '$usr_address', '$usr_tel', '$usr_del');";
    }
    else{
        $cmd = " update user set usr_nom='$usr_nom',
                                   usr_prenom='$usr_prenom',
								   usr_email='$usr_email',
								   usr_login='$usr_login',
								   usr_pass='$usr_pass',
								   usr_dep='$usr_dep',
                                   usr_ville='$usr_ville',
								   usr_tel='$usr_tel'
                                   where usr_id = '$id';
                ";
    }
    
    $dbc->query($cmd);
    
}

if ($action == "M"){

    $cmd = "select * from user where usr_id = '$id' ;";
    $res = $dbc->query($cmd);
    $line = $res->fetch();

    $usr_id_upd       = $line["usr_id"];
    $usr_nom_upd      = $line["usr_nom"];
    $usr_prenom_upd   = $line["usr_prenom"];
	$usr_email_upd    = $line["usr_email"];
	$usr_login_upd    = $line["usr_login"];
	$usr_pwd_upd     = $line["usr_pwd"];
	$usr_address_upd    = $line["usr_address"];
    $usr_tel_upd      = $line["usr_tel"];
    $usr_del_upd      = $line["usr_del"];
    
    
}

if ($action == "S"){
    $cmd = "update user set usr_del=1 where usr_id='$id' ; ";
    $dbc->query($cmd);
}



$dbc = new PDO("mysql:host=localhost;dbname=ticketing" , "root", "");
$cmd= "select * from user";
$res = $dbc->query($cmd);
$table = $res->fetchAll();

?>

<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<!-- Bootstrap -->
    	<link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
		<link href="./fontawesome/css/all.css" rel="stylesheet">
		<title>Gestion des utilisateurs</title>	
</head>
<body>
<div class="container">
<h1> Gestion des utilisateurs </h1>
<div class="panel_with_buttons panel panel-default table-responsive">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left"><i class="fas fa-user left-menu-icons-account"></i> Utilisateurs</h1>
		<?php if($data['usr_role']=="admin") {?>
        <div class="btn-group pull-right">
                <a class="btn btn-primary" href="create_user.php" role="button">
                    <span class="glyphicon glyphicon-plus-sign"></span> Créer un nouvel utilisateur
                </a>
        </div>
		<?php } ?>
    </div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-responsive" width="100%">
	<thead>
		<td>Nom Utilisateur</td>
		<td>Prénom Utilisateur</td>
		<td>Email</td>
		<td>Login</td>
		<td>Mot de passe</td>
		<td>Adresse</td>
		<td>Tél</td>
		<td>Action</td>
	</thead>
	<thead>
		<form action="manage_users.php" method="post">
		<input type="hidden" name="act" value="N"> 
		<input type="hidden" name="id" value="<?php echo $usr_id_upd ; ?>">
		<td><input type="text" name="usr_nom" value="<?php echo $usr_nom_upd ; ?>" placeholder="Nom"></td>
		<td><input type="text" name="usr_prenom" value="<?php echo $usr_prenom_upd ; ?>"  placeholder="Prénom"></td>
		<td><input type="text" name="usr_email" value="<?php echo $usr_email_upd ; ?>"  placeholder="Email"></td>
		<td><input type="text" name="usr_login" value="<?php echo $usr_login_upd ; ?>"  placeholder="Login"></td>
		<td><input type="text" name="usr_pass" value="<?php echo $usr_pwd_upd ; ?>"  placeholder="Mot de passe"></td>
		<td><input type="text" name="usr_ville" value="<?php echo $usr_address_upd ; ?>"  placeholder="Ville"></td>
		<td><input type="text" name="usr_tel" value="<?php echo $usr_tel_upd ; ?>"  placeholder="N° Tél"></td>
		<td><?php if($data['usr_role']=="admin") {?><input type="submit" value="Ok"><?php }?></td>
		<td></td> 
		</form>
	</thead>
	

	<?php foreach ($table as $row ) {
		  if($row["usr_del"]==0) {?>
	<tr>
		<td><?php echo $row["usr_nom"]?></td>
		<td><?php echo $row["usr_prenom"]?></td>
		<td><?php echo $row["usr_email"]?></td>
		<td><?php echo $row["usr_login"]?></td>
		<td><?php echo $row["usr_pwd"]?></td>
		<td><?php echo $row["usr_address"]?></td>
		<td><?php echo $row["usr_tel"]?></td>
		<td> <?php if($data['usr_role']=="admin") {?>
    		<form action="manage_users.php" method="post">
    			<input type="hidden" name="id" value="<?php echo $row["usr_id"]?>">
    			<input type="hidden" name="act" value="M"> 
    			<input type="submit" value="Modifier">
    		</form>
			<?php }?>
		</td> 
		<td> <?php if($data['usr_role']=="admin") {?>
    		<form action="manage_users.php" method="post">
    			<input type="hidden" name="act" value="S"> 
    			<input type="hidden" name="id" value="<?php echo $row["usr_id"]?>">
    			<input type="submit" value="Supprimer">
    		</form>
			<?php }?>
		</td>
	</tr>
	<?php }}?>
</table>
</div>
</div>
</div>
</body>
</html>