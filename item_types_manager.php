<?php

//require_once("login_manager.php");

//session_start();

//$_SESSION["id_user"] = $user["id_user"];

if (isset($_POST["type"])
&& isset($_POST["icon"])
){
	echo"NO PROBLEMO AMIGO ";

}

//echo $_POST["type"]." ".$_POST["icon"]." ";

if (!isset($_POST["type"])){
	echo"Type missing ";
}
if (!isset($_POST["icon"])){
	echo"icon missing ";
}

if (!isset($_POST["type"])
|| !isset($_POST["icon"])
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}


/* ITEM TYPE CHECK */

$type = trim($_POST["type"]);
if(strlen($type) < 4){
	echo"ERROR 3: Item Type mal formado";
	exit;
}

$icon = trim($_POST["icon"]);
if(strlen($icon) < 4){
	echo"ERROR 3: Icon filename mal formado";
	exit;
}

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD

INSERT INTO item_types (type, icon)
VALUES ("$type", "$icon");
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}



?>
