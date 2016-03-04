<?php
#   TemaTres : aplicación para la gestión de lenguajes documentales #       #
#                                                                        #
#   Copyright (C) 2004-2008 Diego Ferreyra tematres@r020.com.ar
#   Distribuido bajo Licencia GNU Public License, versión 2 (de junio de 1.991) Free Software Foundation
#  
###############################################################################################################
#
include("config.tematres.php");
$metadata=do_meta_tag();
 #/*
#term reporter
#*/
if(($_GET[mod]=='csv') && (substr($_GET[task],0,3)=='csv') && ($_SESSION[$_SESSION["CFGURL"]][ssuser_id]))  
{
	return wichReport($_GET[task]);
}

$search_string ='';
$search_string = (doValue($_GET,FORM_LABEL_buscar)) ? XSSprevent(doValue($_GET,FORM_LABEL_buscar)) : '';


include_once('formulario/config.ws.php');
include_once('formulario/common/vocabularyservices.php');

//function to create drop down from values of NT
function HTMLdoSelect($URL_BASE,$term_id)
{

    $vocabData=getURLdata($URL_BASE.'?task=fetchVocabularyData');

    $term_id=(int) $term_id;

    $rows='<div class="input-group input-group-lg">';

    $dataTerm=getURLdata($URL_BASE.'?task=fetchTerm&arg='.$term_id);

    $rows.='<label style="font-weight: bold;" for="tag_'.$term_id.'" title="'.(string) $vocabData->result->title.' : '.(string) $dataTerm->result->term->string.'">';
    $rows.='<p><a href="'.$vocabData->result->uri.'index.php?tema='.$term_id.'" title="'.(string) $vocabData->result->title.' : '.(string) $dataTerm->result->term->string.'">'.(string) $dataTerm->result->term->string.':</a>&nbsp;</p></label>';


    $rows.='<select id="tag_'.$term_id.'">';

    $data=getURLdata($URL_BASE.'?task=fetchDown&arg='.$term_id);

    if($data->resume->cant_result > 0)	{
            foreach ($data->result->term as $value){
            $rows.= '<option value="'.$value->term_id.'">'.$value->string.'</option>';
            }
    }

    $rows.='</select>';
    $rows.='<p> </p>';
    $rows.='</div><!-- /input-group -->	   ';

return $rows;
}

?>

<!DOCTYPE html>
<html lang="<?php echo LANG;?>">

<head>
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo $metadata["metadata"]; ?>

<!-- Favicon USP -->
<link type="image/x-icon" href="http://www.producao.usp.br/themes/BDPI/images/faviconUSP.ico" rel="icon" />
<link type="image/x-icon" href="http://www.producao.usp.br/themes/BDPI/images/faviconUSP.ico" rel="shortcut icon" />

<!-- CSS -->

<link rel="stylesheet" href="<?php echo T3_WEBPATH;?>css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo T3_WEBPATH;?>bootstrap/css/vcusp-theme.css">

 <!-- Jquery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


<!-- Script para criar o pop-up do popterms -->
<script>
    function creaPopup(url)
    {
      tesauro=window.open(url, 
      "Tesauro", 
      "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=yes,fullscreen=no,height=600,width=450,left=500,top=0"
      )
    }
 </script>

<!-- Scripts do autocompletar -->
<script type="text/javascript" src="formulario/js/jquery.autocomplete.js"></script>    
<link rel="stylesheet" type="text/css" href="formulario/css/jquery.autocomplete.css" />
<script type="text/javascript">

	   var options, a;
	   var onSelect = function(val, data) { $('#construtor #id').val(data); $('#construtor').submit(); };   
	    jQuery(function(){
	    options = {
		    serviceUrl:'formulario/common/proxy.php' ,
		    minChars:2,
		    delimiter: /(,|;)\s*/, // regex or character
		    maxHeight:400,
		    width:600,
		    zIndex: 9999,
		    deferRequestBy: 0, //miliseconds
		    noCache: false, //default is false, set to true to disable caching
		    // callback function:
		    //onSelect: onSelect,
	    	};
	    a = $('#termoresposta').autocomplete(options);
		}); 


</script>
 
<!-- Script para copiar - USP -->
<script type="text/javascript" src="<?php echo T3_WEBPATH;?>zeroc/ZeroClipboard.js"></script>

