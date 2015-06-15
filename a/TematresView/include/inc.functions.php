<?php
/*****************************************************************************************
** © 2009 POULAIN Nicolas – nicolas.poulain@ouvaton.org **
** **
** Ce fichier est une partie de tematres view, licencié **
** sous licence "CeCILL version 2". **
** La licence est décrite plus précisément dans le fichier : LICENSE.txt **
** **
** ATTENTION, CETTE LICENCE EST GRATUITE ET LE LOGICIEL EST **
** DISTRIBUÉ SANS GARANTIE D'AUCUNE SORTE **
** ** ** ** **
** This file is a part of the free software project tematres view,
** licensed under the "CeCILL version 2". **
**The license is discribed more precisely in LICENSES.txt **
** **
**NOTICE : THIS LICENSE IS FREE OF CHARGE AND THE SOFTWARE IS DISTRIBUTED WITHOUT ANY **
** WARRANTIES OF ANY KIND **
*****************************************************************************************/


/*****************************************************************************************
// CONFIGURATION
*****************************************************************************************/

// Two cases
// 1. simple thesaurus : you have to give the entire adress of the services.php file
// 2. multi-tematres use : you have to give the common adress and the GET argument is the name of the dir you want to use
// you can call the thesaurus with list_thesaurus.php if 'view' is in the right folder
//$http_base = "http://127.0.0.1/svn_collectionlibre/collectionlibre/trunk/tematres" ;
$http_base = "http://143.107.154.55/pt-br/services.php" ;

// do you want suggestions if search have no results : true for yes / false for no
$_suggestion = true ;

// just for CollectionLibre's use - determine the prefix of input field of calling form
$_prefix_form = "valeur" ; // default =NULL

// lang : only fr_FR available
$_lang = "pt_BR" ;

// this function is used after print a term : you can for example send a function that write in the start calling form
// id : term_id of the term who is calling this function
// string : string of the term who is calling this function
// options : array, what you need, default NULL
// return string // to print with echo
function personnal_add($id,$string,$options=NULL) {
	global $form_input_name ;
	$string = addslashes($string) ;
	$insert = "<a href=\"#\" onClick=\"opener.document.formul.termoresposta.value = ( opener.document.formul.termoresposta.value + $string; ' );return false;\">
		<img src=\"images/bullet_add.png\" />
		</a>" ;
	return $insert ;
}

/*****************************************************************************************
// FUNCTIONS
*****************************************************************************************/

require_once("lang/$_lang.php") ;

function secure_data($data,$type="alnum") {
	switch ( $type ) {
		case "alnum" :
			// suppression des caracteres pas catholiques
			$data = preg_replace('/[^[:alnum:]-_.]/',"",$data);
			$data = preg_replace('/\s/', '', $data) ;
			// miniscules
			$data = strtolower($data) ;
		break ;
		case "sql" :
			// vire les balises
			$data = strip_tags($data) ;
			// zappe le magic_quote déprécié
			if(get_magic_quotes_gpc()) {
				if(ini_get('magic_quotes_sybase'))
					$data = str_replace("''", "'", $data) ;
				else $data = stripslashes($data) ;
			}
			$data = trim($data) ;
			$data = mysql_real_escape_string($data) ;
		break ;
		default : // int
			$data = preg_replace('/[^0-9]/','',$data);
			if ( $data == "" ) $data = 0 ;
			$data = (int) $data ;
		break ;
	}
	return $data ;
}
?>