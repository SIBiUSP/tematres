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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>interface.html</title>
		<script src="jquery-1.3.2.min.js" type="text/javascript"></script>
		<script src="jquery.form.js" type="text/javascript"></script>
	</head>
	<body>
	<?php
	if ( $handle = opendir("../") ) {
		// lecture du dossier
		$i = 0 ;
		while (false !== ($file = readdir($handle))) {
			if ( is_dir("../$file") && $file!="." && $file!=".." && substr($file,0,9)=="thesaurus" ) {
				$liste_module[$i] = $file ;
				$i++ ;
			}
		}
		if ( isset($liste_module) ) {
			echo "<ul class=\"niv2\">" ;
			foreach( $liste_module as $thesaurus ) {
				echo "<li>" ;
				echo "$thesaurus <small><a href=\"../view/view_thesaurus.php?thesaurus=$thesaurus&champs=domaine&source=1\">Voir</a> <a href=\"../$thesaurus\">Gestion</a></small>" ;
				echo "</li>" ;
			}
			echo "</ul>" ;
			echo "</li>" ;
		}
	}
	?>
	</body>
</html>