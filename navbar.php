<?php
include 'connect_to_database.php';

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['userid'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}

 $id = $_SESSION['userid'];
 $sql = "Select * FROM user WHERE
 usr_id = $id;";
 
 $res = $dbs->query($sql);
 $data=$res->fetch();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./bs337/js/bootstrap.min.js"></script>
    <link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="manage_ticket.php">Ticketing</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<!--li class="active"><a href="">Home<span class="sr-only"></span></a></li-->
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Tickets <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="create_ticket.php">Créer un ticket</a></li>
                  <!--li role="separator" class="divider"></li>
                  <!--li class="dropdown-header">Nav header</li-->
                  <li><a href="manage_ticket.php">Tickets en cours</a></li>
				  <li><a href="ticket_clo.php">Tickets cloturés</a></li>
                </ul>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Projets<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="create_projet.php">Créer un projet</a></li>
                  <!--li role="separator" class="divider"></li>
                  <!--li class="dropdown-header">Nav header</li-->
                  <li><a href="manage_projet.php">Liste des projets</a></li>
                </ul>
            </li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Clients<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="create_client.php">Créer un client</a></li>
                  <!--li role="separator" class="divider"></li>
                  <!--li class="dropdown-header">Nav header</li-->
                  <li><a href="manage_client.php">Liste des clients</a></li>
                </ul>
            </li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li><a> <?php echo $data['usr_nom'] .' : '. $data['usr_role'] ; ?> </a></li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Utilisateurs<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="create_user.php">Créer un utilisateur</a></li>
                  <li><a href="manage_users.php">Gestion des utilisateurs</a></li>
				  <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
  </body>
</html>