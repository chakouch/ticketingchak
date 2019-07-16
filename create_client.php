<?php
include 'navbar.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : "";

if ($action == "N"){
	$cli_nom		= (isset($_POST["nom"]))? $_POST["nom"] : '';
	$cli_address	= (isset($_POST["address"]))? $_POST["address"] : '';
	$cli_email		= (isset($_POST["email"]))? $_POST["email"] : '';
	$cli_tel		= (isset($_POST["tel"]))? $_POST["tel"] : '';
	$cli_del 		= 0;
	$cmd = "INSERT INTO client (cli_id, cli_nom, cli_address, cli_email, cli_tel, cli_del)
			VALUES
			(NULL, '$cli_nom', '$cli_address', '$cli_email', '$cli_tel', '$cli_del');";
	$dbs->query($cmd);
	header('Location: manage_client.php');
}
	
?>
<head>
<link href="main.css" rel="stylesheet">
<link href="./fontawesome/css/all.css" rel="stylesheet"> 
<title>création de nouveau client</title>
</head>

<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
				
                <td colspan="1">
                   <form class="well form-horizontal" action="create_client.php" method="post">
				   <input type="hidden" name="act" value="N">
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Nom du client</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span><input name="nom" placeholder="Nom" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Adresse</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-address-card"></i></span><input name="address" placeholder="Adresse" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">e-mail</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="far fa-envelope"></i></span><input name="email" placeholder="Email" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">Téléphone</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-phone-alt"></i></span><input name="tel" placeholder="N° Tél" class="form-control" required="true" value="" type="text"></div>
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