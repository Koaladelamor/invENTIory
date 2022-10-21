<?php

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

$query = <<<EOD

SELECT * FROM users;

EOD;

$res = $conn->query($query);
if(!$res){
	echo "ERROR DB 2: Error al obtener los usuarios";
	exit;
}

echo <<<EOD
<table>
<tr><th>Nombre</th><th>Usuario</th><th>email</th></tr>
EOD;


while ($user = $res->fetch_assoc()){
echo <<<EOD
<tr><td>{$user["name"]}</td><td>{$user["username"]}</td><td>{$user["email"]}</td></tr>
EOD;
}

echo "</table>";

?>