<!-- Scripts USP -->
<script type="application/javascript" src="js.php" charset="utf-8"></script>

</head>
<body>
<!--uspbarra - ínicio -->
	<div id="uspbarra" style="background-color:transparent;border-style:none">
		<div class="uspLogo"  style="background-color:transparent;border-style:none">
			<img class="img-responsive" onclick="javascript:window.open('http://www.usp.br');" alt="USP" style="cursor:pointer;position: absolute;bottom: 0px;" src="../common/images/Logo_usp_composto.jpg" />
		</div>
		<div class="panel-group" id="accordion"  style="background-color:transparent;border-style:none">
			<div class="panel" style="background-color:transparent;border-style:none">
                                     <div id="collapseThree" class="panel-collapse collapse" style="background-color:transparent">
                                                        <div class="panel-body usppanel" style="background-color:#b3b3bc">
                                                            <div class="row" style="background-color:transparent">
                                                                <div class="col-md-3 text-center">
                                                                    <a href=http://www.usp.br/sibi/><img src="http://www.producao.usp.br/a/barrausp/images/sibi.png" title="SIBi - Sistema Integrado de Bibliotecas da USP" width=150 height=69 border=0 /></a>
                                                                    <div class="uspmenu_top_usp">
                                                                        <ul>
                                                                            <li><a href="http://www.producao.usp.br/a/barrausp/barra/creditos.html" target=_blank>Créditos</a></li>
                                                                            <li><a href="http://www.producao.usp.br/a/barrausp/barra/contato.html" target=_blank>Fale com o SIBi</a></li>
                                                                            <div><img src="http://www.producao.usp.br/a/barrausp/images/spacer.gif" width=10 height=10 /></div>
                                                                            <div class="panel-heading">PORTAL DE BUSCA INTEGRADA</div>
                                                                            <div class="panel-body">Um único ponto de acesso a todos os conteúdos informacionais disponíveis para a comunidade USP.</div>
                                                                            <br />
                                                                            <form class="form-inline" role="form" method="get" name="busca" action="http://www.buscaintegrada.usp.br/primo_library/libweb/action/search.do" onsubmit="if (document.getElementById(\'mySearch\').value==\'Busca geral...\'||document.getElementById(\'mySearch\').value==\'\'){alert(\'Preencha o campo de busca!\ return false;} else {return true;}" >
                                                                                <input type hidden name="dscnt" value="0">
                                                                                <input type hidden name="frbg" value="">
                                                                                <input type hidden name="scp.scps" value=\'scope:("USP"),primo_central_multiple_fe\'>
                                                                                <input type hidden name="tab" value="default_tab" >
                                                                                <input type hidden name="dstmp" value="1330609813304" >
                                                                                <input type hidden name="srt" value="rank" >
                                                                                <input type hidden name="ct" value="search" >
                                                                                <input type hidden name="mode" value="Basic" >
                                                                                <input type hidden name="dum" value="true" >
                                                                                <input type hidden name="indx" value="1" >
                                                                                <input type hidden name="tb" value="t" >
                        <input type hidden name="fn" value="search" >
                            <input type hidden name="vid" value="USP" >
                                <div class="form-group">
                                    <input type="text" name="vl(freeText0)" id="mySearch" size=22  value="Busca geral..."  onfocus="this.value = ''" tabindex=1 />
                                </div>
                                <div class="form-group">    
                                    <input type="submit" value="Buscar" tabindex=2 >
                                </div>            

                                </form>                                
                                </ul>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <ul class="uspmenu_top_usp">
                                        <div class="panel-heading">BIBLIOTECAS USP</div>
                                        <li><a href="http://www.bibliotecas.usp.br/lista.htm" target="_blank">Lista alfabética</a></li>
                                        <li><a href="http://www.sibi.usp.br/30anos" target="_blank">SIBiUSP 30 Anos</a></li>
                                    </ul>
                                    <ul class="uspmenu_top_usp">
                                        <ul class="uspmenu_top_usp">
                                            <div class="panel-heading">PRODUTOS E SERVIÇOS</div>
                                            <li><a href="http://www.acessoaberto.usp.br/" target="_blank">Acesso Aberto</a></li>
                                            <li><a href="http://dedalus.usp.br/" target="_blank">Acesso ao catálogo Dedalus</a></li>
                                            <li><a href="http://www.buscaintegrada.usp.br" target="_blank">Portal de Busca Integrada</a></li>
                                            <li><a href="http://www.sibi.usp.br/Vocab/" target="_blank">Vocabulário Controlado</a></li>
                                            <li><a href="http://workshop.sibi.usp.br/index.php"  target="_blank">Writing Center - WorkShops</a></li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul class="uspmenu_top_usp">	
                                        <div class="panel-heading">BIBLIOTECAS DIGITAIS</div>
                                        <li><a href="http://bore.usp.br" target="_blank">Obras Raras e Especiais</a></li>
                                        <li><a href="http://revistas.usp.br" target="_blank">Portal de Revistas</a></li>
                                        <li><a href="http://www.producao.usp.br" target="_blank">Biblioteca Digital da Produção Intelectual (BDPI)</a></li>
                                    </ul>
                                    <ul class="uspmenu_top_usp">
                                        <div class="panel-heading">PARCERIAS INTERNAS</div>
                                        <li><a href="http://repositorio.iau.usp.br" target="_blank">Repositório Digital IAU</a></li>
                                        <li><a href="http://www.brasiliana.usp.br" target="_blank">Biblioteca Digital Brasiliana</a></li>
                                        <li><a href="http://www.ieb.usp.br/catalogo_eletronico" target="_blank">Biblioteca Digital do IEB</a></li>
                                        <li><a href="http://www.mapashistoricos.usp.br" target="_blank">Cartografia Histórica</a></li>
                                        <li><a href="http://www.teses.usp.br" target="_blank">Teses/Dissertações</a></li>

                                    </ul>                        
                                </div>
                                <div class="col-md-3">
                                    <ul class="uspmenu_top_usp">
                                        <div class="panel-heading">PARCERIAS EXTERNAS</div>
                                        <li><a href="http://regional.bvsalud.org/php/index.php" target="_blank">BVS em Saúde</a></li>
                                        <li><a href="http://enfermagem.bvs.br/php/index.php" target="_blank">BVS em Enfermagem</a></li>
                                        <li><a href="http://odontologia.bvs.br" target="_blank">BVS em Odontologia</a></li>
                                        <li><a href="http://www.bvs-psi.org.br"  target="_blank">BVS Psicologia Brasil</a></li>
                                        <li><a href="http://www.saudepublica.bvs.br/php/index.php" target="_blank">BVS em Saúde Pública</a></li>
                                        <li><a href="http://www.bvmemorial.fapesp.br" target="_blank">Biblioteca Virtual da América Latina</a></li>
                                        <li><a href="http://www.bv.fapesp.br" target="_blank">Biblioteca Virtual da FAPESP</a></li>
                                        <li><a href="http://ppegeo.igc.usp.br/scielo.php" target="_blank">PaGEO (Geociências)</a></li>
                                        <li><a href="http://www.periodicos.capes.gov.br" target="_blank">Portal CAPES</a></li>
                                        <li><a href="http://www.scielo.org/php/index.php?lang=pt" target="_blank">SciELO</a></li>
                                    </ul>                        
                                </div>                    
                                </div>
                                </div>
                                </div>
                <div class="usptab" style="border-style:none;background-color:transparent;" style="position:relative;">
                    <ul class="usplogin" style="border-style:none;" >
                        <li class="uspleft" style="position:relative; z-index:0"></li>
                        <li id="usptoggle" style="position:relative; z-index:0">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" id="uspopen" class="uspopen" border="0" style="display: block;">
                                <img src="http://www.producao.usp.br/a/barrausp/images/seta_down.jpg" border="0">
                                    <img src="http://www.producao.usp.br/a/barrausp/images/barrinha.png" alt="SIBi - Abrir o painel" width="35" height="16" border="0" title="SIBi - Abrir o painel">
                                        </a>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" id="uspclose" style="display: none;" class="uspclose" border="0">
                                            <img src="http://www.producao.usp.br/a/barrausp/images/seta_up.jpg" border="0">
                                                <img src="http://www.producao.usp.br/a/barrausp/images/barrinha.png" width="35" height="16" border="0" title="SIBi - Fechar painel" alt="SIBi - Fechar painel">
                                                    </a>
                        </li>
                        <li class="uspright" style="background-color:transparent" style="position:relative; z-index:0; display:visible"></li>
                                                    </ul>
                                                    </div> </div>              
				</div>
	</div>
