<?php
/*
 *      index.php
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

require('config.php');

require('include/vocabularyservices.php');

$arrayVocabulary=getTemaTresData($params["TEMATRES_URI_SERVICE"]);

$params["lang"] = $arrayVocabulary["result"]["lang"]; //lang
$lang_vocabulary=str_replace ( array('ca','de','en','es','fr','it','nl','pt') , array('català','deutsch','english','español','français','italiano','nederlands','portugüés'), $arrayVocabulary["result"]["lang"]);
$tags_vocabulary=$arrayVocabulary["result"]["title"].', '.$arrayVocabulary["result"]["keywords"].', '.$lang_vocabulary;


$params["content"] = isset($_POST["q"]) ? $_POST["q"] : $params["content"] ;
$size_words = isset($_POST["size_words"]) ? $_POST["size_words"] : 1 ;


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
    <title>TemaTres keywords extraction service | <?php echo $arrayVocabulary["result"]["title"];?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<link rel="stylesheet" type="text/css" href="css/style.css">

    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie7.css"/>
    <![endif]-->

</head><body id="body" class="page-home">
    
<div class="top-bar">
    <div class="tabs">
     <h1><a href="index.php" title="TemaTres Keywords Distiller">TemaTres Keywords Distiller</a></h1>
    </div>
</div>
    <div class="home-box">   
        <div class="tagline-area">
  
        <h1> <a class="title" href="<?php echo $arrayVocabulary["result"]["uri"];?>" title="<?php echo $arrayVocabulary["result"]["title"];?>"><?php echo $arrayVocabulary["result"]["title"];?></a></h1>      
        <p>Topics base: <?php echo $tags_vocabulary;?></p>
        </div>
        
        <div class="search-area">            
            <div id="search-home-box">
                <form id="search-form" action="index.php#distilled_keywords" method="post">              
                    <div class="text-field">
                    <label for="search-q"><?php echo 'Text with more than '.$param['min_text_length'].' and less than '.$param['max_text_length'].' words.';?></label>
                    <textarea id="search-q" name="q" rows="10" cols="70"><?php echo $params["content"];?></textarea></div>
                    <div class="selector">
                    <label for="size_words">KeyWord Extraction Method</label>
                    
                    <select name="size_words" id="size_words">
                     <option value="1" <?php echo ($size_words==1) ? 'selected':'';?> > Local parser (one word)</option>
                     <option value="2" <?php echo ($size_words==2) ? 'selected':'';?>>Local parser (two words)</option>                    
                     <option value="3" <?php echo ($size_words==3) ? 'selected':'';?>>Yahoo keyExtractionService</option>                    
                     <option value="4" <?php echo ($size_words==4) ? 'selected':'';?>>AlchemyAPI keyExtractionService</option>                    
                    </select>                    
                    </div>                
  
                    <div class="button-field"><button type="submit" id="distill-submit" class="tbtn"><span>Distill</span></button></div>
                </form>
            </div>
            
            <?php           
            if(isset($_POST["q"])) {                       
			$lengt_text=str_word_count($params["content"]);
			
			
			echo '<h2>Your text have '.str_word_count($params["content"]).' words</h2>';

			//Revisar cantidad de palabras
			if($param['min_text_length'] >str_word_count($params["content"]) && str_word_count($params["content"]) <=$param['max_text_length'])		
			{
				echo '<p>This tool need Text with more than '.$param['min_text_length'].' and less than '.$param['max_text_length'].' words</p>';							
			}            
            else            
            {
				
					if(($_POST["q"]) && ($arrayVocabulary["result"]["uri"]))
					{		
						include('include/autokeyword/class.autokeyword.php');
						
						switch ($size_words) {

							//AlchemyAPI
							case '4':
							// Load the AlchemyAPI module code.
							include("include/AlchemyAPI/AlchemyAPI.php");


							// Create an AlchemyAPI object.
							$alchemyObj = new AlchemyAPI();


							// Load the API key from disk.
							$alchemyObj->loadAPIKey("include/AlchemyAPI/api_key.php");


							// Extract topic keywords from a text string.
							$resultJson = $alchemyObj->TextGetRankedKeywords(utf8_encode($params["content"]),AlchemyAPI::JSON_OUTPUT_MODE);

							$resultsObject=json_decode($resultJson);
							
						    $alchemyKeywords=$resultsObject->keywords;
						    
						    $results=array();
						    
							foreach($alchemyKeywords as $alchemyKeyword)
								{
									$results[].=$alchemyKeyword->text;
								}
							break;

							//Yahoo extractor
							case '3':
									$results=gettags($params["content"],$tags_vocabulary);
									$results=$results["ResultSet"]["Result"];
						
							break;

							//local method: 2 words
							case '2':
								$keyword = new autokeyword($params, "utf8");			
								
								$keyword=$keyword->parse_2words($params);
																
								$keyword=substr($keyword,0,-1);
								
								$results =  explode(",", $keyword);				
						
							break;

							//local method: one word
							case '1':
								$keyword = new autokeyword($params, "utf8");			
								
								$keyword=$keyword->parse_words($params);
								
								$keyword=substr($keyword,0,-1);

								$results =  explode(",", $keyword);				
							break;
						}
						
														
							echo '<ul id="distilled_keywords" class="term_list">';
							$iKeyword=0;
							foreach ($results as $termsArray) 
							{
								$iKeyword=++$iKeyword;
								if((strlen($termsArray)>=$params['min_word_length']) && ($iKeyword<=$param["MAX_FETCH_KEYWORDS"]))
								{
									echo '<li>'.$termsArray.': '.getTemaTresTerm($params["TEMATRES_URI_SERVICE"],$termsArray).'</li>';						
								}	
							}
							echo '</ul>';				
					}
					
					
			}//fin del check cantidad de palabras
		
		}
	
            ?>
            
        </div>
    </div>
    <div class="footer-box">
    <ul class="colophon">
        <li>Distilled by <a href="http://www.vocabularyserver.com">TemaTres</a> vocabulary web services</li>
        </ul>
        <ul>
            <li class="off tab-image"><a href="http://www.vocabularyserver.com/smarthesaurus/index.php">TemaTres Smar<span class="naranja">Thesaurus</span></a></li>
            <li class="off tab-image"><a href="http://www.r020.com.ar/tematres/demo/index.php?setLang=en">TemaTres Demo Site</a></li>
            <li class="off tab-image"><a href="http://www.vocabularyserver.com/">VocabularyServer.com</a></li>
            <li class="off tab-tweet"><a href="http://www.vocabularyserver.com/visualvocabulary/">VisualVocabulary</a></li>      

    </ul>
</div>

</body></html>
