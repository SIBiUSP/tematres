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

require_once('include/inc.functions.php') ;

$thesaurus = NULL ;
if ( substr($http_base,-12) == "services.php" )
	$adress = $http_base ;
else {
	if ( !empty($_REQUEST['thesaurus']) ) $thesaurus = secure_data($_REQUEST['thesaurus'],"alnum") ;
	$adress = "$http_base/$thesaurus/services.php" ;
}

$dest = ( !empty($_REQUEST['dest']) ) ? secure_data($_REQUEST['dest'],"alnum") : NULL ;
$form_input_name = $_prefix_form.$dest ;

function link_to_detail($id) {
	global $thesaurus ;
	$insert = "<a href=\"#\" onClick=\"extend_detail('$thesaurus','$id')\">
		<img src=\"images/bullet_go.png\" />
		</a>" ;
	return $insert ;
}

function link_to_search($arg) {
	global $thesaurus ;
	$insert = "<a href=\"#\" onClick=\"search_from_similar('$arg')\">
		<img src=\"images/bullet_go.png\" />
		</a>" ;
	return $insert ;
}

if ( !empty($_REQUEST['action']) ) {
	header("Cache-Control: no-cache") ;
	$action = $_REQUEST['action'] ; // security check with traitement_data inluded in CL
}
else $action = NULL ;
sleep(1) ;

switch ( $action ) {
	case 1 : // get child / specific terms of a generic term
		$id_parent = secure_data($_GET['id_send'],"int") ; // check security to do
		echo get_child($id_parent) ;
		break ;
	case 2 : // get from first letter
		$arg = secure_data($_GET['arg'],"alnum") ;
		echo get_letter($arg) ;
		break ;
	case 3 : // get from search
		$search = $_GET['term_search'] ;
		echo get_search($search) ;
		break ;
	case 4 : // get detailled page of a term
		$id = secure_data($_GET['id'],"int") ;
		echo "<div class=\"fil_ariane\">
			<em>$message[11]</em>" ;
		echo get_parent($id)."</div>" ;
		echo "<h3>".fetch_term($id)."</h3>" ;
		echo fetchAlt($id) ;
		//echo fetchDirectTerm($id) ;
		echo "<hr/>" ;
		echo fetch_notes($id) ;
		echo "<p><em>$message[12]</em></p>" ;
		echo get_children($id) ;
		break ;
	default : // get all term from level 0
		echo get_top_term() ;
}



/*###################################################################################################

FUNCTIONS TO DO ACTIONS

###################################################################################################*/


function get_top_term() {
	global $adress,$thesaurus ;
	$answer = "task=fetchTopTerms" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	foreach ( $xml->result as $list ) {
		foreach ($list as $term) {
			$rt .= '<div class="niveau_0">
				<a href="javascript:extend(\''.$thesaurus.'\',\'a#'.$term->term_id.'\')" id="'.$term->term_id.'" title="niveau_0" >'.
				$term->string.'
				</a>
				<div class="loading" id="loading_'.$term->term_id.'" style="display:none"></div>
				<div id="sub_'.$term->term_id.'" class="niveau_" style="display:none"></div>
				</div>'."\r\n" ;
		}
	}
	return $rt ;
}
function get_child($id_parent) {
	global $adress, $form_input_name, $thesaurus ;
	$answer = "task=fetchDown&arg=$id_parent" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= '<div class="niveau_1">' ;
			if ( $term->hasMoreDown > 0 ) {
				$rt .= '<a href="javascript:extend(\''.$thesaurus.'\',\'a#'.$term->term_id.'\')" id="'.$term->term_id.'" title="niveau_0" >'.$term->string.'</a>'.
				personnal_add($term->term_id,$term->string).' '.
				link_to_detail($term->term_id).'
				<div class="loading" id="loading_'.$term->term_id.'" style="display:none"></div><div id="sub_'.$term->term_id.'" class="niveau_" style="display:none"></div>' ;
			}
			else {
				$rt .= $term->string.' ' ;
				$rt .= personnal_add($term->term_id,$term->string).' ' ;
				$rt .= link_to_detail($term->term_id) ;
			}
			$rt .= '</div>'."\r\n" ;
		}

	}
	return $rt ;
}

function get_letter($arg) {
	// lecture
	global $adress, $message ;
	$answer = "task=letter&arg=$arg" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	$count = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= '<div class="niveau_1">' ;
			if ( $term->hasMoreDown > 0 ) {
				$rt .= '<a href="javascript:extend(\''.$thesaurus.'\',\'a#'.$term->term_id.'\')" id="'.$term->term_id.'" title="niveau_0" >'.$term->string.'</a>'.
				personnal_add($term->term_id,$term->string).' '.
				link_to_detail($term->term_id).'
				<div class="loading" id="loading_'.$term->term_id.'" style="display:none"></div><div id="sub_'.$term->term_id.'" class="niveau_" style="display:none"></div>' ;
			}
			else
				$rt .= $term->string.' '.
				personnal_add($term->term_id,$term->string).' '.
				link_to_detail($term->term_id) ;
			$rt .= '</div>'."\r\n" ;
			$count++ ;
		}
	}
	if ( $count == 0 ) $rt = "<p>$message[10].</p>" ;
	return $rt ;
}

