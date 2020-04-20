<?php
session_start();
$us_id =5;
?>

<!DOCTYPE html>

<head>

<title>Nuevas Oportunidades</title>   

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="max-age=3600">
 
</head>

<body>


<?php include"includes/header.php"; ?>

<div id="brd">
<?php
include "scripts/con.php";


	if(isset($_POST['btnNewRecord']))
           
		 {
		 	
//------------------- PRIMERA IMAGEN --------------------//
				
                if(getimagesize($_FILES['image1']['tmp_name']) == FALSE)
                {
                   $pathAndName1 = "img/default.png ";
                }
                else
                {
                    $image1= addslashes($_FILES['image1']['tmp_name']);
					$fileTmpLoc1 = $_FILES['image1']["tmp_name"];
                    $image1= file_get_contents($image1);
                    $image1= md5(time($image1)).'docpa'.$us_id."rec".'.jpg';
                }
				
				// Example of accessing data for a newly uploaded file
				// Path and file name
				$pathAndName1 = "images/".$image1."";
				// Run the move_uploaded_file() function here
				$moveResult1 = move_uploaded_file($fileTmpLoc1, $pathAndName1);
				// Evaluate the value returned from the function if needed
				if ($moveResult1 == true) {
				    echo "File has been moved from " . $fileTmpLoc1 . " to" . $pathAndName1;
				    	$pathAndName1 = "".$image1."";
				} else {
				     $pathAndName1 = "img/default.png";
				}
				
//ojo ... verificar que se haya creado la sesión de usuario y esté activa la sesión {manager} 		
				
// $us_id = mysqli_real_escape_string($con, $_SESSION['manager']);						 	
$pr_name = mysqli_real_escape_string($con, $_POST['pr_name']);
$pr_kind = mysqli_real_escape_string($con, $_POST['pr_kind']);
$pr_producer = mysqli_real_escape_string($con, $_POST['pr_producer']);
$pr_size = mysqli_real_escape_string($con, $_POST['pr_size']);
$pr_units = mysqli_real_escape_string($con, $_POST['pr_units']);
$pr_use = mysqli_real_escape_string($con, $_POST['pr_use']);
$pr_benefits = mysqli_real_escape_string($con, $_POST['pr_benefits']);
$pr_ingredients = mysqli_real_escape_string($con, $_POST['pr_ingredients']);
$pr_warnings = mysqli_real_escape_string($con, $_POST['pr_warnings']);
$pr_price = mysqli_real_escape_string($con, $_POST['pr_price']);
$pr_special_price = mysqli_real_escape_string($con, $_POST['pr_special_price']);
$pr_special_price1 = mysqli_real_escape_string($con, $_POST['pr_special_price1']);
$pr_special_price2 = mysqli_real_escape_string($con, $_POST['pr_special_price2']);
$pr_special_price3 = mysqli_real_escape_string($con, $_POST['pr_special_price3']);
$pr_discount = mysqli_real_escape_string($con, $_POST['pr_discount']);
$pr_stock = mysqli_real_escape_string($con, $_POST['pr_stock']);
$pr_date = mysqli_real_escape_string($con, $_POST['pr_date']);
//$pr_updated= mysqli_real_escape_string($con, $_POST['pr_updated']);
$pr_outdated= mysqli_real_escape_string($con, $_POST['pr_outdated']);
$pr_review = mysqli_real_escape_string($con, $_POST['pr_review']);
$pr_status = mysqli_real_escape_string($con, $_POST['pr_status']);
$pr_organic = mysqli_real_escape_string($con, $_POST['pr_organic']);
$pr_empresa = mysqli_real_escape_string($con, $_POST['pr_empresa']);
$pr_ruc = mysqli_real_escape_string($con, $_POST['pr_ruc']);
$pr_registro = mysqli_real_escape_string($con, $_POST['pr_registro']);

$fotografia = mysqli_real_escape_string($con, $_POST['image1']);
;
$empresa = mysqli_real_escape_string($con, $_POST['empresa']);
$ruc = mysqli_real_escape_string($con, $_POST['ruc']);

$image1 = print_r($pathAndName1,true);
$an_id = 1 ;	
	    
	$sql = mysqli_query($con, "

INSERT INTO 
	`products`(
	
					`pr_image1`,
					`pr_name`,
					`pr_kind`,
					`pr_producer`,
					`pr_size`,
					`pr_units`,
					`pr_use`,
					`pr_benefits`,
					`pr_ingredients`,
					`pr_warnings`,
					`pr_price`,
					`pr_empresa`,
				 	 `pr_ruc`
						          ) 
	
VALUES
(

'$image1',
'$pr_name',

'$pr_kind',
'$pr_producer',
'$pr_size',
'$pr_units',
'$pr_use',
'$pr_benefits',
'$pr_ingredients',
'$pr_warnings',
'$pr_price',
'$pr_empresa',
'$pr_ruc'

)"

		);
	
	 try {
			$delay = 0;
			$url = "nuevo_producto.php";
			if ( $delay == 0) {
				
				header("Location: " . $url);
			}
			// Performs a redirect once headers have been sent
			echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
			exit();
		} catch (Exception $err) {
			return $err->getMessage();
		}

			
        }

	
?>

<h2>Nuevas Oportunidades</h2>

<form action="nuevo_producto.php" enctype="multipart/form-data" name="recordForm" id="recordform" method="post">


<label>Fotografía</label> 

<!--	<textarea class="FormElement" name="fotografia" id="fotografia"   ></textarea>
 upload -->
<label>
<input type="file" name="image1"  id="image1"  value="Seleccionar Imágen" />
</label>
    

<label>Nombre del producto</label>
<textarea class="FormElement" name="pr_name" id="pr_name"   ></textarea>


<label>Clasificación del producto</label>
	<textarea class="FormElement" name="pr_kind" id="pr_kind" ></textarea>

  	
 <label>Productor</label>
	<textarea class="FormElement" name="pr_producer" id="pr_producer"  ></textarea>

  
 <label>Tamaño (en números)</label>
	<textarea class="FormElement" name="pr_size" id="pr_size"    ></textarea>


 <label>Unidades de medida</label>
	<textarea class="FormElement" name="pr_units" id="pr_units"   ></textarea>


<!--
<label></label>     
	<textarea class="FormElement" name="firma" id="firma" placeholder="Firma digitalizada"  ></textarea> -->


<label>Empresa</label>     
	<textarea class="FormElement" name="pr_empresa" id="pr_empresa"></textarea>
             
<label>RUC</label>    

	<textarea class="FormElement" name="pr_ruc" id="pr_ruc"   ></textarea>



   <input type="submit" name="btnNewRecord" id="btnNewRecord" value="Ingresar ahora"   />
   	</label></form> 
            
</div>

</body>

</html>