<?php
include 'navbar.php';

$action = (isset($_POST["act"])) ? $_POST["act"] : "";

if ($action == "N"){
	$usr_nom		= (isset($_POST["nom"]))? $_POST["nom"] : '';
	$usr_prenom		= (isset($_POST["prenom"]))? $_POST["prenom"] : '';
	$usr_role		= (isset($_POST["role"]))? $_POST["role"] : '';
	$usr_login		= (isset($_POST["login"]))? $_POST["login"] : '';
	$usr_pwd		= (isset($_POST["pwd"]))? $_POST["pwd"] : '';
	$usr_address	= (isset($_POST["address"]))? $_POST["address"] : '';
	$usr_email		= (isset($_POST["email"]))? $_POST["email"] : '';
	$usr_tel		= (isset($_POST["tel"]))? $_POST["tel"] : '';
	$usr_del 		= 0;
	
	$cmd = "INSERT INTO user (usr_id, usr_nom, usr_prenom, usr_role, usr_email, usr_login, usr_pwd, usr_address, usr_tel, usr_del)
			VALUES
			(NULL, '$usr_nom', '$usr_prenom', '$usr_role', '$usr_email', '$usr_login', '$usr_pwd', '$usr_address', '$usr_tel', '$usr_del');";
	$dbs->query($cmd);
	header('Location: manage_users.php');
}
	
?>
<head>
<link href="main.css" rel="stylesheet">
<link href="./fontawesome/css/all.css" rel="stylesheet">
<title>création de nouvel utilisateur</title>
</head>

<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   <form class="well form-horizontal" action="create_user.php" method="post">
				   <input type="hidden" name="act" value="N">
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Nom</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span><input name="nom" placeholder="Nom" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">Prénom</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-user"></i></span><input name="prenom" placeholder="Prenom" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">Role</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="fas fa-user-tag"></i></span>
                                  <select class="selectpicker form-control" name="urgence">
                                     <option value="admin">Administrateur</option>
									 <option value="intervenant">Intervenant</option>
                                  </select>
                               </div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="far fa-envelope"></i></span><input name="email" placeholder="Email" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">Identifiant</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-id-card"></i></span><input name="login" placeholder="Identifiant" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
						 <div class="form-group">
                            <label class="col-md-3 control-label">Mot de passe</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-key"></i></span><input name="pwd" placeholder="Mot de passe" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Adresse</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fas fa-address-card"></i></span><input name="address" placeholder="Adresse" class="form-control" required="true" value="" type="text"></div>
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