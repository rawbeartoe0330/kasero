<?php 
// 		$an_id = $_SESSION["an_id"];	 $an_nombre =$_SESSION["an_nombre"];
// 		 $an_apellidos =$_SESSION["an_apellidos"];
	// 	 $an_email = $_SESSION["an_email"];
	// 	 $ag_id =  $_SESSION["ag_id"];
// Script Error Reporting
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
?>


<!DOCTYPE html>

<head>  <title>Nuevas Oportunidades</title>   
<link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="max-age=3600">
 </head>

<body>
<div id="header">
<div id="logo">  

<a href="analista.php" />
<img src="img/logo-el-kasero.png" width="200px" alt="logo de El kasero"><div id="wli"> <a href='index.php'>Inicio</a></div>

</div>
</div> 

<div id="brd">

<?php
include "scripts/con.php";


	if(isset($_POST['btnNewRecord']))
           
		 {

						 	
				$an_nombre = mysqli_real_escape_string($con, $_POST['an_nombre']);
				$an_apellidos = mysqli_real_escape_string($con, $_POST['an_apellidos']);
				$an_email = mysqli_real_escape_string($con, $_POST['an_email']);
				$an_usuario = mysqli_real_escape_string($con, $_POST['an_usuario']);
				$an_password = md5(mysqli_real_escape_string($con, $_POST['an_password']));
				$an_password2 = md5(mysqli_real_escape_string($con, $_POST['an_password2']));
				$con_code  = rand();
				$confirmed = 0;
	    
				
				
				$verificar = mysqli_query($con, "SELECT `us_user` FROM `users` WHERE `us_user`='$an_usuario'");
				$verificarNo = mysqli_num_rows($verificar);
				
				
				
				if($an_usuario == "" || $an_password == "" || $an_nombre == "" || $an_apellidos == "" || $an_email == "" )
		{
			//$warning = "Por favor revise que todos los campos esten llenos";	
			$warning = 1;
			try 
			{
				$delay = 2;
				$url = "nuevo_usuario.php?w=".$warning."";
				if (!headers_sent() && $delay == 2) {
					ob_end_clean();
					header("Location: " . $url);
				}
				// Performs a redirect once headers have been sent
				echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
				exit();
			} catch (Exception $err) {
				return $err->getMessage();
			}
		}
		else if($an_password != $an_password2)
		{
			//$warning = "Verifique que su contraseña sea idéntica en ambos campos";
			$warning = 2;
			try 
			{
				$delay = 2;
				$url = "nuevo.php?w=".$warning."";
				if (!headers_sent() && $delay == 2) {
					ob_end_clean();
					header("Location: " . $url);
				}
				// Performs a redirect once headers have been sent
				echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
				exit();
			} catch (Exception $err) {
				return $err->getMessage();
			}
		}
		else if($verificarNo > 0)
		{
			//$warning = "Usuario ya existente. Por favor selecciona otro";	
			$warning = 0;
			try 
			{
				$delay = 2;
				$url = "nuevo.php?w=".$warning."";
				if (!headers_sent() && $delay == 2) {
					ob_end_clean();
					header("Location: " . $url);
				}
				// Performs a redirect once headers have been sent
				echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
				exit();
			} catch (Exception $err) {
				return $err->getMessage();
			}	
		}
		else 
		{
			
			$activacion = "Prueba";
			$confirmed = 1;
			$con_code = rand();
			$headers = 'From:registro@ignisventas.com' . "\r\n" .
    'Reply-To: contacto@ignisventas.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
			
		//	$d = strtotime("+1 week");
			//$fin = date("Y-m-d h:i:s", $d);
			
			$sql = mysqli_query($con, " INSERT INTO `users`(`us_user`, `us_password`, `us_nombre`, `us_apellido`, `us_mail`, `us_confirmed`, `us_code`)
							 VALUES ('$an_usuario','$an_password','$an_nombre','$an_apellidos','$an_email','$confirmed','$con_code')");
		

				$message="Bienvenido a Client BOX, la herramienta de gestión de ventas de productos financieros.Haga click en el siguiente link para confirmar su suscripción:
		
										http://www.ignisventas.com/crm/confirmation.php?username=$an_usuario&con_code=$con_code";
										
				$message = wordwrap($message, 70);

				mail($an_email,"Confirmación de suscripción a Client BOX", $message, $headers);
			
			echo "<h1>Bien!</h1><p>Hemos enviado un mensaje de confirmación a su correo electrónico. <br>
			Confirme su cuenta para automatizar su gestión de ventas</p>"; 
		
			try 
			{
				$delay = 5;
				$url = "login.php";
				if (!headers_sent() && $delay == 0) {
					ob_end_clean();
					header("Location: " . $url);
				}
				// Performs a redirect once headers have been sent
				echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
				exit();
			} catch (Exception $err) {
				return $err->getMessage();
										}										
		}
	} 
	
	
?>





<table>
<tr>
	<td>
    	<?php 
			if(isset($_REQUEST['w']))
			{
				if($_REQUEST['w'] == 0)
				{
					echo "Usuario ya existente. Por favor selecciona otro";
				}
				else if($_REQUEST['w'] == 1)
				{
					echo "Por favor revise que todos los campos esten llenos ";
				}
				else if($_REQUEST['w'] == 2)
				{
					echo "Verifique que su contraseña sea idéntica en ambos campos ";
				}	
			}
			else
			{
			}
		?>
    </td>
</tr>
</table>

<h2>Regístrese como usuario</h2>

<form action="nuevo.php" enctype="multipart/form-data" name="recordForm" id="recordform" method="post">
<label>
<textarea class="FormElement" name="an_nombre" id="an_nombre" placeholder="Nombres"  ></textarea>
</label>
<label>
<textarea class="FormElement" name="an_apellidos" id="an_apellidos" placeholder="Apellidos"  ></textarea>
</label>
<label>
<textarea class="FormElement" name="an_email" id="an_email" placeholder="E-mail"  ></textarea>
</label>
<label>
<textarea class="FormElement" name="an_usuario" id="an_usuario" placeholder="Usuario"  ></textarea>
</label>

<label>
<input type="password" name="an_password" id="an_password" placeholder="Contraseña"  ></textarea>
</label>
 
 <label>
<input type="password" name="an_password2" id="an_password2" placeholder="Repetir contraseña"  ></textarea>
</label>
 
   <input type="submit" name="btnNewRecord" id="btnNewRecord" value="Nuevo usuario"   />
   	</label></form> 
            

</div>
</body>

</html>