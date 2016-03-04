<?php
include_once('config.ws.php');
include_once('common/vocabularyservices.php');
?>
<!DOCTYPE html>
<html>
<title>Ejemplos de explotación de web services terminológicos provistos por TemaTres</title>

  <meta http-equiv="cache-control" content="no-cache, mustrevalidate" /> 
  <meta content="text/html; charset=UTF-8" http-equiv="content-type" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!-- Jquery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


</head>
<body>

<div class="container">
  <div class="row">
    <div class="span9" id="content">
      
    <div class="page-header">
    	<h1>Ejemplos de explotación de web services terminológicos provistos por TemaTres</h1>
    </div>
     	<div class="span0">

     	<ul>
     		<li><a href="autocompletar.php" title="Ejemplo de autocompletar">Ejemplo de autocompletar</a></li>
     		<li><a href="similar.php" title="Ejemplo de búsqueda de término similiar">Ejemplo de búsqueda de término similiar</a></li>
        <li><a href="expandir.php" title="Ejemplo de expansión de búsqueda">Ejemplo de expansión de búsqueda</a></li>
     		<li><a href="form.php" title="Ejemplo de valores para formularios">Ejemplo de valores para formularios</a></li>
     	</ul>


     	<h2>Requerimientos</h2>

     	<ul>
     		<li>Servidor HTTP con cobertura PHP 5.x y acceso a la web pública.</li>
     		<li>PHP 5.x con el módulo cURL habilitada o  el parámetro allow_url_fopen habilitado</li>
     	</ul>

     	<h2>Instalación</h2>

     	<p>Editar archivo <code>config.ws.php</code> y configurar el parámetro <code>$URL_BASE</code> consginando la URL del proveedor de web services. 
     	<br>	
     	Ejemplo:
     	<br>

     	<code>	
     	
     	$URL_BASE='<?php echo $URL_BASE;?>';
     	</code>
     	</p>
    </div>

  </div>
  </div>
</div></body></html>
