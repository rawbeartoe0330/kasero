<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
    <td width="33%" valign="top" align="center">
<h1>Quienes Somos</h1>
    <div class="txt">  
   <p>Fundamos el Kasero® para contribuir al desarrollo de los productores locales del Ecuador</p>
    
<p>El Kasero es un colectivo que decidió innovar en la forma de producir, distribuir y comercializar productos de alta calidad, administrando
una red de personas comprometidas con los productos conscientes con la salud y el bienestar de las comunidades. </p>    

    
<p>A partir una sólida relación de confianza entre los agentes que intervienen en el mercado: productores, intermediarios y consumidores,
 queremos difundir y compartir los conocimientos,
 visiones, necesidades y anhelos, que se plasman en los productos que se comercializan a través de nuestra plataforma. </p>    


    
<p>El deseo es brindar un servicio de calidad óptima para los clientes que a través de la plataforma puedan adquirir una variedad de bienes y servicios. Es nuestra intención,
 formar alianzas con productores que quieran comercializar sus productos de una manera
 eficiente y sostenible. Promoviendo un estado de vida saludable y el consumo de alimentos de origen natural.</p>    

    
<p>Las alianzas estratégicas son el combustible para que las cooperativas tomen forma y vida dentro de las sociedades. 
El Kasero busca crear diferentes alianzas con determinados sectores de la ciudadanía ecuatoriana para poder alcanzar juntos beneficios
 económicos, sociales, culturales, políticos, técnicos y profesionales.  </p>    


</div>
       </td>
       
       <td width="33%" valign="top" align="center">
       
       <h2>Misión</h2>
        <div class="txt">  
		<p>Darle un enfoque dinámico y equitativo a la relación entre productores y consumidores mediante una intermediación consciente. 
		</p>       
       
       <h2>Visión</h2>
       
		<p>El Kasero busca brindar una herramienta digital que ayude con la concientización en la forma de 
		producir y consumir, con base a las exigencias de la tierra y del futuro presente</p>       
          </div>    
       </td>
       <td  width="34%" valign="top" align="center">
<h2>Propuesta del negocios</h2>       
     
     <div class="txt">  
	<p>El Kasero busca brindar una herramienta digital que ayude con la concientización en la forma de 
		producir y consumir, con base a las exigencias de la tierra y del futuro presente</p>
		
			<p>La colaboración de personas que sientan necesario un cambio de paradigma en las relaciones comerciales de intercambio de bienes/servicios es de suma importancia para que el proyecto se consolide y 
			marque un hito dentro del desarrollo del país. La propuesta para quienes quieran ingresar como productores afiliados es la siguiente:</p>       
       <ul>
		<li>En ventas mensuales de 1 a 999 USD, el porcentaje de repartición será 30% para ElKasero y 70% para los productores. </li>       
       <li>En ventas mensuales de 1.000 a 2.999 USD, el porcentaje de repartición será 25% para ElKasero y 75% productores. </li> 
       <li>n ventas mensuales mayores a 3.000 USD, el porcentaje de repartición será 20% para ElKasero y 80% productores.</li> 
       </ul>
       
       <p>*Los pagos son mensuales</p> </div>
       </td>
       
       
       
    </tr>
</table>
<?php 
include "includes/footer.php";

?>
</body>

</html>