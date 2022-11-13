<?php


session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);




require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno){
	echo "ERROR DB 1: Not connected";
	exit;
}

if (!isset($_POST["id_item"])){
	echo "ERROR 2: Formulario no recibido";
	exit;
}

$id_item = intval($_POST["id_item"]);

$query = <<<EOD
SELECT value 
FROM items
WHERE id_item=$id_item;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 3: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo"ERROR 4: Armadura inexistente";
	exit;
}
//Guardamos info de la armadura
$item = $res->fetch_assoc();

$query = <<<EOD
SELECT balance 
FROM bank_accounts
WHERE id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 5: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo"ERROR 6: Cuenta inexistente";
	exit;
}
//Cuenta del usuario activo
$bank = $res->fetch_assoc();

if($bank["balance"] < $item["value"]){
	echo"Eres pobre: no puedes comprar esto";
	exit;
}

$balance = $bank["balance"] - $item["value"];

$query = <<<EOD
UPDATE bank_accounts
SET balance=$balance
WHERE id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 7: Query mal formada";
	exit;
}

//Insertamos obj

$query = <<<EOD
INSERT INTO inventory_items (id_item, id_user, purchased)
VALUES($id_item, $id_user, now());
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 8: Query mal formada";
	exit;
}

header("Location: shop.php");

?>
