
<?php

require("template.php");

print_head("Item Type");

$item_type_form = <<<EOD
<form method="POST" action="item_type_manager.php" id="item-type-form">
<h2> Add Item Type </h2>

<p><label for="item-type-id">Item ID:</label>
<input type="text" name="id" id="item-type-id"/></p>

<p><label for="item-type-name">Item Type:</label>
<input type="text" name="item-type" id="item-type-name"/></p>

<p><input type="submit" value="Add" /></p>

</form>
EOD;

print_body($item_type_form);

?>
