<?php


session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD

SELECT * FROM bank_accounts
WHERE id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}

$bank_account = $res->fetch_assoc();

echo "Tu saldo es: ".$bank_acc["balance"];

?>
