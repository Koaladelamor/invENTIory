<?php

if (!isset($_POST["user"])
|| !isset($_POST["password"])  
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}


/* USER CHECK */

$user = trim($_POST["user"]);
if(strlen($user) < 4){
	echo"ERROR 2: Username mal formado";
	exit;
}

$user_quotes = filter_var($user, FILTER_SANITIZE_ADD_SLASHES);

echo $user_quotes;

if($user != $user_quotes){
	echo "ERROR 2.1: Username mal formado";
	exit;
}

/* PASS CHECK */

$password = trim($_POST["password1"]);
if(strlen($password) < 6){
	echo"ERROR 3: Password mal formada";
	exit;
}

$pass_nums = filter_var($_POST["password1"], FILTER_SANITIZE_NUMBER_INT);
if(strlen($pass_nums) == 0){
	echo"ERROR 3.1: Password mal formado. Introduce al menos un número";
	exit;
}


if(strlen($pass_nums) == (strlen($_POST["password1"]))){
	echo "ERROR 3.2: Password mal formado. Introduce al menos un carácter";
	exit;
}

$pass_quotes = filter_var($password, FILTER_SANITIZE_ADD_SLASHES);

if($password != $pass_quotes){
	echo "ERROR 3.3: Password mal formado";
	exit;
}

$password = md5($password);

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD

SELECT * FROM users
WHERE username="$user" AND password="$password";
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo "ERROR DB 3: Login incorrecto";
}

$user = res->fetch_assoc();

session_start();

$_SESSION["id_user"] = $user["id_user"];



?>
