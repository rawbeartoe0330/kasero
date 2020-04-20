<!DOCTYPE html>
<head>
<title>E</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
</head>
<body>


<?php 

include('scripts/con.php');
mysqli_set_charset($con, "utf8");

$id = $_GET['id'];

$code = 0;
$sql =mysqli_query($con, "UPDATE `products` SET pr_status='$code' WHERE pr_id='$id' LIMIT 1");
$cambio = mysqli_affected_rows($con);
echo $cambio;

    if ($cambio != 0) {
    
echo 'se completo una tarea 	';
        				} else { echo"no se realizaron cambios";};


	 try {
			$delay = 0;
			$url = "ma_products.php";
			if ( $delay == 0) {
				
				header("Location: " . $url);
			}
			// Performs a redirect once headers have been sent
			echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
			exit();
		} catch (Exception $err) {
			return $err->getMessage();
		}

?>

</body></html>
