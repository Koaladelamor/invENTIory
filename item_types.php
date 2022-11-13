
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

print_head("Item Type");

$item_type_form = <<<EOD
<form method="POST" action="item_types_manager.php" id="item-type-form">
<h2> Add Item Type </h2>

<p><label for="item-type-name">Item Type:</label>
<input type="text" name="type" id="item-type-name"/></p>

<p><label for="item-type-icon">Icon filename:</label>
<input type="text" name="icon" id="item-type-icon"/></p>

<p><input type="submit" value="Add" /></p>

</form>
EOD;

print_body($item_type_form);

?>
