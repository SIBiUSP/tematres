<?php
include_once('config.ws.php');
include_once('common/vocabularyservices.php');

//function to create drop down from values of NT
function HTMLdoSelect($URL_BASE,$term_id)
{

				$vocabData=getURLdata($URL_BASE.'?task=fetchVocabularyData');

				$term_id=(int) $term_id;

			    $rows='<div class="input-group input-group-lg">';
			    
			    $dataTerm=getURLdata($URL_BASE.'?task=fetchTerm&arg='.$term_id);

			    $rows.='<label style="font-weight: bold;" for="tag_'.$term_id.'" title="'.(string) $vocabData->result->title.' : '.(string) $dataTerm->result->term->string.'">';
			    $rows.='<a href="'.$vocabData->result->uri.'index.php?tema='.$term_id.'" title="'.(string) $vocabData->result->title.' : '.(string) $dataTerm->result->term->string.'">'.(string) $dataTerm->result->term->string.'</a></label>';
			  

			    $rows.='<select id="tag_'.$term_id.'">';
			    
				$data=getURLdata($URL_BASE.'?task=fetchDown&arg='.$term_id);

				if($data->resume->cant_result > 0)	{	
					foreach ($data->result->term as $value){
					$rows.= '<option value="'.$value->term_id.'">'.$value->string.'</option>';
					}
				}

		    $rows.='</select>';
		    $rows.='<p> </p>';
		    $rows.='</div><!-- /input-group -->	   ';

return $rows;
}

?>
<!DOCTYPE html>
<html>
<title>Fuente de datos para procesos de gestión</title>

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
    	<h1>Datos de formularios</h1>
    </div>
     	<div class="span0">
    		<form name="searchForm" method="get" id="searchform">
			  
			  <?php

			  	echo HTMLdoSelect($URL_BASE,219);
			  	echo HTMLdoSelect($URL_BASE,263);
			  	echo HTMLdoSelect($URL_BASE,46);
			  	echo HTMLdoSelect($URL_BASE,233);
			  	echo HTMLdoSelect($URL_BASE,24);
			  	echo HTMLdoSelect($URL_BASE,261);
			  ?>

			</form>

    </div>

  </div>
  </div>
</div></body></html>
