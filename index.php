<html lang="en">

  <head>
    <meta charset="utf-8">

    <title>Ticket Manager</title>

    <link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
	<link href="./main.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top navbar-light" style="background-color: #badaff;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <image rel="icon" src="icone.png" style="color:#009dff;"></image>
          <a style="color:#009dff;">Projet Web</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" action="process.php" method="post">
		  
            <div class="form-group">
              <input type="text" id="login" name="login" placeholder="identifiant" class="form-control"/>
            </div>
            <div class="form-group">
              <input type="password" id="password" name="password" placeholder="mot de passe" class="form-control"/>
            </div>
            <button type="submit"  class="btn btn-success">Se connecter</button>
		</form>
        </div>
      </div>
    </nav>
	
    <div id="banner" class="description">
      <div id="cloud-scroll" class="container info titre" >
        <h1 style="color:#2faabd;">Gestion des Tickets d'Incidents</h1>
        <p style="color:#33b3de;">Cet outil vous permet de rassembler les demandes des utilisateurs et de les traiter dans les meilleurs délais</p>
		<p style="color:#009dff;">Veuillez vous identifiez pour accéder à la plateforme</p>
		
      </div>
    </div>
  </body>
</html>
