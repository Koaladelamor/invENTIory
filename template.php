<?php 

function print_head($subtitle = ""){
	$title = "invENTIory";

	if($subtitle != "")
	$title .= ": ".$subtitle;
	
	echo <<<EOD
<!DOCTYPE html>
<html>
<head>
	<title>$title</title>
</head>
EOD;
}

function get_menu(){
	$login = "<li><a href=\"index.php\">Login</a></li>";
	$add_items = "";
	if(!isset($_SESSION["id_user"])){
		$login = "<li><a href=\"logout.php\">Logout</a></li>";
	}
	
	if(isset($_SESSION["id_user"])){
		if($_SESSION["id_user"] == 1){
			$add_items = "<li><a href=\"armours.php\">Armours</a></li>"."<li><a href=\"armour_types.php\">Armours Types</a></li>"."<li><a href=\"weapons.php\">Weapons</a></li>"."<li><a href=\"weapon_types.php\">Weapons</a></li>"."<li><a href=\"weapon_types.php\">Weapon Types</a></li>". "<li><a href=\"items.php\">Items</a></li>"."<li><a href=\"item_types.php\">Item Types</a></li>";
		}
		else{
			$add_items = "";
		}
	}

	return <<<EOD
<ul>
	<li><a href="inventiory.php">Portada</a></li>
	<li><a href="shop.php">Tienda</a></li>
	$login
	$add_items
</ul>
EOD;
}

function print_body($content = "", $show_menu = true){
	if($show_menu){
		$menu = get_menu();	
		echo <<<EOD
<body>
$menu
$content
</body>
</html>
EOD;
	}
	else{
		echo <<<EOD
<body>
$content
</body>
</html>
EOD;
	}
}


?>
