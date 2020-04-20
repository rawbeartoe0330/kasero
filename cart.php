<?php 
// This file renders the cart 

session_start(); // Start session first thing in script
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Connect to the MySQL database  
include "scripts/con.php"; 
mysqli_set_charset($con, "utf8");
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(1  => array("it_id" => $pid, "quantity" => 1));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      reset($each_item);
		      foreach ($each_item as $key => $value) {
		     // while (list($key, $value) = each($each_item)) {
				  if ($key == "it_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("it_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("it_id" => $pid, "quantity" => 1));
		   }
	}
	header("location: cart.php"); 
    exit();
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		        foreach ($each_item as $key => $value) {
		  //    while (list($key, $value) = each($each_item)) {
				  if ($key == "it_id" && $value == $item_to_adjust) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("it_id" => $item_to_adjust, "quantity" => $quantity)));
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>

<?php 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$cartOutput = "";
$cartTotal = 0.0;
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2>Aun no hay productos seleccionados</h2>";
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="roberto-facilitator@ignisventas.com">';
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		$item_id = $each_item['it_id'];
		$sql = mysqli_query($con, "SELECT * FROM products WHERE pr_id='$item_id' LIMIT 1");
		while ($row = mysqli_fetch_assoc($sql)) {
			$id = $row['pr_id'];
			$pr_name = $row['pr_name'];
			$pr_price = $row['pr_price'];
			
			   $pr_id = $row["pr_id"];
          	$pr_image1 = $row["pr_image1"];
          	$pr_image2 = $row["pr_image2"];
          	$pr_image3 = $row["pr_image3"];
          	$pr_image4 = $row["pr_image4"];
          	$pr_video1 = $row["pr_video1"];
          	$pr_video2 = $row["pr_video2"];
          	$pr_name = $row["pr_name"];
          	$pr_kind = $row["pr_kind"];	
				$pr_producer = $row["pr_producer"];
				$pr_size = $row["pr_size"];
				$pr_units = $row["pr_units"];
				$pr_use = $row["pr_use"];
				$pr_benefits = $row["pr_benefits"];
				$pr_ingredients = $row["pr_ingredients"];
				$pr_warnings = $row["pr_warnings"];
				$pr_price = $row["pr_price"];
				$pr_special_price = $row["pr_special_price"];
				$pr_discount = $row["pr_discount"];
				$pr_stock = $row["pr_stock"];
				$pr_date = $row["pr_date"];
				$pr_updated = $row["pr_updated"];
				$pr_outdated = $row["pr_outdated"];
				$pr_review = $row["pr_review"];
				$pr_status = $row["pr_status"];			
			
			
				$img = $row['pr_image1'];
					}
		$pricetotal = $pr_price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY, "en_US");
        $pricetotal = money_format("%10.2n", $pricetotal);
		global $pricetotal;
		
		
// parar buscar los nombres de la EDITORIAL


			
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $pr_name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $pr_price . '">
        <input type="hidden" name="quantity_' . $x . '" value="'.$each_item['quantity'].'">  ';
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		
		$cartOutput .= '<td align="center"><a href="product.php?id='.$item_id.'"></a><br /><div class="cimg"><img src="images/'.$img.'" width="150" height="150" border="0" /></div></td>';
		$cartOutput .= '<td><div class="ite">' .ucwords(strtolower( $pr_name)) . '</div><div class="des">' .ucwords(strtolower( $pr_size )). ''.$pr_units.' </div></td>';
		$cartOutput .= '<td align="center">$' . $pr_price . '</td>';
		$cartOutput .= '<td align="center"><form action="cart.php" method="post">
		<input name="quantity" type="text" id="val" value="'.$each_item['quantity'].'" size="2" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" id="cha" value="cambiar" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		//$cartOutput .= '<td>' .$each_item['quantity'].'</td>';
		$cartOutput .= '<td align="center">' . $pricetotal . '</td>';
		$cartOutput .= '<td align="center"><form action="cart.php" method="post"><input name="deleteBtn' . $item_id . '" id="but" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
	setlocale(LC_MONETARY, "en_US");
     $cartTotal = money_format("%10.2n", $cartTotal);
	$cartTotal = "<div id='total'>".$cartTotal." </div>";
	$_SESSION['cartTotal'] = $cartTotal;
	//if(isset($_SESSION['cartTotal'])){echo "set";}else{echo "unset";}
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="https://www.elkasero.com/scripts/my_ipn.php">
	<input type="hidden" name="return" value="https://www.elkasero.com/checkout_complete.php">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="https://www.elkasero.com/paypal_cancel.php">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-large.png" name="submit" alt="¡Haga sus pagos con PayPal, es rápido, gratis y seguro!">
	
</form>';
$_SESSION['paypalButton']=$pp_checkout_btn;
}		
?>

<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />

<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<title>Carrito de compras el Kasero</title>

</head>


<!-- neck: 

This site performs the following :

1. Display selected products
2. Invite user to continue shopping
3. Provide a clear way to checkout 
4. Collect information about shipping 
5. Collect coupong or discount code
6. Provide alternative contacts 
7. Provide alterative payment methods

 --> 


<body>
<?php 
include "includes/header.php";

?>


<img src="img/ban1.png" alt="estilo de vida en el kasero para ahorrar">
<table  bgcolor="#FFFFFF" cellspacing="0" cellpadding="6"  align="center" border="1" width="100%">
      <thead>
        <th bgcolor="#39B54A" align="center">Producto</td>
        <th bgcolor="#39B54A" align="center">Detalles</td>
        <th bgcolor="#39B54A" align="center">Precio</td>
        <th bgcolor="#39B54A" align="center">Cantidad</td> 
        <th bgcolor="#39B54A" align="center">Total</td>
        <th bgcolor="#39B54A" align="center">Remover</td>
      </thead>
     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
 
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><div id="total">Total</div></td>
        <td align="center"> <?php echo $cartTotal; ?></td>
        <td align="center">  <a href="cart.php?cmd=emptycart" style="text-align:left"> </a><a href="cart.php?cmd=emptycart"><img src="img/trash.png" alt="Descartar selección de productos" width="13" height="17" id="trash" /></a><a href="cart.php?cmd=emptycart" >Descartar </a>
   </td>
      </tr>   
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>Pago seguro</td>
        <td colspan="2"><?php echo $pp_checkout_btn; ?></td>
        
      </tr>
   </table>
   
   <?php 
include "includes/footer.php";

?>
</body>

</html>