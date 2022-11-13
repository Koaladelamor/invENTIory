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



require_once("template.php");

print_head("Portada");

/* GET USER INFO */

$query = <<<EOD
SELECT * FROM users
WHERE id_user=$id_user; 
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 1: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo"ERROR 2: Usuario no encontrado";	
	session_destroy();
	exit;
}

$user = $res->fetch_assoc();
$username = $user["username"];
$name = $user["name"];
$birthdate = $user["birthdate"];

/* GET BALANCE */

require_once("bank_func.php");

$balance = get_balance($conn, $id_user);

if($balance === false){
	$balance = "NO HAY CUENTA BANCARIA";
}

$content = <<<EOD
<h1>Bienvenido/a $name</h1>
<p>Usuario: $username</p>
<p>Fecha de nacimiento: $birthdate</p>
<p>Tienes: $balance</p>
EOD;

print_body($content);

$query = <<<EOD
SELECT *
FROM inventory_armours
LEFT JOIN armours ON armours.id_armour=inventory_armours.id_armour
WHERE inventory_armours.id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 1: Query mal formada";
	exit;
}

if($res->num_rows > 0){
	$armours_list = ""; 
	while($row = $res->fetch_assoc()){
		$armours_list .= "<li><p>".strval($row["armour"])."</p>" ."<p>Description: ".strval($row["description"])."</p>"."</li>";
	}
	$content = <<<EOD
<div>
<p><strong>Armours</strong></p>
<ul>
	$armours_list	
</ul>
</div>
EOD;
	print_body($content, false);	
}

$query = <<<EOD
SELECT *
FROM inventory_weapons
LEFT JOIN weapons ON weapons.id_weapon=inventory_weapons.id_weapon
WHERE inventory_weapons.id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 1: Query mal formada";
	exit;
}

if($res->num_rows > 0){
	$weapons_list = ""; 
	while($row = $res->fetch_assoc()){
		$weapons_list .= "<li><p>".strval($row["weapon"])."</p>" ."<p>Description: ".strval($row["description"])."</p>"."</li>";
	}
	$content = <<<EOD
<div>
<p><strong>Weapons</strong></p>
<ul>
	$weapons_list
</ul>
</div>
EOD;
	print_body($content, false);	
}

$query = <<<EOD
SELECT *
FROM inventory_items
LEFT JOIN items ON items.id_item=inventory_items.id_item
WHERE inventory_items.id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 1: Query mal formada";
	exit;
}

if($res->num_rows > 0){
	$items_list = ""; 
	while($row = $res->fetch_assoc()){
		$items_list .= "<li><p>".strval($row["item"])."</p>" ."<p>Description: ".strval($row["description"])."</p>"."</li>";
	}
	$content = <<<EOD
<div>
<p><strong>Weapons</strong></p>
<ul>
	$items_list
</ul>
</div>
EOD;
	print_body($content, false);	
}



?>
