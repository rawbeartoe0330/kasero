<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  

include "scripts/con.php"; 

mysqli_set_charset($con, "utf8");
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysqli_query($con, "SELECT * FROM products WHERE pr_id='$id' LIMIT 1");
	$productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysqli_fetch_array($sql)){ 
		
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
		
         }
		 
	} else {
		echo "Ese producto no está listado en nuestro sistema.";
	    exit();
	}
		
} else {
	echo "Falta información para mostrar el sitio completamente";
	exit();
}

?>


<!DOCTYPE html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Cache-Control" content="max-age=3600">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<title><?php $pr_name; ?> </title>

</head>

<!-- neck: 

This site performs the following :

1. Display one product
2. Provide product code 
3. Show price and availability
4. Provide information about services
5. Obtain traffic from mobile and desktop users 
6. Provide alternative contact resources
7. Promote social engagement through enterprenurial case histories

 --> 

<body>
<?php 
include "includes/header.php";

?>

<img src="img/ban2.png" alt="Productos de excelente calidad, tienda virtual" width="100% ">
 <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="15" width="95%" align="center" >
  <tr>
    <td width="21%" valign="top" align="center"><br />
      
      
     <div id="display"> 
      <?php echo "<div itemscope itemtype='http://schema.org/Product'>"; ?>
        
        <?php if ($pr_image1!='*') { echo '
        <img  itemprop="image" src = "images/'.$pr_image1.'" height="300" width="300" alt="'.$pr_name.'"/>';} else { echo '
        <img  itemprop="image" src = "img/standard.svg" height="300px" width="300px" alt="producto"/>';}
       ?>
       
  <?php echo "</div>"; ?>
     </div>
      
      </td>
    <td width="33%" valign="top">
        
        
    <div id="nom">
    <?php echo "<div itemscope itemtype='http://schema.org/Product'>"; ?>
     <?php echo "<div class='ptit'><span itemprop='name'>".ucwords(strtolower($pr_name))." ".$pr_size ."".$pr_units."</span></div></div>"; ?>
	</div>
	
   <div id="aut">
    <?php echo "<div itemscope itemtype='http://schema.org/Product'><div class='psub'><span itemprop='manufacturer'>".ucwords(strtolower($pr_producer))."</span></div></div>"; ?>
    </div>
 
      <div id="txt">
       <h2>Beneficios</h2>
    <?php echo "<span>".$pr_benefits."</span>"; ?>
    </div>
    <br>
       <div id="txt">
       <h2>Ingredientes</h2>
    <?php echo "<span>".$pr_ingredients."</span>"; ?>
    </div>
       <div id="txt">
        <h3>Advertencias</h3>
    <?php echo "<span>".$pr_warnings."</span>"; ?>
    </div>
  
      </p>
     
     <?php echo "
	  
	  <div id='sum' itemprop='offers' itemscope itemtype='http://schema.org/Offer'>  
USD$:<span itemprop='price'>".money_format('%10.2n',$pr_price)."</span>  
<meta itemprop='priceCurrency' content='USD' />  
</div>  
	  
	 "; ?></div><div id="stock">
           <?php 
		   	   if($pr_stock > 0){echo "<link itemprop='availability' href='http://schema.org/InStock'>
En stock</div>";}
		   else {echo 'Item no disponible ';}; ?>
     <br><br>
     <?php 
		   	   if($pr_stock > 0){echo "<form id='form1' name='form1' method='post' action='cart.php' >
        <input type='hidden' name='pid' id='pid' value='".$pr_id."' />
        <input type='submit' name='button' id='button' value='Lo quiero' />
        </form>";}
		
		   else {echo 'Este item no se encuentra disponible, puede <a href="contactenos.php">hacer un requerimiento </a>';}; ?>
     
     
      </td>
      <td > 
      
     <div id="sec_box">
     
<div id='wrp1'>     
<div id="wha"><img src="img/whatsapp.png" alt="logo de atención al cliente tienda" width="30px"></div><div id='wtx'>WhatsApp 0984659218</div>
   </div>
<br>   
      <ol>
      

<li>Depositar el valor del pedido.</li>
<li>Confirmar su orden.</li>
<li>Recibir en la puerta de su hogar.</li>
</ol></div>
       </td>
    </tr>
</table>
<?php 
include "includes/footer.php";

?>
</body>

</html>