<!-- uspbarra - fim -->  

<div class="container">
	<div class="row">
	<div class="col-md-8">
		<div class="logo">
			<h1><a href="index.php" title="<?php echo $_SESSION[CFGTitulo].': '.MENU_ListaSis;?> "><?php echo $_SESSION[CFGTitulo];?></a></h1>
		</div>
	</div>
	<div class="col-md-4">
		<address>
		<strong>Departamento Técnico do Sistema Integrado de Bibliotecas da USP</strong><br>
			Rua da Biblioteca, S/N - Complexo Brasiliana<br>
			05508-050 - Cidade Universitária, São Paulo, SP - Brasil<br>
			<abbr title="Phone">Tel:</abbr> (0xx11) 3091-4439<br>
			<strong>E-mail:</strong> <a href="mailto:#">atendimento@sibi.usp.br</a>
		</address>
	</div>
</div>
	
<!-- Barra de navegação USP - Inicio -->

			<header class="navbar navbar-inverse" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
					<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation" >
						<ul class="nav navbar-nav" >
							<li class="active"><a title="<?php echo MENU_Inicio;?>" href="index.php"><span class="glyphicon glyphicon-home"></span> <?php echo MENU_Inicio;?></a></li>
							<?php
								//hay sesion de usuario
								if($_SESSION[$_SESSION["CFGURL"]][ssuser_nivel]){
								echo HTMLmainMenu();
				//no hay session de usuario
				}else{
				?>
					 <li>
                                            <!-- Button trigger modal -->
                                            <a type="button" data-toggle="modal" data-target="#login"><?php echo MENU_MiCuenta;?></a>
					    <!-- Modal -->
                                            <div class="modal" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    	          <?php
                                                                if($_SESSION[$_SESSION["CFGURL"]]["ssuser_id"]){
                                                                require_once(T3_ABSPATH . 'common/include/inc.misTerminos.php');
                                                                }else{
                                                            ?>
                                                         <div id="bodyText">
                                                        <?php
                                                            if($_POST["task"]=='user_recovery')
                                                            {
                                                                    $task_result=recovery($_POST["id_correo_electronico_recovery"]);		
                                                            }


                                                            if ($_GET["task"]=='recovery') 
                                                            {
                                                                    echo HTMLformRecoveryPassword();	
                                                            }
                                                            else 
                                                            {

                                                                    if(($_POST["task"]=='login') && (!$_SESSION[$_SESSION["CFGURL"]]["ssuser_id"])) 
                                                                    {
                                                                            $task_result=array("msg"=>t3_messages('no_user'));			
                                                                    }					
                                                                    echo HTMLformLogin($task_result);		
                                                            };

                                                            ?>

                                                    <?php
                                                                }
                                                               ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>                                                    
                                                  </div>
                                                </div>
                                              </div>
                                            </div> 
				<?php
				};
				?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
                                                    <li><a title="<?php echo LABEL_busqueda;?>" href="index.php?xsearch=1"><?php echo ucfirst(LABEL_BusquedaAvanzada);?></a></li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Idioma <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                          <li><a href="/pt-br">Português</a></li>
                                                          <li><a href="/en">English</a></li>
                                                          <!-- <li><a href="?setLang=es">Español</a></li> -->
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Equipe <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="equipe.php">Equipe de implementação</a></li>
                                                            <li><a href="equipe_atual.php">Grupos de gestão atuais</a></li>
							    <li><a title="<?php echo MENU_Catalogacao;?>" href="catalogacao.php"><?php echo MENU_Catalogacao;?></a></li> 
                                                        </ul>
                                                    </li>
						                                                     
                                                    <li><a title="<?php echo MENU_Sobre;?>" href="sobre.php"><?php echo MENU_Sobre;?></a></li>                                                 
						</ul>
						<!-- Search Box -->
							<form method="get" id="simple-search" name="simple-search" action="index.php" class="navbar-form navbar-right" onsubmit="return checkrequired(this)">
							<div class="form-group">
								<input type="text" id="query" class="form-control" name="<?php echo FORM_LABEL_buscar;?>" size="25" value=""/>
							</div>
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
							</form>
					</nav>
			</header>