function get_search($search) {
	// lecture
	global $adress, $message, $_suggestion ;
	// à envoyer en ISO ?? va savoir pourquoi ??
	$answer = "task=search&arg=".utf8_decode($search) ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = "<h2>$message[14]</h2>" ;
	$count = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$count++ ;
			$rt .= '<div class="niveau_1">' ;
			$rt .= $term->string ;
			$rt .= personnal_add($term->term_id,$term->string) ;
			$rt .= ' '.link_to_detail($term->term_id) ;
			$rt .= '</div>'."\r\n" ;
		}
	}
	if ( $count == 0 ) {
		$rt = "<br/><strong>".$message[10]."</strong>" ;
		// if suggestions are actived, do it
		if ( $_suggestion == true ) {
			$rt .= get_similar($search) ;
		}
	}
	return $rt ;
}

function get_similar($search) {
	// lecture
	global $adress, $message ;
	// à envoyer en ISO ?? va savoir pourquoi ??
	$answer = "task=fetchSimilar&arg=".utf8_decode($search) ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = "<h2>$message[17]</h2>" ;
	$count = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $string) {
			$count++ ;
			$rt .= '<div class="niveau_1">' ;
			$rt .= $string ;
			//$rt .= personnal_add($term->term_id,$term->string) ;
			$rt .= ' '.link_to_search($string) ;
			$rt .= '</div>'."\r\n" ;
		}
	}
	if ( $count == 0 ) {
		$rt = "<h2>$message[17]</h2><p>$message[18]</p>" ;
	}
	return $rt ;
}


function get_parent($id) {
	// lecture
	global $adress ;
	$answer = "task=fetchUp&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	$margin = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= '<div class="niveau_1" style="margin-left:'.$margin.'px">' ;
			$rt .= $term->string ;
			$rt .= personnal_add($term->term_id,$term->string) ;
			$rt .= ' '.link_to_detail($term->term_id) ;
			$rt .= '</div>'."\r\n" ;
			$margin += 20 ;
		}
	}
	return $rt ;
}
function get_children($id) {
	// lecture
	global $adress, $message ;
	$answer = "task=fetchDown&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	$count = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$count++ ;
			$rt .= '<div class="niveau_1">' ;
			$rt .= $term->string ;
			$rt .= ' '.personnal_add($term->term_id,$term->string) ;
			$rt .= ' '.link_to_detail($term->term_id) ;
			$rt .= '</div>'."\r\n" ;
		}

	}
	if ( $count == 0 ) $rt = $message[13] ;
	return $rt ;
}
function fetch_term($id) {
	// lecture
	global $adress ;
	$answer = "task=fetchTerm&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= '<div class="niveau_1">' ;
			$rt .= $term->string ;
			$rt .= '</div>'."\r\n" ;
		}
	}
	return $rt ;
}
function fetch_notes($id) {
	// lecture
	global $adress, $message ;
	$answer = "task=fetchNotes&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$rt = NULL ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= '<div class="niveau_1">' ;
			$temp = $term->note_type ;
			$rt .= "<u>".$message["$temp"]."</u> : ".$term->note_text ;
			$rt .= '</div>'."\r\n" ;
		}
	}
	return $rt ;
}
function fetchAlt($id) {
	// lecture
	global $adress, $message ;
	$answer = "task=fetchAlt&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$arr = array() ;
	$rt = NULL ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			$rt .= $term->string ;
			$arr[] = (string)$term->string ;
		}
	}
	if ( !empty($list) ) {
		$rt = $message[15]." <em>".implode(", ",$arr)."</em>" ;
		return $rt ;
	}
	else return false ;
}

function fetchDirectTerm($id) {
	// lecture
	global $adress, $message ;
	$answer = "task=fetchDirectTerms&arg=$id" ;
	$xml = simplexml_load_file("$adress?$answer") ;
	$TR = array() ;
	//$TG = array() ;
	$UP = array() ;
	$rt = NULL ;
	$margin = 0 ;
	foreach ( $xml->result as $list ) {
		foreach ($list->children() as $term) {
			switch ( $term->relation_type_id == "3" ) {
				case 2 : // TR
					$TR[] = (string)$term->string ;
					break ;
				case 3 : // TG
					//$TG[] = (string)$term->string ;
					$rt .= '<div class="niveau_1" style="margin-left:'.$margin.'px">' ;
					$rt .= $term->string ;
					$rt .= personnal_add($term->term_id,$term->string) ;
					$rt .= ' '.link_to_detail($term->term_id) ;
					$rt .= '</div>'."\r\n" ;
					$margin += 20 ;
					break ;
				case 4 : // UP - usado por - used for - utilisé pour
					$UP[] = (string)$term->string ;
				break ;
			}
		}
	}
	if ( !empty($UP) ) {
		$rt .= "<div id=\"UP\">".$message[15]." <em>".implode(", ",$UP)."</em></div>" ;
	}
	if ( !empty($TR) ) {
		$rt .= "<div id=\"TR\">".$message[16]." <em>".implode(", ",$TR)."</em></div>" ;
	}
	return $rt ;
}

?>