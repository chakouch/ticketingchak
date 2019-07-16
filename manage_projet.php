<?php
include 'navbar.php';
$action = (isset($_POST["act"])) ? $_POST["act"] : ""; 
$id = (isset($_POST["id"])) ? $_POST["id"] : ""; 


$prj_id_upd       = "";
$prj_cli_nom_upd  = "";
$prj_usr_nom_upd  = "";
$prj_nom_upd      = "";
$prj_date_upd	  = "";
$cli_del_upd      = "";   

if ($action == "N"){
    
	
    $prj_nom     = (isset($_POST["prj_nom"]))? $_POST["prj_nom"] : '';
	$prj_cli_nom = (isset($_POST["prj_cli_nom"]))? $_POST["prj_cli_nom"] : '';
	$prj_usr_nom = (isset($_POST["prj_usr_nom"]))? $_POST["prj_usr_nom"] : '';
	$prj_date    = date('Y-m-d G:i:s');
	$cli_del     = 0;
	
    
    if ($id == ""){
        $cmd = "INSERT INTO projet (prj_id, prj_cli_nom, prj_usr_nom, prj_nom, prj_date, prj_del)
        VALUES
        (NULL, '$prj_cli_nom', '$prj_usr_nom', '$prj_nom', '$prj_date', '$cli_del');";
    }
	
    else{
        $cmd = " update projet set prj_nom='$prj_nom',  						  
								   prj_date='$prj_date'
                                   where prj_id = '$id';
                ";
    }
    
    $dbs->query($cmd);
    
}

if ($action == "M"){

    $cmd = "select * from projet where prj_id = '$id' ;";
    $res = $dbs->query($cmd);
    $line = $res->fetch();

    $prj_id_upd       = $line["prj_id"];
    $prj_nom_upd      = $line["prj_nom"];
	$prj_date_upd    = $line["prj_date"];
    $prj_del_upd      = $line["prj_del"];
    
    
}

if ($action == "S"){
    $cmd = "update projet set prj_del=1 where prj_id='$id' ; ";
    $dbs->query($cmd);
}



$cmd= "select * from projet";
$res = $dbs->query($cmd);
$table = $res->fetchAll();

$client = "select * from client";
$cli = $dbs->query($client);
$clients = $cli->fetchAll();

$user = "select * from user";
$us = $dbs->query($user);
$users = $us->fetchAll();

?>

<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<!-- Bootstrap -->
		<link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
		<link href="./fontawesome/css/all.css" rel="stylesheet">
		<title>Gestion des projets</title>	
</head>
<body>
<div class="container">
<h1> Gestion des projets </h1>
<div class="panel_with_buttons panel panel-default table-responsive">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left"><i class="fas fa-user left-menu-icons-account"></i> Projet</h1>
        <div class="btn-group pull-right">
                <a class="btn btn-primary" href="create_projet.php" role="button">
                    <span class="glyphicon glyphicon-plus-sign"></span> Créer un nouveau projet
                </a>
        </div>
    </div>
<div class="table-responsive">
<table class="table table-hover">
	<thead>
		<td>Nom projet</td>
		<td>Nom client</td>
		<td>Nom utilisateur</td>
		<td>Date</td>
		<td>Action</td>
	</thead>
	<thead>
		<form action="manage_projet.php" method="post">
		<input type="hidden" name="act" value="N"> 
		<input type="hidden" name="id" value="<?php echo $prj_id_upd ; ?>">
		<td><input type="text" name="prj_nom" value="<?php echo $prj_nom_upd ; ?>" placeholder="Nom"></td>
		<td><input type="text" name="prj_cli_nom" value="<?php echo $prj_cli_nom_upd ; ?>" placeholder="Client" disabled></td>
		<td><input type="text" name="prj_usr_nom" value="<?php echo $prj_usr_nom_upd ; ?>" placeholder="Utilisateur" disabled></td>
		<td><input type="text" name="prj_date" value="<?php echo $prj_date_upd ; ?>" placeholder="Nom"></td>
		<td><input type="submit" value="Valider"></td>
		<td></td> 
		</form>
	</thead>

      </div>
      <div class="modal fade" id="formulaire">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Vos infos :</h4>              
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body row">
              <form class="col" action="test.php">
                <div class="form-group">
                  <label for="nom" class="form-control-label">Nom</label>
                  <input type="text" class="form-control" name ="nom" id="nom" placeholder="Votre nom">
                </div>
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
              </form>
            </div>
          </div>
        </div>

	<?php foreach ($table as $row ) {
		  if($row["prj_del"]==0) {?>
	<tr>
		<td><?php echo $row["prj_nom"]?></td>
		<td><?php echo $row["prj_cli_nom"]?></td>
		<td><?php echo $row["prj_usr_nom"]?></td>
		<td><?php echo $row["prj_date"]?></td>
		<td> 
    		<form action="manage_projet.php" method="post" data-toggle="modal" data-target="#formulaire">
    			<input type="hidden" name="id" value="<?php echo $row["prj_id"]?>">
    			<input type="hidden" name="act" value="M"> 
    			<input type="submit" value="Modifier">
    		</form>
		</td> 
		<td> 
    		<form action="manage_projet.php" method="post">
    			<input type="hidden" name="act" value="S"> 
    			<input type="hidden" name="id" value="<?php echo $row["prj_id"]?>">
    			<input type="submit" value="Supprimer">
    		</form>
		</td>
	</tr>
		  <?php }} ?>
</table>
</div>
</div>
</body>
</html>