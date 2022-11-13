
<?php

require("template.php");

session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);

if($id_user != 1){
	echo "No tienes privilegios pleb";
	exit;
}

print_head("Weapon Type");

$weapon_type_form = <<<EOD
<form method="POST" action="weapon_types_manager.php" id="weapon-type-form">
<h2> Add Weapon Type </h2>

<p><label for="weapon-type-name">Weapon Type:</label>
<input type="text" name="type" id="weapon-type-name"/></p>

<p><label for="weapon-type-icon">Icon filename:</label>
<input type="text" name="icon" id="weapon-type-icon"/></p>

<p><input type="submit" value="Add" /></p>

</form>
EOD;

print_body($weapon_type_form);

?>
