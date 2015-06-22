<?php
/*
 *      config.php
 *      
 *      Copyright 2011 diego <tematres@r020.com.ar>
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
Config options
*/

// URL for the TemaTres web services provider
$params["TEMATRES_URI_SERVICE"]="http://143.107.154.55/pt-br/services.php";


$param['min_text_length']= 50;
$param['max_text_length']= 2000;					

//set the length of keywords you like
$params['min_word_length'] = 4;  //minimum length of single words
$params['min_word_occur'] = 2;  //minimum occur of single words

$params['min_2words_length'] = 3;  //minimum length of words for 2 word phrases
$params['min_2words_phrase_length'] = 8; //minimum length of 2 word phrases
$params['min_2words_phrase_occur'] = 1; //minimum occur of 2 words phrase

$param["MAX_FETCH_KEYWORDS"] = 8;


//content for examples
$params["content"]="

The Massachusetts Arts Curriculum Framework sets the expectation that all students in the Commonwealth’s public schools will become proficient in understanding the arts and communicating in at least one arts discipline by the time they graduate from high school. In order to achieve these goals, it is recommended in this framework that students begin their study of the arts in the elementary grades, and continue to study one or more of the arts disciplines throughout middle and high school.
Designed to provide guidance to teachers, administrators, and parents, the Framework is composed of five major sections. 
	A.	The Core Concept presents the essential purpose of making the arts part of each student’s education. 
	B.	The Guiding Principles are the underlying tenets of learning, teaching, and assessment in the discipline. 
	C.	The Strands (The Arts Disciplines: Dance, Music, Theatre, and Visual Arts; and Connections: History, Criticism, and Links to Other Disciplines) describe the overall content and skills of learning, teaching, and assessment in the arts. 
	D.	The Standards define what students should know and be able to do by the end of various stages of their arts study. The standards have been designed with three purposes in mind:
	to acknowledge the importance of both the content and the skills that students learn as they study the arts;
	to help teachers create meaningful curriculum and classroom assessments; and
	to serve as the basis for models of district and statewide assessment of student perform­ance in the arts.
	E.	The Appendices and Selected Resources Sections provide reference materials that support the Standards.
The Arts Framework was conceptualized and written by practicing artists and teachers of the arts from elementary school through higher education. It was designed for use in conjunction with the other Massachusetts Curriculum Frameworks in English Language Arts, Foreign Languages, Health, History and Social Science, Mathematics, and Science and Technology/Engineering. Its content parallels that of the federally funded national Standards for the Arts: Dance, Music, Theatre, and Visual Arts, developed by the Consortium of National Arts Education Associations under the guidance of the National Committee for Standards in the Arts.1

";

?>
