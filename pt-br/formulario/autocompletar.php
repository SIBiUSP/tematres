<?php
include_once('config.ws.php');
include_once('common/vocabularyservices.php');
?>
<!DOCTYPE html>
<html>
<title>Ejemplo de autocompletar</title>

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

 	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>    
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />

<script type="text/javascript">

	   var options, a;
	   var onSelect = function(val, data) { $('#searchform #id').val(data); $('#searchform').submit(); };   
	    jQuery(function(){
	    options = {
		    serviceUrl:'common/proxy.php' ,
		    minChars:2,
		    delimiter: /(,|;)\s*/, // regex or character
		    maxHeight:400,
		    width:600,
		    zIndex: 9999,
		    deferRequestBy: 0, //miliseconds
		    noCache: false, //default is false, set to true to disable caching
		    // callback function:
		    //onSelect: onSelect,
	    	};
	    a = $('#query').autocomplete(options);
		}); 


</script>		


</head>
<body>

<div class="container">
  <div class="row">
    <div class="span9" id="content">
      
    <div class="page-header">
    	<a href="index.php" title="inicio">Index</a>
    	<h1>Ejemplo de autocompletar</h1>
    </div>
     	<div class="span0">
    		<form name="searchForm" method="get" id="searchform">
			    <div class="input-group input-group-lg">
			      <input type="text" id="query" name="arg"  class="form-control">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">Go!</button>
			      </span>
			    </div><!-- /input-group -->	    	
			</form>

    </div>

  </div>
  </div>
</div></body></html>
