<!DOCTYPE html>
<head>



<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Cache-Control" content="max-age=3600">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<title>Operación no realizada</title>
</head>


<body>
<?php 
include "includes/header_cancel.php";

?>

<?php 

include "scripts/con.php";	


/* change character set to utf8 */
mysqli_set_charset($con, "utf8");
 //   printf("Error loading character set utf8: %s\n", mysqli_error($conn));
//} else {
 //   printf("Current character set: %s\n", mysqli_character_set_name($conn));
//}
 
$input = "";
$sql = "SELECT * FROM products ORDER BY rand() LIMIT 90";

$result = mysqli_query($con, $sql);
$i=0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
	setlocale(LC_MONETARY,"en_US");
    
	
      while($row = mysqli_fetch_array($result)){ 
          	
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
			
			echo "<div class='box'>";

			 echo "<div class='kin'>".$pr_kind."</div> ";	
			 echo '<img src = "images/'. $pr_image1.'" width="100%"  alt="'.$pr_name.'"/>';
			 
			 echo "<div class='tit'>".$pr_name."</div>";
			 echo "<div class='sum'>".$pr_benefits."</div>";
			//echo " <div class='txt'>".$noticia."</div>";
		  //  echo  " <div class='txt'>".$autor."</div>";
			// echo  " <div class='txt'>".$fecha."</div>";
		
			
			echo "<a href='product.php?id=$pr_id'><img src='img/comprar.png' width='21' height='20'  alt='Comprar este producto'>&nbsp;Comprar</a>";		
			
			echo "</div>";
		$i++;		
    }
			echo " ";
} else {
    echo "0 results";
}

mysqli_close($con);


?>


</body>

</html>
