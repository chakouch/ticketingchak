<?php
include 'navbar.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : ""; 
$id = (isset($_POST["id"])) ? $_POST["id"] : ""; 


$tck_id_upd             = "";
$tck_client_upd         = "";
$tck_titre_upd          = "";
$tck_description_upd    = "";
$tck_date_upd           = "";
$tck_urgence_upd        = "";
$tck_createur_upd       = "";
$intervenant_upd        = "";
$intervention_upd       = "";
$intervenantCloture_upd = "";
$tck_del_upd            = "";

if ($action == "N"){

   	$tck_client 		= (isset($_POST["tck_client"]))? $_POST["tck_client"] : '';
	$tck_titre			= (isset($_POST["tck_titre"]))? $_POST["tck_titre"] : '';
	$tck_description	= (isset($_POST["tck_description"]))? $_POST["tck_description"] : '';
    $tck_date			=  date('Y-m-d H:i:s');
	$tck_urgence		= (isset($_POST["tck_urgence"]))? $_POST["tck_urgence"] : '';
	$tck_createur		= (isset($_POST["tck_createur"]))? $_POST["tck_createur"] : '';
	$intervenant		= (isset($_POST["intervenant"]))? $_POST["intervenant"] : '';
	$intervention		= (isset($_POST["intervention"]))? $_POST["intervention"] : '';
	$intervenantCloture = (isset($_POST["intervenantCloture"]))? $_POST["intervenantCloture"] : '';
	$dateCloture		=  date('Y-m-d H:i:s');
	$tck_del = 0;
	
    if ($id == ""){
        $cmd = "INSERT INTO ticket (tck_id, tck_client, tck_titre, tck_description, tck_date, tck_urgence, tck_createur, intervenant, intervenantCloture, intervention, dateCloture, tck_del)
        VALUES
        (NULL, '$tck_client', '$tck_titre', '$tck_description', '$tck_date', '$tck_urgence', '$tck_createur', '$intervenant', '$intervenantCloture', $intervention, '$dateCloture', '$tck_del');";
		echo $cmd ;
    }
    else{
        $cmd = " update ticket set tck_client='$tck_client',
                                   tck_titre='$tck_titre',
								   tck_description='$tck_description',
								   tck_date='$tck_date',
								   tck_urgence='$tck_urgence',
								   tck_createur='$tck_createur',
								   intervenant='$intervenant',
                                   intervenantCloture='$intervenantCloture',
								   intervention = '$intervention',
								   dateCloture='$dateCloture'
                                   where tck_id = '$id';
                ";
    }
    //echo $cmd;
    $dbs->query($cmd);
    
}

if ($action == "M"){

    $cmd = "select * from ticket where tck_id = '$id' ;";
    $res = $dbs->query($cmd);
    $line = $res->fetch();

    $tck_id_upd       		= $line["tck_id"];
    $tck_client_upd      	= $line["tck_client"];
    $tck_titre_upd   		= $line["tck_titre"];
	$tck_description_upd   	= $line["tck_description"];
	$tck_date_upd    		= $line["tck_date"];
	$tck_urgence_upd    	= $line["tck_urgence"];
	$tck_createur_upd     	= $line["tck_createur"];
	$intervenant_upd      	= $line["intervenant"];
	$intervenantCloture_upd	= $line["intervenantCloture"];
	$intervention	      	= $line["intervention"];
    $tck_del_upd      		= $line["tck_del"];
}

if ($action == "S"){
    $cmd = "update ticket set tck_del=1 where tck_id='$id' ; ";
    $dbs->query($cmd);
}



$cmd= "select * from ticket";
$res = $dbs->query($cmd);
$table = $res->fetchAll();

?>

<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<!-- Bootstrap -->
    	<link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
		<link href="./fontawesome/css/all.css" rel="stylesheet">
		<title>Gestion des tickets</title>	
</head>
<body>
<div class="container">
<h1> Gestion des tickets </h1>

<div class="panel_with_buttons panel panel-default table-responsive">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left"><i class="fas fa-ticket-alt left-menu-icons-account"></i> Tickets en cours</h1>
        <div class="btn-group pull-right">
                <a class="btn btn-primary" href="create_ticket.php" role="button">
                    <span class="glyphicon glyphicon-plus-sign"></span> Créer un nouveau ticket
                </a>
        </div>
		<div class="btn-group pull-right">
                <a class="btn btn-success" href="ticket_clo.php" role="button">
                    <span class="far fa-check-circle"></span> Tickets cloturés
                </a>
        </div>
    </div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-responsive" width="100%">
	<thead>
		<tr>
			<th class="toggle sorting" >client</th>
			<th class="toggle sorting" >titre du ticket</th>
			<th class="toggle sorting" >description du ticket</th>
			<th class="toggle" >date de création</th>
			<th class="toggle" >urgence</th>
			<th class="toggle" >créateur</th>
			<th class="toggle" >intervenant</th>
			<th class="toggle" >cloturé</th>
			<th class="toggle" >intervention</th>
			<th class="toggle" ">Actions</th>
		</tr>
	</thead>
	<thead>
		<form action="manage_ticket.php" method="post">
		<input type="hidden" name="act" value="N"> 
		<input type="hidden" name="id" value="<?php echo $tck_id_upd ; ?>">
		<td><input type="text" name="tck_client" value="<?php echo $tck_client_upd ; ?>" placeholder="client"></td>
		<td><input type="text" name="tck_titre" value="<?php echo $tck_titre_upd ; ?>"  placeholder="titre"></td>
		<td><input type="text" name="tck_description" value="<?php echo $tck_description_upd ; ?>"  placeholder="description"></td>
		<td><input type="text" name="tck_date" value="<?php echo $tck_date_upd ; ?>"  placeholder="date de création" disabled></td>
		<td><input type="text" name="tck_urgence" value="<?php echo $tck_urgence_upd ; ?>"  placeholder="urgence"></td>
		<td><input type="text" name="tck_createur" value="<?php echo $tck_createur_upd ; ?>"  placeholder="créateur" disabled></td>
		<td><input type="text" name="intervenant" value="<?php echo $intervenant_upd ; ?>"  placeholder="intervenant"></td>
		<td><input type="text" name="intervenantCloture" value="<?php echo $intervenantCloture_upd ; ?>"  placeholder="cloturé"></td>
		<td><input type="text" name="intervention" value="<?php echo $intervention_upd ; ?>"  placeholder="intervention"></td>
		<td><input type="submit" value="Valider"></td>
		<td></td>
		</form>
	</thead>
	

	<?php foreach ($table as $row ) {
		  if($row["tck_del"]==0 && $row["intervenantCloture"]=="non") {?>
	<tr>
		<td><?php echo $row["tck_client"]?></td>
		<td><?php echo $row["tck_titre"]?></td>
		<td><?php echo $row["tck_description"]?></td>
		<td><?php echo $row["tck_date"]?></td>
		<td><?php echo $row["tck_urgence"]?></td>
		<td><?php echo $row["tck_createur"]?></td>
		<td><?php echo $row["intervenant"]?></td>
		<td><?php echo $row["intervenantCloture"]?></td>
		<td><?php echo $row["intervention"]?></td>
		<td> 
    		<form action="manage_ticket.php" method="post">
    			<input type="hidden" name="id" value="<?php echo $row["tck_id"]?>">
    			<input type="hidden" name="act" value="M"> 
    			<input type="submit" value="Modifier">
    		</form>
		</td> 
		<td> 
    		<form action="manage_ticket.php" method="post">
    			<input type="hidden" name="act" value="S"> 
    			<input type="hidden" name="id" value="<?php echo $row["tck_id"]?>">
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