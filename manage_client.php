<?php
include 'navbar.php';
include 'db_connect.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : ""; 
$id = (isset($_POST["id"])) ? $_POST["id"] : ""; 

$cli_id_upd       = "";
$cli_nom_upd      = "";
$cli_address_upd  = "";
$cli_email_upd	  = "";
$cli_tel_upd      = "";
$cli_del_upd      = "";   

if ($action == "N"){
    
	
    $cli_nom     = (isset($_POST["cli_nom"]))? $_POST["cli_nom"] : '';
	$cli_address = (isset($_POST["cli_address"]))? $_POST["cli_address"] : '';
	$cli_email	 = (isset($_POST["cli_email"]))? $_POST["cli_email"] : '';	
	$cli_tel     = (isset($_POST["cli_tel"]))? $_POST["cli_tel"] : '';
	$cli_del     = 0;
	
    
    if ($id == ""){
        $cmd = "INSERT INTO client (cli_id, cli_nom, cli_address, cli_email, cli_tel, cli_del)
        VALUES
        (NULL, '$cli_nom','$cli_address', '$cli_email', '$cli_tel', '$cli_del');";
    }
    else{
        $cmd = " update client set cli_nom='$cli_nom',  
								   cli_address='$cli_address',
								   cli_email='$cli_email',
								   cli_tel='$cli_tel'
                                   where cli_id = '$id';
                ";
    }
    
    $dbs->query($cmd);
    
}

if ($action == "M"){

    $cmd = "select * from client where cli_id = '$id' ;";
    $res = $dbs->query($cmd);
    $line = $res->fetch();

    $cli_id_upd       = $line["cli_id"];
    $cli_nom_upd      = $line["cli_nom"];
	$cli_address_upd  = $line["cli_address"];
	$cli_email_upd    = $line["cli_email"];
    $cli_tel_upd      = $line["cli_tel"];
    $cli_del_upd      = $line["cli_del"];
    
    
}

if ($action == "S"){
    $cmd = "update client set cli_del=1 where cli_id='$id' ; ";
    $dbs->query($cmd);
}


$cmd= "select * from client";
$res = $dbs->query($cmd);
$table = $res->fetchAll();

?>

<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<link href="./fontawesome/css/all.css" rel="stylesheet">
		<title>Gestion des clients</title>	
</head>
<body>
<div class="container">
<h1> Gestion des clients </h1>
<div class="panel_with_buttons panel panel-default table-responsive">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left"><i class="fas fa-user left-menu-icons-account"></i> Clients</h1>
        <div class="btn-group pull-right">
                <a class="btn btn-primary" href="create_client.php" role="button">
                    <span class="glyphicon glyphicon-plus-sign"></span> Créer un nouveau client
                </a>
        </div>
    </div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-responsive" width="100%">
	<thead>
		<td>Nom client</td>
		<td>Adresse</td>
		<td>Email</td>
		<td>Tél</td>
		<td>Action</td>
	</thead>
	<thead>
		<form action="manage_client.php" method="post">
		<input type="hidden" name="act" value="N"> 
		<input type="hidden" name="id" value="<?php echo $cli_id_upd ; ?>">
		<td><input type="text" name="cli_nom" value="<?php echo $cli_nom_upd ; ?>" placeholder="Nom"></td>
		<td><input type="text" name="cli_address" value="<?php echo $cli_address_upd ; ?>"  placeholder="Adresse"></td>
		<td><input type="text" name="cli_email" value="<?php echo $cli_email_upd ; ?>"  placeholder="Email"></td>
		<td><input type="text" name="cli_tel" value="<?php echo $cli_tel_upd ; ?>"  placeholder="N° Tél"></td>
		<td><input type="submit" value="Valider"></td>
		<td></td> 
		</form>
	</thead>
	

	<?php foreach ($table as $row ) {
		  if($row["cli_del"]==0) {?>
	<tr>
		<td><?php echo $row["cli_nom"]?></td>
		<td><?php echo $row["cli_address"]?></td>
		<td><?php echo $row["cli_email"]?></td>
		<td><?php echo $row["cli_tel"]?></td>
		<td> 
    		<form action="manage_client.php" method="post">
    			<input type="hidden" name="id" value="<?php echo $row["cli_id"]?>">
    			<input type="hidden" name="act" value="M"> 
    			<input type="submit" value="Modifier">
    		</form>
		</td> 
		<td> 
    		<form action="manage_client.php" method="post">
    			<input type="hidden" name="act" value="S"> 
    			<input type="hidden" name="id" value="<?php echo $row["cli_id"]?>">
    			<input type="submit" value="Supprimer">
    		</form>
		</td>
	</tr>
		  <?php }} ?>
</table>
</div>
</div>
</div>
</body>
</html>