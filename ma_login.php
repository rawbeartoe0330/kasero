<?php 
session_start();
if (isset($_SESSION["lider"])) {
    header("location: admin.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = $_POST["username"]; // filter everything but numbers and letters
    $password = md5(preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"])); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "scripts/con.php"; 
    $sql = mysqli_query($con, "SELECT * FROM manager WHERE ma_usuario='$manager' AND ma_password='$password' LIMIT 1"); 
    // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysqli_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ 
          $id = $row["ma_id"];
			 $ma_apellidos = $row["ma_apellidos"];
			 $ma_nombre = $row["ma_nombre"];
			 $ma_sexo = $row["ma_sexo"];
			 $ag_id = $row["ag_id"];
		 }

		 $_SESSION["ma_id"] = $id;
		 $_SESSION["ma_nombre"] = $ma_nombre;
		 $_SESSION["ma_apellidos"] = $ma_apellidos;
		 $_SESSION["ma_sexo"] = $ma_sexo;
		 $_SESSION["lider"] = $manager;
		 $_SESSION["ma_password"] = $password;
		 $_SESSION["ag_id"] = $ag_id;
		 header("location: admin.php");
         exit();
         
    } else {
		echo "<img src=\"img/lock.svg\"  width='80px' height='80px'><br/><div  id=\"titulos\" >Por favor verifique su usuario y password</div>";
		
		try {
			$delay = 2.5;
			$url = "ma_login.php";
			if (!headers_sent() && $delay == 10) {
				ob_end_clean();
				header("Location: " . $url);
			}
			// Performs a redirect once headers have been sent
			echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
			exit();
		} catch (Exception $err) {
			return $err->getMessage();
		}
		
		exit();
	}
}
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

	$warning = "";
	
	include "scripts/con.php";
	
	if(isset($_POST["btnSign"]))
	{	
		$username = mysqli_real_escape_string($con, $_POST['username']); 
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$password = md5($password);
		
		$verificar = mysqli_query($con, "SELECT `ma_usuario` FROM `manager` WHERE `ma_usuario`='$username'");
		$verificarNo = mysqli_num_rows($verificar);
		
		if($username == "" || $password == "" )
		{
			//$warning = "Por favor revise que todos los campos esten llenos";	
			$warning = 1;
			try 
			{
				$delay = 0;
				$url = "ma_login.php?w=".$warning."";
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
		else if($password != $pass2)
		{
			//$warning = "Verifique que su clave de seguridad sea idéntica en ambos campos";
			$warning = 2;
			try 
			{
				$delay = 0;
				$url = "ma_login.php?w=".$warning."";
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
		else if($verificarNo > 0)
		{
			//$warning = "Usuario ya existente. Por favor selecciona otro";	
			$warning = 0;
			try 
			{
				$delay = 0;
				$url = "ma_login.php?w=".$warning."";
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
		else 
		{
			
			$activacion = "Prueba";
			
			$d = strtotime("+1 week");
			$fin = date("Y-m-d h:i:s", $d);
			
			$sql = mysqli_query($con, " INSERT INTO `analista`(`usuario`, `an_nombre`, `an_apellidos`, `an_email`, `an_password`, `an_sexo`,  `ag_id`,`fin`) VALUES ('$username','$nombres','$apellidos','$email','$password','$an_sexo','$activacion','$fin')");
		
			try 
			{
				$delay = 0;
				$url = "registrado.php";
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
	
	else
	{
		if(isset($_POST["btnSign"]))
		{
			$warning = "";	
		}
	}
?>
<!DOCTYPE HTML>

<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
 
<?php $dynamicTitle = "El Kasero - Panel de Administrador";?>

<title><?php echo $dynamicTitle; ?></title>
 

 <link rel="stylesheet" type="text/css" href="style/style.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="botones/favicon.ico" type="image/x-icon">
<meta http-equiv="Cache-Control" content="max-age=3600">

</head>

<body>

 
<div class="relative">

<div id="wel"> <img src="img/logo-el-kasero.png" width="200px" alt="Bienvenidos El Kasero® - Manager"></div>

  <div class="absolute">
<h1>Acceso de Administrador</h1>

<form id="form1" name="form1" method="post" action="ma_login.php">
<label><input class="sign" name="username" type="text" id="username"  autocomplete="on"  placeholder="Usuario"/></label>
<label><input name="password" type="password" id="password" autocomplete="on" placeholder="Contraseña" /></label>
<input type="submit" name="button" id="button" value="Ingresar" size="20" />
</form>


<div class='man'>
 <a href="login.php" >Soy cliente de El Kasero®</a> </div>
  </div>

</div>
 </div>




</body>
</html>