<!-- Barra de navegação USP - Fim -->
			
			
<!-- body, or middle section of our header -->   

<!-- ###### Body Text ###### -->

<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Construtor de termo para catalogação</h3>
</div>
<div class="panel-body">
<div class="form-group">
    <form name="construtor">    
<label for="termoresposta">
   <a href="#" onclick="creaPopup('../a/popterms/index.php?t=termoresposta&f=construtor&v=http://143.107.154.55/pt-br/services.php&loadConfig=1'); return false;">Consultar o VCUSP</a>
</label>
<br>
<input type="text" class="form-control" id="termoresposta" placeholder="Termo" data-dtermoresposta="" onblur="if(this.value!=this.dataset['dtermoresposta']) this.value='';" >
</div>

<div class="form-group">
<label class="sr-only" for="qualificador">Qualificador</label>
<?php echo HTMLdoSelect($URL_BASE,45185);?>
</div>
<div class="form-group">
<label class="sr-only" for="genero">Gênero e Forma</label>
<?php echo HTMLdoSelect($URL_BASE,32584);?>
</div>
<div class="form-group">
<label class="sr-only" for="profissoes">Profissões e ocupações</label>
<?php echo HTMLdoSelect($URL_BASE,44101);?>
</div>
<div class="form-group">
<?php echo HTMLdoSelect($URL_BASE,32628);?>
<label class="sr-only" for="geografico">Geográfico</label>
</div>
<div class="form-group">
<label class="sr-only" for="exampleInputPassword2">Data</label>
<input type="text" class="form-control" id="dataresposta" placeholder="Data" data-ddataresposta="">
</div>
<button id="btngerid" type="button" class="btn btn-default" onclick="btngerar()" onblur="msgseterr('')">Gerar</button><span id="msgerr" style="color:red;padding:5px;"></span>
<br><br>
<div class="form-group" id="resultwrapper" style="display:table;border-collapse:separate;border-spacing:5px;">
  <div id="resultado" name="resultado" class="alert alert-success" style="visibility:hidden;display:none;">
	<div style="display:table-cell;padding:5px;vertical-align:middle;width:100%;border:1px solid #55AA55;border-radius:4px;"></div>
	<div style="display:table-cell;vertical-align:middle;">
	  <button class="btn btn-default" style="display:inline-block">copiar</button>
	</div>
	<div style="display:table-cell;vertical-align:middle;">
	  <button class="btn btn-default" onclick="parentNode.parentNode.parentNode.removeChild(parentNode.parentNode)">x</button>
	</div>
  </div>
