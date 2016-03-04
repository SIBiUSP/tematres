<?php
/*
*      config.ws.php
*
*      Copyright 2014 diego <tematres@r020.com.ar>
*
*      This program is free software; you can redistribute it and/or modify
*      it under the terms of the GNU General Public License as published by
*      the Free Software Foundation; either version 2 of the License, or
*      (at your option) any later version.
*
*      This program is distributed in the hope that it will be useful,
*      but WITHOUT ANY WARRANTY; without even the implied warranty of
*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*      GNU General Public License for more details.
*
*      You should have received a copy of the GNU General Public License
*      along with this program; if not, write to the Free Software
*      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
*      MA 02110-1301, USA.
*
********************************************************************************************
CONFIGURATION
***************************************************************************************
*/


/*
 * URL_BASE must be a TemaTres Web Services provider. Web services must be enabled on your Tematres services provider.
 * eg: http://www.r020.com.ar/tematres/services.php
*/
$URL_BASE='http://vocab.sibi.usp.br/tematres/pt-br/services.php';

// lang :
$lang_tematres = "pt_BR" ;

require_once("common/lang/$lang_tematres.php") ;


/*  In almost cases, you don't need to touch nothing here!!
 *  Absolute path to the directory where are located /common/include. 
 */
if ( !defined('WEBTHES_ABSPATH') )
	/** Use this for version of PHP < 5.3 */
	define('WEBTHES_ABSPATH', dirname(__FILE__));

?>
