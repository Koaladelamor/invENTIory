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

if(strlen(trim($_POST["name"])) < 2){
	echo"ERROR 2: Nombre mal formado";
	exit;
}

if(strlen(trim($_POST["user"])) < 4){
	echo"ERROR 3: Username mal formado";
	exit;
}

if(strlen(trim($_POST["password1"])) < 6){
	echo"ERROR 4: Password mal formada";
	exit;
}

$pass_nums = filter_var($_POST["password1"]. FILTER_SANITIZE_NUMBER_INT);
if(strlen($pass_nums)==0){
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

if(strlen(trim($_POST["birthdate"])) != 10){
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

?>
