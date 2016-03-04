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

// string 2 URL legible
// based on source from http://code.google.com/p/pan-fr/
function string2url ( $string )
{
		$string = strtr($string,
		"�������������������������������������������������������",
		"AAAAAAaaaaaaCcOOOOOOooooooEEEEeeeeIIIIiiiiUUUUuuuuYYyyNn");

		$string = str_replace('�','AE',$string);
		$string = str_replace('�','ae',$string);
		$string = str_replace('�','OE',$string);
		$string = str_replace('�','oe',$string);

		$string = preg_replace('/[^a-z0-9_\s\'\:\/\[\]-]/','',strtolower($string));

		$string = preg_replace('/[\s\'\:\/\[\]-]+/',' ',trim($string));

		$res = str_replace(' ','-',$string);

		return $res;
}


//form http://www.compuglobalhipermega.net/php/php-url-semantica/	
function is_utf ($t)
{
	if ( @preg_match ('/.+/u', $t) )
	return 1;
}


/* Banco de vocabularios 2013 */


// XML Entity Mandatory Escape Characters or CDATA
function xmlentities ( $string , $pcdata=FALSE)
{
if($pcdata == TRUE)
	{
	return  '<![CDATA[ '.str_replace ( array ('[[',']]' ), array ('',''), $string ).' ]]>';
	}
	else
	{
	return str_replace ( array ( '&', '"', "'", '<', '>','[[',']]' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;','',''), $string );
	}

}


function fixEncoding($input, $output_encoding="UTF-8")
{
	return $input;
	// For some reason this is missing in the php4 in NMT
	$encoding = mb_detect_encoding($input);
	switch($encoding) {
		case 'ASCII':
		case $output_encoding:
			return $input;
		case '':
			return mb_convert_encoding($input, $output_encoding);
		default:
			return mb_convert_encoding($input, $output_encoding, $encoding);
	}
}


/**
 * Checks to see if a string is utf8 encoded.
 *
 * NOTE: This function checks for 5-Byte sequences, UTF8
 *       has Bytes Sequences with a maximum length of 4.
 *
 * @author bmorel at ssi dot fr (modified)
 * @since 1.2.1
 *
 * @param string $str The string to be checked
 * @return bool True if $str fits a UTF-8 model, false otherwise.
 * From WordPress
 */
function seems_utf8($str) {
	$length = strlen($str);
	for ($i=0; $i < $length; $i++) {
		$c = ord($str[$i]);
		if ($c < 0x80) $n = 0; # 0bbbbbbb
		elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
		elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
		elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
		elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
		elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
		else return false; # Does not match any model
		for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
			if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
				return false;
		}
	}
	return true;
}


/*
convierte una cadena a latin1
* http://gmt-4.blogspot.com/2008/04/conversion-de-unicode-y-latin1-en-php-5.html
*/
function latin1($txt) {
 $encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
 if ($encoding == "UTF-8") {
     $txt = utf8_decode($txt);
 }
 return $txt;
}

/*
convierte una cadena a utf8
* http://gmt-4.blogspot.com/2008/04/conversion-de-unicode-y-latin1-en-php-5.html
*/
function utf8($txt) {
 $encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
 if ($encoding == "ISO-8859-1") {
     $txt = utf8_encode($txt);
 }
 return $txt;
}


function clean($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

      // &#x0040 @ search for the hex values
      $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // &#00064 @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }

   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);

   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
               $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
               $pattern .= ')?';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}


function XSSprevent($string)
{

    require_once 'htmlpurifier/HTMLPurifier.auto.php';

	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	$clean_string = $purifier->purify($string);

	return $clean_string;
}

?>
