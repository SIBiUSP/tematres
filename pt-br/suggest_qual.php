<?php
/*
 * proxy para datos de autocompletar
*/
include("config.tematres.php");
header('Content-type: application/json');

$pagephp_encode = (in_array($CFG["_CHAR_ENCODE"],array('utf-8','iso-8859-1'))) ? $CFG["_CHAR_ENCODE"] : 'utf-8';

$searchq		=	XSSprevent($_GET['query']);
$node		=	XSSprevent($_GET['node']);
$tema           =       $_GET['tema'];
$typeSearch		= ($_GET["t"]=='0') ? '0' : CFG_SUGGESTxWORD;
 

if(isset($node)) echo getData4jtree($node);

 
if (!$searchq) return;

if(strlen($searchq)>= $CFG["MIN_CHAR_SEARCH"]){	
	echo getData4AutocompleterQualificadores($searchq,$tema,$typeSearch);
}
?>