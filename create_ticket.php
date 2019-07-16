<?php
include 'connect_to_database.php'; //connect the connection page
include 'navbar.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : "";

if ($action == "N"){
	$tck_client 		= (isset($_POST["client"]))? $_POST["client"] : '';
	$tck_titre			= (isset($_POST["titre"]))? $_POST["titre"] : '';
	$tck_description	= (isset($_POST["description"]))? $_POST["description"] : '';
	$tck_date			= date('Y-m-d G:i:s');
	$tck_urgence		= (isset($_POST["urgence"]))? $_POST["urgence"] : '';
	$tck_createur		= $data['usr_nom'];
	$intervenant		= (isset($_POST["intervenant"]))? $_POST["intervenant"] : '';
	$intervenantCloture	= "non";
	$tck_del = 0;

	$cmd = "INSERT INTO ticket (tck_id, tck_client, tck_titre, tck_description, tck_date, tck_urgence, tck_createur, intervenant, intervenantCloture, dateCloture, tck_del)
			VALUES
			(NULL, '$tck_client', '$tck_titre', '$tck_description', '$tck_date', '$tck_urgence', '$tck_createur', '$intervenant', '$intervenantCloture',NULL, '$tck_del');";
	$dbs->query($cmd);

	header('Location: manage_ticket.php');
}
	
	$sql = "select * from client";
	$res = $dbs->query($sql);
	$table = $res->fetchAll();
	
	$user = "select * from user where usr_role = 'intervenant'";
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
                   <form class="well form-horizontal" action="create_ticket.php" method="post">
				   <input type="hidden" name="act" value="N">
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-3 control-label">titre du ticket</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-ticket-alt"></i></span><input id="titre" name="titre" placeholder="titre" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">description du ticket</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-clipboard-list"></i></span><input id="description" name="description" placeholder="description" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">client</label>
                            <div class="col-md-8 inputGroupContainer">
							   <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="fas fa-user"></i></span>
                                  <select class="selectpicker form-control" name="client">
								  <?php foreach ($table as $row ) {?>
                                     <option value="<?php echo $row["cli_nom"] ?>"><?php echo $row["cli_nom"] ?></option>
								  <?php }?>
                                  </select>
                               </div>
							</div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Intervenant</label>
                            <div class="col-md-8 inputGroupContainer">
							   <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="fas fa-wrench"></i></span>
                                  <select class="selectpicker form-control" name="intervenant">
								  <?php foreach ($users as $row ) {?>
                                     <option value="<?php echo $row["usr_nom"] ?>"><?php echo $row["usr_nom"] ?></option>
								  <?php }?>
                                  </select>
                               </div>
							</div>
                         </div>						 
                         <div class="form-group">
                            <label class="col-md-3 control-label">urgence</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="far fa-bell"></i></span>
                                  <select class="selectpicker form-control" name="urgence">
                                     <option value="faible">Faible</option>
									 <option value="moyenne">Moyenne</option>
									 <option value="haute">Haute</option>
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