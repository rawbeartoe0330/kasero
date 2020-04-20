<!DOCTYPE html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Cache-Control" content="max-age=3600">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">

<title>Supermercado El Kasero - Ordene ahora y reciba en Quito garantizado</title>



<link href="https://fonts.googleapis.com/css?family=Lato|Permanent+Marker" rel="stylesheet">



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

<?php 
include "includes/header.php";

?>
<body>

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



<?php 

include "scripts/con.php";	


/* change character set to utf8 */
mysqli_set_charset($con, "utf8");
 //   printf("Error loading character set utf8: %s\n", mysqli_error($conn));
//} else {
 //   printf("Current character set: %s\n", mysqli_character_set_name($conn));
//}
echo "<table id='tab'>
<tr>
<th> Id</th>
<th> Productos</th>
<th> Cliente</th>
<th> Nombres</th>
<th> Apellidos</th>
<th> Fecha</th>
<th> Monto</th>
<th> TXN</th>
<th> Email Recibidor</th>
<th> Tipo de pago</th>
<th> Estatus</th>
<th> Txn Type</th>
<th> Payer Status</th>
<th>Calle</th>
<th> Ciudad</th>
<th> Estado</th>
<th> Código postal</th>
<th> País</th>
<th> Estado</th>
<th> Notificacion</th>
<th> Firma</th>
<th> Payer ID</th>
<th> Moneda</th>
<th> Tasa</th>

</tr>	
"; 
 
$input = "";
$sql = "SELECT * FROM transactions ORDER BY 	id DESC";

$result = mysqli_query($con, $sql);
$i=0;

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	
	setlocale(LC_MONETARY,"en_US");
    
	
      while($row = mysqli_fetch_array($result)){ 
          	
          	$tr_id = $row["id"];
          	$product_id_array = $row["product_id_array"];
          	$payer_email = $row["payer_email"];
          	$first_name = $row["first_name"];
          	$last_name = $row["last_name"];
          	$payment_date= $row["payment_date"];
          	$mc_gross = $row["mc_gross"];
          	$txn_id = $row["txn_id"];
          	$receiver_email = $row["receiver_email"];
          	$payment_type = $row["payment_type"];
          	$payment_status = $row["payment_status"];
          	$txn_type = $row["txn_type"];
				$payer_status = $row["payer_status"];
				$address_street = $row["address_street"];
				$address_city = $row["address_city	"];
				$address_state = $row["address_state"];
				$address_zip = $row["address_zip"];
				$address_country = $row["address_country"];
				$address_status = $row["address_status"];
				$notity_version = $row["notity_version"];
				$verify_sign = $row["verify_sign"];
				$payer_id = $row["payer_id"];
				$mc_currency = $row["mc_currency"];
				$mc_fee = $row["mc_fee"];
			



		echo "<tr>";	
			

			 echo "<td>".$tr_id."</td> ";
			 echo "<td>".$product_id_array."</td> ";
			 echo  "<td>".$payer_email."</td> ";
			 echo  "<td>".$first_name."</td> ";
			 echo  "<td>".$last_name."</td> ";
			 echo  "<td>".$payment_date."</td> ";
			 echo  "<td>".$mc_gross."</td> ";
			 echo  "<td>".$txn_id."</td> ";		 
			 echo  "<td>".$receiver_email."</td> ";
			 echo  "<td>".$payment_type."</td> ";
			 echo  "<td>".$payment_status."</td> ";
			 echo  "<td>".$txn_type."</td> ";
			 echo  "<td>".$payer_status."</td> ";
			 echo  "<td>".$address_street."</td> ";
			 echo  "<td>".$address_city."</td> ";
			 echo  "<td>".$address_state."</td> ";
			 echo  "<td>".$address_zip."</td> ";
			 echo  "<td>".$address_country."</td> ";
			 echo  "<td>".$address_status."</td> ";
			 echo  "<td>".$notity_version."</td> ";
			 echo  "<td>".$verify_sign."</td> ";
			 echo  "<td>".$payer_id."</td> ";
			 echo  "<td>".$mc_currency."</td> ";
			 echo  "<td>".$mc_fee."</td> ";

			 	 
			 
			//echo "<img src='images/".$pr_image1."' alt='".$pr_name."' width='150px' height='150px'/>";
			// echo "<div class='stit'>".$pr_name." ".$pr_size." ".$pr_units."</div>";
			//echo "<div class='sum'>".$pr_benefits."</div>";
			//echo " <div class='txt'>".$noticia."</div>";
		   //  echo  " <div class='txt'>".$autor."</div>";
			// echo  " <div class='txt'>".$fecha."</div>";
		
		
			//echo "<a href='product_off.php?id=".$pr_id."' class='off'>Desactivar</a>";		
			
			echo "</tr>";
		$i++;		
    }
			echo "</table> ";
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