<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Cache-Control" content="max-age=3600">

<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">

<title>Supermercado El Kasero - Ordene ahora y reciba en Quito garantizado</title>

<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">




</head>


<!-- neck: 

This site performs the following :

1. Display products
2. Invite to register 
3. Allow logins 
4. Provide information about services
5. Obtain traffic from mobile and desktop users 
6. Provide a contact resource
7. Promote engagement with the brand and activities

 --> 
<body>


<?php include "includes/header.php"; ?>

<img src="img/salad2.png" alt="imagen de estilo de vida saludable" width="100%">



<!--
<video autoplay muted loop id="myVideo">
  <source src="video/office.mp4" type="video/mp4">
 Su browser no puede leer HTML5 video.
</video>


<script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }
}
</script>
-->


<div class="box">

<div class="img">  <img src="img/logo-el-kasero.png" width="300" height="300"></div>

<div class="hea"> Llame ahora: Whatsapp 0968 631 804</div>

<div class="txt1">
  <p>
    Aqui encontrará las mejores ofertas de
    productos locales del Ecuador.</p>
  <p>
    
    Si desea vender su producto en El Kasero haga click aqui ahora! 
    
    <br>
  </p>
</div>	


</div>

<?php 

include "scripts/con.php";	


/* change character set to utf8 */
mysqli_set_charset($con, "utf8");
 //   printf("Error loading character set utf8: %s\n", mysqli_error($conn));
//} else {
 //   printf("Current character set: %s\n", mysqli_character_set_name($conn));
//}
 
$input = "";
$sql = "SELECT * FROM products WHERE pr_status=1 ";

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
			
			echo "<div class='box' onclick=;location.href=\'https://www.ignisventas.com\';' style=\'cursor: pointer;\'\">";

			 echo "<div class='kin'>".$pr_kind."</div> ";	
			 echo '<img src = "images/'. $pr_image1.'" width="100%"  alt="'.$pr_name.'"/>';
			 
			 echo "<div class='tit'>".$pr_name."</div>";
			 echo "<div class='num'>$ ".number_format($pr_price, 2)."</div>";
			 echo "<div class='sum'>$ ".number_format($pr_special_price, 2)."</div>";
			//echo " <div class='txt'>".$noticia."</div>";
		  //  echo  " <div class='txt'>".$autor."</div>";
			// echo  " <div class='txt'>".$fecha."</div>";
		
			
			echo "<a href='product.php?id=$pr_id'><button class='button'>Look</button></a>";		
			
			echo "</div>";
		$i++;		
    }
			echo " ";
} else {
    echo "0 results";
}

mysqli_close($con);


?>

<?php 
include "includes/footer.php";

?>

</body>

</html>