</div>
</div>
</div>
</div>
 </div>

<!-- Footer USP - Inicio -->
    <div class="footer">
        <div class="well well-lg">
            <a href="http://www.vocabularyserver.com/" title="TemaTres: vocabulary server">
            <img src="<?php echo T3_WEBPATH;?>/images/tematres-logo.gif"  width="42" alt="TemaTres"/></a>
            <a href="http://www.vocabularyserver.com/" title="TemaTres: vocabulary server">Desenvolvido usando TemaTres 2.0</a>
            <p>
				<?php
				//are enable SPARQL
				if(CFG_ENABLE_SPARQL==1)
				{
					echo '<a class="label label-info" href="'.$_SESSION["CFGURL"].'sparql.php" title="'.LABEL_SPARQLEndpoint.'">'.LABEL_SPARQLEndpoint.'</a>';
				}

				if(CFG_SIMPLE_WEB_SERVICE==1)
				{
					echo '  <a class="label label-info" href="'.$_SESSION["CFGURL"].'services.php" title="API"><span class="glyphicon glyphicon-share"></span> API</a>';
				}

					echo '  <a class="label label-info" href="'.$_SESSION["CFGURL"].'xml.php?rss=true" title="RSS"><span class="icon-rss"></span> RSS</a>';
					echo '  <a class="label label-info" href="'.$_SESSION["CFGURL"].'index.php?s=n" title="'.ucfirst(LABEL_showNewsTerm).'"><span class="glyphicon glyphicon-fire"></span> '.ucfirst(LABEL_showNewsTerm).'</a>';
				?>


			</p>

         		
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59814582-1', 'auto');
  ga('send', 'pageview');

</script>
  </div>
        </div>


<!-- Footer USP - Fim -->
 </body>
</html>
