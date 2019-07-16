<?php
include 'navbar.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : "";
 
if ($action == "N"){
	$prj_nom     = (isset($_POST["nom"]))? $_POST["nom"] : '';
	$prj_cli_nom = (isset($_POST["client"]))? $_POST["client"] : '';
	$prj_usr_nom = (isset($_POST["user"]))? $_POST["user"] : '';
	$prj_date    = date('Y-m-d G:i:s');
	$prj_del     = 0;
	
	$cmd = "INSERT INTO projet (prj_id, prj_cli_nom, prj_usr_nom, prj_nom, prj_date, prj_del)
        VALUES
        (NULL, '$prj_cli_nom', '$prj_usr_nom', '$prj_nom', '$prj_date', '$prj_del');";

	$dbs->query($cmd);
	echo $cmd;
	header('Location: manage_projet.php');
}
		
	$client = "select * from client";
	$cli = $dbs->query($client);
	$clients = $cli->fetchAll();

	$user = "select * from user";
	$us = $dbs->query($user);
	$users = $us->fetchAll();
?>
<head>
<link href="main.css" rel="stylesheet">
<link href="./fontawesome/css/all.css" rel="stylesheet"> 
<title>création du ticket</title>
</head>

<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
				
                <td colspan="1">
                   <form class="well form-horizontal" action="create_projet.php" method="post">
				   <input type="hidden" name="act" value="N">
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Nom du projet</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-tasks"></i></span><input id="nom" name="nom" placeholder="nom" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">client</label>
                            <div class="col-md-8 inputGroupContainer">
							   <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="fas fa-user"></i></span>
                                  <select class="selectpicker form-control" name="client">
								  <?php foreach ($clients as $row ) {?>
                                     <option value="<?php echo $row["cli_nom"] ?>"><?php echo $row["cli_nom"] ?></option>
								  <?php }?>
                                  </select>
                               </div>
							</div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Utilisateur</label>
                            <div class="col-md-8 inputGroupContainer">
							   <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="fas fa-user"></i></span>
                                  <select class="selectpicker form-control" name="user">
								  <?php foreach ($users as $row ) {?>
                                     <option value="<?php echo $row["usr_nom"] ?>"><?php echo $row["usr_nom"] ?></option>
								  <?php }?>
                                  </select>
                               </div>
							</div>
                         </div>	
						 <div style="float:right">
							<div><input type="submit" value="Valider"></div>
						</div>
                      </fieldset>
                   </form>
                </td>
             </tr>
          </tbody>
       </table>
    </div>