<?php
if (!defined('WEBTHES_ABSPATH') ) die("no access");
/*
 *      vocabularyservices.php
 *      
 *      Copyright 2014 diego ferreyra <tematres@r020.com.ar>
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
 */


/*
Funciones de consulta de datos
*/

/*
Hacer una consulta y devolver un array
* $uri = url de servicios tematres
* +    & task = consulta a realizar
* +    & arg = argumentos de la consulta
*/
function getURLdata($url){
	
	if (extension_loaded('curl'))
	{
	   $rCURL = curl_init();
	   curl_setopt($rCURL, CURLOPT_URL, $url);
	   curl_setopt($rCURL, CURLOPT_HEADER, 0);
	   curl_setopt($rCURL, CURLOPT_RETURNTRANSFER, 1);
	   $xml = curl_exec($rCURL);
	   curl_close($rCURL);	
		
	}
	else 
	{
		$xml=file_get_contents($url) or die ("Could not open a feed called: " . $url);
	}
	
	$content = new SimpleXMLElement($xml);
	
	return $content;
}






/*
 * 
 * 
 * Funciones generales 
 * 
 * 
 * 
 */



//form http://www.compuglobalhipermega.net/php/php-url-semantica/	
function is_utf ($t)
{
	if ( @preg_match ('/.+/u', $t) )
	return 1;
}


/* Banco de vocabularios 2013 */

?>
