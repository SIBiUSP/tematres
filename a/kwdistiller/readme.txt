/*
 *      readme.txt
 *      
 *      Copyright 2011 diego ferreyra <tematres@r020.com.ar>
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
version 1.1
TemaTres Keywords Distiller is a php tool to extract terms from a text and use it to obtain keywords from a specific controlled vocabulary.

TemaTres Keywords distiller use the terminological web services provided by TemaTres. TemaTres  is a web tool to manage, publish and exploit controlled vocabularies and other formals representation of knowledge ( thesauri, taxonomies, glossaries, etc) .

To configure TemaTres Keywords Distiller, please edit the config file (config.php) and configure the URL for the terminological web services provided by TemaTres.

To config AlchemyAPI, you need to obtain your API KEY in http://www.alchemyapi.com/api/register.html and then put it in keywordistiller/include/AlchemyAPI/api_key.php


Example:
// URL for the TemaTres web services provider
$params["TEMATRES_URI_SERVICE"]="http://vocabularyserver.com/scot/services.php";

For more details about TemaTres terminological web services, please visit:

or you can try any TemaTres web services provider without arguments, eg: http://vocabularyserver.com/scot/services.php


If you have any problems with these instructions, or if they weren't clear
or just didn't plain work, please let me know at tematres@r020.com.ar

diego ferreyra
tematres@r020.com.ar
http://www.vocabularyserver.com
