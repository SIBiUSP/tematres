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

function tabs(id) {
	$('.content').hide() ;
	$('#'+id).show() ;
	return false ;
}

// function call by personnal print
// it coulb be use to print text in calling form
function add_selection(separateur,champs, valeur) {
	with ( opener.document.formulaire[champs] ) {
		if ( value == "" ) value = valeur ;
		else {
			value += " " + separateur + " " + valeur ;
		}
	}
}
