<?php
include_once('config.ws.php');
include_once('common/vocabularyservices.php');
?>
<!DOCTYPE html>
<html>
<title>Ejemplo búsqueda de término similar</title>

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
    	<a href="index.php" title="inicio">Index</a>
    	<h1>Ejemplo de búsqueda de término similar</h1>
    </div>
     	<div class="span0">
    		<form name="searchForm" action="similar.php" method="get" id="searchform">
			    <div class="input-group input-group-lg">
			      <input type="text" id="query" name="arg"  class="form-control">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="submit">Go!</button>
			      </span>
			    </div><!-- /input-group -->	    	
			</form>

	<?php

	if($_GET["arg"])
	{

		$string=XSSprevent($_GET["arg"]);

		$data=getURLdata($URL_BASE.'?task=fetchSimilar&arg='.urlencode($string));
	
	if($data->resume->cant_result > 0)	{	
		
		echo 'Parecido a <i>'.$string.'</i>: <strong>'.(string) $data->result->string.'</strong>' ;
		}

	}
	?>
    </div>

  </div>
  </div>
</div></body></html>
