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

// GET data example : ?thesaurus=thesaurus_domaine&champs=domaine&source=1
// common_js_data is available in ajax js functions with get'method
$dest = ( !empty($_GET['source']) ) ? secure_data($_GET['source'],"alnum") : NULL ;
$thesaurus = ( !empty($_GET['thesaurus']) ) ? secure_data($_GET['thesaurus'],"alnum") : NULL ;
$champs = ( !empty($_GET['champs']) ) ? secure_data($_GET['champs'],"alnum") : NULL ;
$common_js_data = "thesaurus=http://143.107.154.55/pt-br/services.php&dest=$dest" ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>interface.html</title>
		<link rel="stylesheet" href="css/default/default.css" type="text/css" media="all" />
		<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
		<script src="js/jquery.form.js" type="text/javascript"></script>
		<script src="js/common.js" type="text/javascript"></script>
		<script>
		// When the document loads do everything inside here ... test UTF-8 é
		$(document).ready(function(){
			$('#alphabetic').hide() ;
			$('#search').hide() ;
			$('#detail').hide() ;
			// formulaire
			$('#form_search').ajaxForm({
				// target identifies the element(s) to update with the server response
				target: "#result_search",
				beforeSubmit: function() {
					$('#loading_search').show('fast');
					$('#result_search').fadeOut('slow');
					$('#result_search').empty() ;
				},
				success: function() {
					$('#loading_search').hide('fast');
					$('#result_search').fadeIn('slow');
				}
			});
		}) ;
		function extend(thesaurus,id) {
			// si le sub est affichÃ©
			//var id_send = $(this).attr("id") ;
			//var level = $(this).attr("title") ;
			var id_send = $(id).attr("id") ;
			var level = $(id).attr("title") ;
			if ( $("#sub_"+id_send).css("display") == "none" ) {
				//$(".content").slideUp("slow");
				//si le dessous est vide on le charge
				if ( $("#sub_"+id_send).html() == "" ) {
					$.ajax({
						method: "get",url: "ajax_request_tematres.php",data:"<?php echo $common_js_data ?>&action=1&id_send="+id_send+"&level_send="+level,
						beforeSend: function(){$("#loading_"+id_send).fadeIn("slow");}, //show loading just when link is clicked
						complete: function(){ $("#loading_"+id_send).fadeOut("fast");}, //stop showing loading when the process is complete
						success: function(html){ //so, if data is retrieved, store it in html
							//$(".content").show("slow"); //animation
							$("#sub_"+id_send).html(html); //show the html inside
							$("#sub_"+id_send).fadeIn("slow"); //animation
							//$(".content").html(html); //show the html inside .content div
						}
					}); //close $.ajax(
				}
				// sinon on l'affiche simplement
				else {
					$("#sub_"+id_send).show("slow");
				}
			}
			else {
				$("#sub_"+id_send).hide("slow");
			}
		}
		function extend_alphabetic(thesaurus,arg) {
			$.ajax({
				method: "get",url: "ajax_request_tematres.php",data:"<?php echo $common_js_data ?>&action=2&arg="+arg,
				beforeSend: function(){
					$("#loading_alphabetic").show("fast");
					$("#result_alphabetic").empty();
				}, //show loading just when link is clicked
				complete: function(){ $("#loading_alphabetic").hide("fast");}, //stop showing loading when the process is complete
				success: function(html){ //so, if data is retrieved, store it in html
					//$(".content").show("slow"); //animation
					$("#result_alphabetic").html(html); //show the html inside
					$("#result_alphabetic").show("fast"); //animation
					//$(".content").html(html); //show the html inside .content div
				}
			}); //close $.ajax(
		}
		function extend_detail(thesaurus,arg) {
			$.ajax({
				method: "get",url: "ajax_request_tematres.php",data:"<?php echo $common_js_data ?>&action=4&id="+arg,
				beforeSend: function(){
					$('.content').hide() ;
					$('#detail').show() ;
					$("#loading_detail").show("fast");
					$("#result_detail").empty();
				}, //show loading just when link is clicked
				complete: function(){ $("#loading_detail").hide("fast");}, //stop showing loading when the process is complete
				success: function(html){ //so, if data is retrieved, store it in html
					//$(".content").show("slow"); //animation
					$("#result_detail").html(html); //show the html inside
					$("#result_detail").show("fast"); //animation
					//$(".content").html(html); //show the html inside .content div
				}
			}); //close $.ajax(
		}
		function search_from_similar(arg) {
			$.ajax({
				method: "get",url: "ajax_request_tematres.php",data:"<?php echo $common_js_data ?>&action=3&term_search="+arg,
				beforeSend: function(){
					//$('.content').hide() ;
					//$('#detail').show() ;
					$("#loading_search").show("fast");
					$("#result_search").empty();
				}, //show loading just when link is clicked
				complete: function(){
					$("#loading_search").hide("fast");
				}, //stop showing loading when the process is complete
				success: function(html){ //so, if data is retrieved, store it in html
					//$(".content").show("slow"); //animation
					$("#result_search").html(html); //show the html inside
					//$("#result_detail").show("fast"); //animation
					//$(".content").html(html); //show the html inside .content div
				}
			}); //close $.ajax(
		}
		</script>
	</head>
	<body>
		<div id="popup" style="display:block;border:1px solid #808080;text-align:left;margin:10px;padding:10px 10px 10px 20px;">
			<div id="tabs">
				<a href="#" onClick="tabs('thematic')">
						<span><?php  echo $message[1] ?></span></a> |
				<a href="#" onClick="tabs('alphabetic')">
						<span><?php  echo $message[2] ?></span></a> |
				<a href="#" onClick="tabs('search')">
						<span><?php  echo $message[3] ?></span></a> |
				<a href="#" onClick="tabs('detail')">
						<span><?php  echo $message[4] ?></span></a>
			</div>

			<div id="thematic" class="content">
				<h2>
				<?php  echo $message[5] ?>
				</h2>
				<?php
				include("./ajax_request_tematres.php") ;
				?>
			</div>
			<div id="alphabetic" class="content">
				<h2>
				<?php  echo $message[6] ?>
				</h2>
				<?php
				$i = "a" ;
				while ( $i != "z" ) {
					echo "<a href=\"#\" onClick=\"extend_alphabetic('$thesaurus','$i');return false;\">" ;
					echo strtoupper($i) ;
					echo "</a> " ;
					$i++ ;
				}
				?>
				<div class="loading" id="loading_alphabetic" style="display:none"></div>
				<div id="result_alphabetic"></div>
			</div>
			<div id="search" class="content">
				<h2>
				<?php  echo $message[7] ?>
				</h2>
				<form id="form_search" method="get" action="ajax_request_tematres.php">
					<input type="text" name="term_search" size="20" value="" />
					<input type="hidden" name="action" value="3" />
					<input type="hidden" name="thesaurus" value="<?php echo $thesaurus ?>" />
					<input type="submit" value="<?php  echo $message[8] ?>" />
				</form>
				<div class="loading" id="loading_search" style="display:none"></div>
				<div id="result_search"><div id="text"></div></div>
			</div>
			<div id="detail" class="content">
				<h2>
				<?php  echo $message[9] ?>
				</h2>
				<div class="loading" id="loading_detail" style="display:none"></div>
				<div id="result_detail"></div>
			</div>
		</div>
	</body>
</html>
