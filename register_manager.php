<?php

if (!isset($_POST["name"])
|| !isset($_POST["user"])  
|| !isset($_POST["password1"])  
|| !isset($_POST["password2"])  
|| !isset($_POST["birthdate"])  
|| !isset($_POST["email"])  
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}

/* NAME CHECK */

$name = trim($_POST["name"]);
if(strlen($name) < 2){
	echo"ERROR 2: Nombre mal formado";
	exit;
}

/* USER CHECK */

$user = trim($_POST["user"]);
if(strlen($user) < 4){
	echo"ERROR 3: Username mal formado";
	exit;
}

$user_quotes = filter_var($user, FILTER_SANITIZE_ADD_SLASHES);


/* PASS CHECK */
$password = trim($_POST["password1"]);
if(strlen($password) < 6){
	echo"ERROR 4: Password mal formada";
	exit;
}

$pass_nums = filter_var($_POST["password1"], FILTER_SANITIZE_NUMBER_INT);
if(strlen($pass_nums) == 0){
	echo"ERROR 4.1: Password mal formado. Introduce al menos un número";
	exit;
}

if(strlen($pass_nums) == (strlen($_POST["password1"]))){
	echo "ERROR 4.2: Password mal formado. Introduce al menos un carácter";
	exit;
}

if($_POST["password1"] != $_POST["password2"]){
	echo "ERROR 5: Passwords doesn't match";
	exit;
}

$pass_quotes = filter_var($password, FILTER_SANITIZE_ADD_SLASHES);

$password = md5($password);

/* BIRTHDATE */

$bdate = trim($_POST["birthdate"]);
if(strlen($bdate) != 10){
	echo"ERROR 6: Fecha Incorrecta";
	exit;
}

$birthdate = explode("-", $_POST["birthdate"]);

if(count($birthdate) != 3){
	echo"ERROR 6.1: Fecha Incorrecta";
	exit;
}

if(strlen($birthdate[0]) != 4 || strlen($birthdate[1]) != 2 || strlen($birthdate[2]) != 2){
	echo"ERROR 6.2: Fecha Incorrecta";
	exit;
}

if($birthdate[0] > 2006 || $birthdate[1] < 01 || $birthdate[1] > 12){
	echo"ERROR 6.3: Fecha Incorrecta";
	exit;
}

/* EMAIL */ 

$email = trim($_POST["email"]);
if(strlen($email) < 6){
	echo"ERROR 7: Email Incorrecto";
	exit;
}

$email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);

if($email != $email_validate){
	echo "ERROR 7.1: Email mal formado";
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
SELECT id_user FROM users WHERE username="$user";
EOD;

$res = $conn->query($query);

if($res->num_rows >= 1){
	echo "ERROR 6: Usuario ya existe";
	exit;
}


$query = <<<EOD

INSERT INTO users (username, name, password, birthdate, email, registration)
VALUES("$user", "$name", "$password", "$bdate", "$email", now());
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}

$last_insert_id = mysqli_insert_id($conn);

$query = <<<EOD
INSERT INTO bank_accounts(balance, id_user)
VALUES(10000, $last_insert_id);
EOD;

$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 3: Query mal formada";
	exit;
}

$success_message = <<<EOD
<p>Te has registrado correctamente.</p>
<p><a href=index.php>Login</a></p>
EOD;

echo $success_message;

//header("Location: index.php");

?>
