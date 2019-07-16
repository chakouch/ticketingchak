<?php
include 'connect_to_database.php'; //connect the connection page
include 'navbar.php';

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['userid'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
}

 $id = $_SESSION['userid'];
 $sql = "Select * FROM utilisateurs WHERE
 user_id = $id;";
 
 $res = $dbs->query($sql);
 $data=$res->fetch();

?>
<html>
<head>
    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="./bs337/css/bootstrap.min.css" rel="stylesheet">
	<link href="main.css" rel="stylesheet">
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
	  <style type="text/css">
	  svg {
		font: 10px sans-serif;
		shape-rendering: crispEdges;
	  }

	  .axis path,
	  .axis line {
		fill: none;
		stroke: #000;
	  }
	 
	  path.domain {
		stroke: none;
	  }
	 
	  .y .tick line {
		stroke: #ddd;
	  }
	  </style>
  </head>
<body>
<!--p class="description">Welcome <?php echo $data['user_name']; ?></p>
 <!--a href="logout.php">logout</a--> 
<?php
$statement = $dbs->prepare("SELECT * FROM ticket");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
//echo $json;

$str = '2019-07-12 15:20:04';

if (($timestamp = strtotime($str)) !== false)
{
  $php_date = getdate($timestamp);
  $mon = date("m", $timestamp)." ";
//  $monthName = date("F", mktime(0, 0, 0, $mon, 10));
//  echo $monthName;

$tech="med";
//echo array_count_values(array_column($json, 'technicien'))[$tech];
}
?>
</body>
</html> 