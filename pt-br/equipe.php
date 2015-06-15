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
 /*
term reporter
*/
if(($_GET[mod]=='csv') && (substr($_GET[task],0,3)=='csv') && ($_SESSION[$_SESSION["CFGURL"]][ssuser_id]))  
{
	return wichReport($_GET[task]);
}

$search_string ='';
$search_string = (doValue($_GET,FORM_LABEL_buscar)) ? XSSprevent(doValue($_GET,FORM_LABEL_buscar)) : '';
?>
<!DOCTYPE html>
<html lang="<?php echo LANG;?>">

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $metadata["metadata"]; ?>
	<link type="image/x-icon" href="http://www.producao.usp.br/themes/BDPI/images/faviconUSP.ico" rel="icon" />
	<link type="image/x-icon" href="http://www.producao.usp.br/themes/BDPI/images/faviconUSP.ico" rel="shortcut icon" />
	<link rel="stylesheet" href="<?php echo T3_WEBPATH;?>css/style.css" type="text/css" media="screen" />
	<!-- <link rel="stylesheet" href="<?php echo T3_WEBPATH;?>css/print.css" type="text/css" media="print" /> -->

	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/jquery.autocomplete.js"></script>   
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/jquery.mockjax.js"></script>
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/tree.jquery.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo T3_WEBPATH;?>css/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo T3_WEBPATH;?>css/jqtree.css" />
        
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo T3_WEBPATH;?>bootstrap/css/vcusp-theme.css">

	<!-- Bootstrap JS -->
	<script type='text/javascript' src='<?php echo T3_WEBPATH;?>jq/bdpi.min.js'></script>
	
	<?php
	if ($_SESSION[$_SESSION["CFGURL"]][ssuser_nivel]>0) 
	{
	?>

	<!-- Load TinyMCE -->
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>tiny_mce/jquery.tinymce.js"></script>
	<!-- /TinyMCE -->

	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/fg.menu.js"></script>   
	<link type="text/css" href="<?php echo T3_WEBPATH;?>jq/fg.menu.css" media="screen" rel="stylesheet" />
	<link type="text/css" href="<?php echo T3_WEBPATH;?>jq/theme/ui.all.css" media="screen" rel="stylesheet" />				
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>jq/jquery.jeditable.mini.js" charset="utf-8"></script>
	

<?php
}
?>
	<script type="application/javascript" src="js.php" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo T3_WEBPATH;?>forms/jquery.validate.min.js"></script>
	<?php
	 if($_SESSION[$_SESSION["CFGURL"]]["lang"][2]!=='en')
			echo '<script src="'.T3_WEBPATH.'forms/localization/messages_'.$_SESSION[$_SESSION["CFGURL"]]["lang"][2].'.js" type="text/javascript"></script>';
	?>
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
	
	<div id="arriba"></div>
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
                                                          <li><a href="?setLang=pt">Português</a></li>
                                                          <li><a href="?setLang=en">English</a></li>
                                                          <li><a href="?setLang=es">Español</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Equipe <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="equipe.php">Equipe de implementação</a></li>
                                                            <li><a href="equipe_atual.php">Grupos de gestão atuais</a></li>
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
			
			
<!-- body, or middle section of our header -->   

<!-- ###### Body Text ###### -->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Equipe de implementação</h3>
  </div>
  <div class="panel-body">
      <h4>Coordenadora de Pesquisa e Metodologia</h4>
      <p>Nair Yumiko Kobashi (ECA)</p>
      <h4>Coordenadora do Trabalho Técnico das Equipes Bibliotecárias</h4>
      <p>Vânia Mara Alves Lima (FAU)</p>
      <h4>Bibliotecários - Participantes da Elaboração do Vocabulário (1996-2000)</h4>
      <li>Beatriz Bergonzoni Battaglia (FE)</li>
      <li>Célia Maria de Sant´Anna (MP)</li>
      <li>Cibele Araújo Camargo Marques dos Santos (FSP)</li>
      <li>Eliana Rotolo (MAE)</li>
      <li>Elisa C. M. R. Pires (IGC)</li>
      <li>Emily Ann Labaki Agostinho (FAU)</li>
      <li>Filomena Katsutani (FAU)</li>
      <li>Luzia Marilda Zoppei Murgia e Moraes (FMVZ)</li>
      <li>Márcia Pilnik (IEB)</li>
      <li>Maria Angela de Toledo Leme (ESALQ)</li>
      <li>Maria Aparecida de L. C. Santos (FM)</li>
      <li>Maria Célia Amaral (FFLCH)</li>
      <li>Maria Cláudia Pestana (FMVZ)</li>
      <li>Marina Mayumi Yamashita (CQ)</li>
      <li>Renata Celli (FD)</li>
      <li>Rita de Cássia Santos Ferreira (IB)</li>
      <li>Sandra Tokarevicz (ECA)</li>
      <li>Silvia Regina Saran Della Torre Oliveira (EP)</li>
      <li>Sonia Maria Gardim (EE)</li>
      <li>Sonia Regina Yole Guerra (IGC)</li>
      <li>Suely Cafazzi Prati (FO)</li>
      <li>Vera Lúcia de Moura Accioli Cardoso (FE)</li>
      <li>Vera Regina Casari Boccato (FOB)</li>
      <p><b>Responsáveis pelo Levantamento e Hierarquização Terminológicos nas Unidades USP</b></p>
      <li>Beatriz Bergonzoni Battaglia (FE)</li>
      <li>Célia Maria de Sant´Anna (MP)</li>
      <li>Cibele Araújo Camargo Marques dos Santos (FSP)</li>
      <li>Dina E. Uliana (MAC)</li>
      <li>Ednéia Aparecida de Almeida (IF)</li>
      <li>Eliana Rotolo (MAE)</li>
      <li>Elisa C. M. R. Pires (IGC)</li>
      <li>Elza Correa Granja (IP)</li>
      <li>Emily Ann Labaki Agostinho (FAU)</li>
      <li>Filomena Katsutani (FAU)</li>
      <li>Giacomina Faldini (FD)</li>
      <li>Izair de Sousa (IO)</li>
      <li>Lúcia T. Votta de Carvalho (IP)</li>
      <li>Luzia Marilda Zoppei Murgia e Moraes (FMVZ)</li>
      <li>Márcia Ippolito Bueno de Camargo (ECA)</li>
      <li>Márcia Medeiros de Carvalho (MP)</li>
      <li>Márcia Pilnik (IEB)</li>
      <li>Maria Angela de Toledo Leme (ESALQ)</li>
      <li>Maria Aparecida de L. C. Santos (FM)</li>
      <li>Maria Célia Amaral (FFLCH)</li>
      <li>Maria Cláudia Pestana (FMVZ)</li>
      <li>Maria Cristina Dziabas (IFSC)</li>
      <li>Maria Imaculada Cardoso Sampaio (IP)</li>
      <li>Maria Lúcia Ribeiro (IME)</li>
      <li>Maria Regina M. Ferreira (MZ)</li>
      <li>Marily Antonelli Graeber (ICB)</li>
      <li>Marina Mayumi Yamashita (CQ)</li>
      <li>Olímpio Jorge Medeiros (ICB)</li>
      <li>Regiane Pereira dos Santos (EEFE)</li>
      <li>Renata Celli (FD)</li>
      <li>Rita de Cássia Santos Ferreira (IB)</li>
      <li>Rosana Alvarez Paschoalino (EESC)</li>
      <li>Sandra Aparecida Marques dos Santos (IAG)</li>
      <li>Sandra M. La Farina Rodovalho (FEA)</li>
      <li>Sandra Tokarevicz (ECA)</li>
      <li>Silvia Regina Saran Della Torre Oliveira (EP)</li>
      <li>Solange Maria S. Pucinelli (IQSC)</li>
      <li>Sonia G. Eleutério (FSP)</li>
      <li>Sonia Maria Gardim (EE)</li>
      <li>Sonia Regina Yole Guerra (IGC)</li>
      <li>Suely Cafazzi Prati (FO)</li>
      <li>aléria C. T. Ferraz (FOB)</li>
      <li>Valéria dos S. G. Martins (FMVZ)</li>
      <li>Vera Lúcia de Moura Accioli Cardoso (FE)</li>
      <li>Vera Regina Casari Boccato (FOB)</li>
      <p><b>Colaboradores</b></p>
      <li>Ademir do Carmo Merlin Barroso (EP)</li>
      <li>Adriana Bueno Moretti (ESALQ)</li>
      <li>Adriana Hypólito Nogueira (DT/SIBi)</li>
      <li>Analúcia dos Santos Viviani Recine (ECA)</li>
      <li>Antonia Lúcia Brocatti (BCRP)</li>
      <li>Clélia de Lourdes Lara Meguerditchian (EP)</li>
      <li>Eliana Maria Garcia Sabino (ESALQ)</li>
      <li>Elizabeth Dudziak (EP)</li>
      <li>Érica Beatriz P. M. Oliveira (IGC)</li>
      <li>Ester Myazaki (FD)</li>
      <li>Flávia Helena Cassin Passador (EESC)</li>
      <li>Inaie Marchizeli Wenzel (DT/SIBi)</li>
      <li>Josefa Naoka Uratsuka (EP)</li>
      <li>Letícia de Almeida Sampaio (FAU)</li>
      <li>Márcia Baumgartener (HU)</li>
      <li>Márcia E. G. Grandi (FFLCH)</li>
      <li>Marcia Regina M. Saad (ESALQ)</li>
      <li>Márcia Rosetto (DT/SIBi)</li>
      <li>Maria Cristina Martinez Bonésio (EP)</li>
      <li>Maria Cristina Moura R. de Andrade (ESALQ)</li>
      <li>Maria Cristina Olaio Villela (EP)</li>
      <li>Maria Elizabete de Carvalho Ota (ECA)</li>
      <li>Maria Gisele Fonseca Oliveira (FEA)</li>
      <li>Maria Inês Conte (DT/SIBi)</li>
      <li>Maria Luiza Lourenço (FFLCH)</li>
      <li>Maria Nadir Minatel (EESC)</li>
      <li>Marina M. Macambyra (ECA)</li>
      <li>Neusa Yoscimoto (EP)</li>
      <li>Sandra H.M.G. Ribeiro dos Santos (ESALQ)</li>
      <li>Silvana Amélia X. de Aguiar Bonifácio (DT/SIBi)</li>
      <li>Silvia Lucia Ribeiro (EP)</li>
      <li>Silvia Neto do Vale Sverzut (EESC)</li>
      <li>Sonia Lucia Pacheco de Toledo Carvalho (FM)</li>
      <li>Sonia Marisa Luchesi (FFLCH)</li>
      <li>Tania Amir de Jesus Dias (FM)</li>
      <li>Vera Lucia Duarte (EP)</li>
      <li>Zaira Regina Zafalon (FEA)</li>
      <p><b>Técnicos de Biblioteca</b></p>
      <li>Ana Lúcia de Lira Facini (FFLCH)</li>
      <li>Antonio Carlos Fabretti Facco (ESALQ )</li>
      <li>Aparecida Elizabeth dos Santos (ESALQ)</li>
      <li>Josue Reinaldo Mota (ESALQ)</li>
      <li>Maria Célia Tonon Parra (FFLCH)</li>
      <li>Maria Verônica da Silva Ritter (FFLCH)</li>
      <li>Rosemary M.M.F. Gonçalves (MP)</li>
      <li>Rosilene Lefone (FAU)</li>
      <li>Sebastiana Campelo de Oliveira (IME)</li>
      <p><b>Alunos das Unidades USP</b></p>
      <li>Adriana Miyamura (FO)</li>
      <li>Arilson Borges Mendonça (FD)</li>
      <li>Denis Pimenta e Souza (FO)</li>
      <li>Evelyn Almeida Lucas Gonçalves (FOB)</li>
      <li>Frederico Werneck Kurtz (IO)</li>
      <li>Karine Piñera Marques (FOB)</li>
      <li>Leonardo Pinto Brandão (FMVZ)</li>
      <li>Luciano L. Nass (ESALQ)</li>
      <li>Mário James dos Anjos da Silva (FOB)</li>
      <li>Mônica Petti (IO)</li>
      <li>Regina Lúcia Sugayama (IB)</li>
      <li>Renato Massaharu Hassunuma (FOB)</li>
      <li>Sylvia M.M. Susini Ribeiro (IO)</li>
      <li>Tania Aparecida Silva Brito (IO)</li>

      <h4>Definição da base de dados</h4>
      <p><b>Bibliotecárias</b></p>
      <li>Adriana Hypólito Nogueira (DT/SIBi)</li>
      <li>Márcia Rosetto (DT/SIBi)</li>
      <li>Vânia Mara Alves Lima (FAU)</li>

      <h4>Desenvolvimento de software</h4>
      <p><b>Analista de Sistemas</b></p>
      <p><b>Software para Busca, Indexação e Recuperação do Vocabulário</b></p>
      <p><b>Desenho e Implementação do Banco de Dados</b></p>
      <li>João Carlos H. de Barcellos (DT/SIBi)</li>
      <p><b>Software para Cadastramento de Termos do Vocabulário</b></p>
      <li>João Carlos H. de Barcellos (DT/SIBi)</li>

      <h4>Docentes colaboradores, por áreas do conhecimento</h4>
CA100 CIÊNCIAS AGRÁRIAS
      <li>Alexandre Vaz Pires (ESALQ)</li>
      <li>Antonio Joaquim de Oliveira (ESALQ)</li>
      <li>Antonio Luiz Fancelli (ESALQ)</li>
      <li>Antonio Roberto Pereira (ESALQ)</li>
      <li>Casimiro Dias Gadanha Junior (ESALQ)</li>
      <li>Cyro Fúlvio Zinsly (ESALQ)</li>
      <li>Iran José Oliveira da Silva (ESALQ)</li>
      <li>José Antonio Frizzone (ESALQ)</li>
      <li>José Eurico Possebon Cyrino (ESALQ)</li>
      <li>Keigo Minami (ESALQ)</li>
      <li>Lilian Amorim (ESALQ)</li>
      <li>Lindolpho Capellari Junior (ESALQ)</li>
      <li>Luiz Carlos C. B. Ferraz (ESALQ)</li>
      <li>Marília Oetterer (ESALQ)</li>
      <li>Oriowaldo Queda (ESALQ)</li>
      <li>Paulo Fernando C. Araújo (ESALQ)</li>
      <li>Pedro Jacob Christofoletti (ESALQ)</li>
      <li>Raul Machado Neto (ESALQ)</li>
      <li>Roberto Antonio Zucchi (ESALQ)</li>
      <li>Rodolfo Hoffmann ESALQ)</li>
      <li>Silvio Moure Cícero (ESALQ)</li>
      <li>Solange G. Canniatti-Brazaca (ESALQ)</li>
      <li>Tasso Leo Krügner (ESALQ)</li>
      <li>Walter de Paula Lima (ESALQ)</li>
      <li>Zilmar Ziller Marcos (ESALQ)</li>
CB200 BIOCIÊNCIAS
      <li>Alberto Augusto G. de Freitas C. Ribeiro (IB)</li>
      <li>Blanche Christine P. de Bitner Mathe Leal (IB)</li>
      <li>Edmundo Ferraz Nonato (IO)</li>
      <li>Estela Maria Plastino (IB)</li>
      <li>Fábio Lang da Silveira (IB)</li>
      <li>Gisela Yuka Shimizu (IB)</li>
      <li>Luz Amelia Veja Pérez (IO)</li>
      <li>Marilene dos S. C. Bianconcini (IB)</li>
      <li>Mayza Pompeu (IO)</li>

CB300 CIÊNCIAS DA SAÚDE

CB310 EDUCAÇÃO FÍSICA E ESPORTE
      <li>Alberto Carlos Amadio (EEFE)</li>
      <li>Antonio Hebert Lancha Júnior (EEFE)</li>
      <li>Cláudia Lúcia de Moraes Forjaz (EEFE)</li>
      <li>Dalberto Luis De Santo (EEFE)</li>
      <li>Edison de Jesus Manoel (EEFE)</li>
      <li>Go Tani (EEFE)</li>
      <li>José Guilmar Mariz de Oliveira (EEFE)</li>
      <li>Luiz Augusto Teixeira (EEFE)</li>
      <li>Marcos Duarte (EEFE)</li>
      <li>Maria Augusta Peduti Dal Molin Kiss (EEFE)</li>
      <li>Patrícia Chakur Brum(EEFE)</li>
      <li>Rubens Lombardi Rodrigues (EEFE)</li>
      <li>Silene Sumire Okuma (EEFE)</li>
      <li>Valdir José Barbanti (EEFE)</li>

CB320 ENFERMAGEM

      <li>Cibele Andrucioli de Mattos Pimenta (EE)</li>
      <li>Diná de Almeida Lopes Monteiro da Cruz (EE)</li>
      <li>Miako Kimura (EE)</li>

CB330 MEDICINA

      <li>César Timo-Iaria (FM)</li>

CB350 ODONTOLOGIA

      <li>Alberto Consolaro (FOB)</li>
      <li>Alceu Sérgio Trindade Júnior (FOB)</li>
      <li>Carlos de Paula Eduardo (FO)</li>
      <li>Cesário Antonio Duarte (FO)</li>
      <li>Esther Goldenberg Birman (FO)</li>
      <li>Gerson Francisco de Assis (FOB)</li>
      <li>Giorgio De Micheli (FO)</li>
      <li>Guilherme dos Reis Pereira Janson (FOB)</li>
      <li>Jesus Carlos D'Andreo (FOB)</li>
      <li>João Adolfo Caldas Navarro (FOB)</li>
      <li>José Humberto Damante (FOB)</li>
      <li>José Luiz da Silva Lage Marques (FO)</li>
      <li>Luis Antonio Pugliesi Alves de Lima (FO)</li>
      <li>Maria Fidela de Lima Navarro (FOB)</li>
      <li>Nilce Emy Tomita (FOB)</li>
      <li>Odila Pereira da Silva Rosa (FOB)</li>
      <li>Rafael Yague Ballester (FO)</li>
      <li>Rumio Taga (FOB)</li>
      <li>Solange Mongelli de Fantini (FO)</li>
      <li>Sunao Taga Tamaki (FO)</li>

CB380 FARMÁCIA E COSMETOLOGIA

      <li>Elizabeth Igne Ferreira (FCF)</li>


CB400 SAÚDE ANIMAL

CB410 MEDICINA VETERINÁRIA E ZOOTECNIA

      <li>Helenice de Souza Spinosa (FMVZ)</li>
      <li>José Luiz Bernardino Merusse (FMVZ)</li>
      <li>Laudinor De Vuono (FMVZ)</li>
      <li>Maria Helena Matiko Akao Larsson (FMVZ)</li>
      <li>Mitika Kuribayashi Hagiwara (FMVZ)</li>
      <li>Nobuko Kasai (FMVZ)</li>
      <li>Pedro Primo Bombonato (FMVZ)</li>
      <li>Wilson Gonçalves Viana (FMVZ)</li>

 

CE500 CIÊNCIAS EXATAS

CE510 ASTRONOMIA

      <li>Zulema Abraham (IAG)</li>

 

CE520 FÍSICA

      <li>Adalberto Fazzio (IF)</li>
      <li>Bernhard Joaquim Mokross (IFSC)</li>
      <li>Carlos Ourivio Escobar (IF)</li>
      <li>Celso Luiz Lima (IF)</li>
      <li>Djalma Mirabelli Redondo (IFSC)</li>
      <li>Henrique Fleming (IF)</li>
      <li>Iuda Godman Vel Lejbamn (IF)</li>
      <li>Ivan Cunha do Nascimento (IF)</li>
      <li>José Pedro Donoso Gonzalez (IFSC)</li>
      <li>Lidério Citrângulo Ioriatti Junior (IFSC)</li>
      <li>Mahir Saleh Hussein (IF)</li>
      <li>Maximo Siu Li (IFSC)</li>
      <li>Rogério Trajano da Costa (IFSC)</li>
      <li>Silvio Roberto de Azevedo Salinas (IF)</li>
      <li>Victor de Oliveira Rivelles (IF)</li>
      <li>Walter Felipe Wreszinski (IF)</li>


CE530 GEOCIÊNCIAS

      <li>Antonio Carlos Rocha Campos (IGC)</li>
      <li>Arlei Benedito Macedo (IGC)</li>
      <li>Joel Barbujiani Sigolo (IGC)</li>
      <li>Jorge Kazuo Yamamoto (IGC)</li>
      <li>Kenitiro Suguio (IGC)</li>
      <li>Ricardo César Aoki Hirata (IGC)</li>
      <li>Thomas Rich Fairchild (IGC)</li>
      <li>Uriel Duarte (IGC)</li>
      <li>Valdecir de Assis Janasi (IGC)</li>

CE540 GEOFÍSICA

      <li>Nelsi Côgo de Sá (IAG)</li>

 

CE550 MATEMÁTICA

      <li>Cyro de Carvalho Patarra (IME)</li>
      <li>Elza Furtado Gomide (IME)</li>
 

CE560 QUÍMICA

      <li>Alberico Borges F Silva (IQSC)</li>
      <li>Ana Maria da Costa Ferreira (IQ)</li>
      <li>Antonio Aprigio da Silva Curvelo (IQSC)</li>
      <li>Benedito Santos Lima Neto (IQSC)</li>
      <li>Gilberto Goissis (IQSC)</li>
      <li>Janete H. Y. Vilegas (IQSC)</li>
      <li>Maria Teresa do Prado Gambardella (IQSC)</li>
      <li>Paulo Sergio Santos (IQ)</li>
      <li>Wagner Polito (IQSC)</li>
      <li>Yoshio Kawano (IQ)</li>

CE600 CIÊNCIAS EXATAS APLICADAS

CE610 CIÊNCIAS DA COMPUTAÇÃO

      <li>Flávio Soares Correia da Silva (IME)</li>
      <li>Yoshiharu Kohayakawa (IME)</li>

 

CE620 ENGENHARIAS

      <li>Agenor de Toledo Fleury (EP)</li>
      <li>Amilcar Careli Cesar (EESC)</li>
      <li>Antonio Moreira dos Santos (EESC)</li>
      <li>Antonio Rafael Namur Muscat (EP)</li>
      <li>Antonio Stellin Junior (EP)</li>
      <li>Arlindo Tribess (EP)</li>
      <li>Célio Taniguchi (EP)</li>
      <li>Eduardo Morgado Belo (EESC)</li>
      <li>Eiji Kawamoto (EESC)</li>
      <li>Euryale Jorge Godoy de Jesus Zerbini (EP)</li>
      <li>Hélio Goldenstein (EP)</li>
      <li>Helmut Born (EP)</li>
      <li>Hercílio Gomes de Melo (EP)</li>
      <li>Hugo Pietrantonio (EP)</li>
      <li>Idalina Vieira Aoki (EP)</li>
      <li>Ivan Gilberto Sandoval Falleiros (EP)</li>
      <li>Jaime Gilberto Duduch (EESC)</li>
      <li>João Bento de Hanai (EESC)</li>
      <li>João Vitor Mocelin (EESC)</li>
      <li>José Luis Peres Camacho (EP)</li>
      <li>Liedi Legi Bariani Bernucci (EP)</li>
      <li>Lindolfo Soares (EP)</li>
      <li>Luiz Roberto Terron (EP)</li>
      <li>Marcos Ribeiro Pereira Barretto (EP)</li>
      <li>Mario Francisco Mucheroni (EESC)</li>
      <li>Masazi Maeda (EP)</li>
      <li>Mercia Maria Semensato Bottura de Barros (EP)</li>
      <li>Mônica Ferreira do Amaral Porto (EP)</li>
      <li>Neusa Alonso Falleiros (EP)</li>
      <li>Nicolau Dionisio Fares Gualda (EP)</li>
      <li>Nicole Demarquette (EP)</li>
      <li>Orlando Strambi (EP)</li>
      <li>Paulo Antonio Mariotto (EP)</li>
      <li>Paulo Eigi Miyagi (EP)</li>
      <li>Pedro Alem Sobrinho (EP)</li>
      <li>Rubem La Laina Porto (EP)</li>
      <li>Sidney Seckler Ferreira Filho (EP)</li>
      <li>Sylvio Reynaldo Bistafa (EP)</li>
      <li>Valdir Schalch (EESC)</li>
CE630 ESTATÍSTICA E PROBABILIDADE

      <li>Nelson Ithiro Tanaka (IME)</li>

CE640 METEOROLOGIA

      <li>Fábio Luiz Teixeira Gonçalves (IAG)</li>

CH700 CIÊNCIAS HUMANAS

CH710 ADMINISTRAÇÃO, ECONOMIA, ECONOMIA DOMÉSTICA E CONTABILIDADE

      <li>Gilberto Tadeu Shinyashiki (FEARP)</li>
      <li>Maria Cristina Cacciamali (FEA)</li>
      <li>Masayuki Nakagawa (FEA)</li>
      <li>Paulo de Tarso Presgrave Leite Soares (FEA)</li>

CH720 ARQUEOLOGIA, MITOLOGIA E PRÉ-HISTÓRIA

      <li>Levy Figuti (MAE)</li>
      <li>Maria Beatriz Borba Florenzano (MAE)</li>
      <li>Maria Isabel D´Agostino Fleming (MAE)</li>

CH730 ARQUITETURA, PLANEJAMENTO TERRITORIAL URBANO E HABITAÇÃO

      <li>Antonio Luis Dias de Andrade "In Memoriam" (FAU)</li>
      <li>Carlos Eduardo Zahn (FAU)</li>
      <li>Luiz Américo de Souza Munari (FAU)</li>

CH740 ARTES E COMUNICAÇÃO

      <li>Adilson Odair Citelli (ECA)</li>
      <li>Amilcar Zani Netto (ECA)</li>
      <li>Ana Maria de Abreu Amaral (ECA)</li>
      <li>Arlindo Ribeiro Machado Neto (ECA)</li>
      <li>Carlos Marcos Avighi (ECA)</li>
      <li>Doris Van de Meene Ruschmann (ECA)</li>
      <li>Dulcília Helena Schroeder Buitoni (ECA)</li>
      <li>Eduardo Simões dos Santos Mendes (ECA)</li>
      <li>Fausto Fuser (ECA)</li>
      <li>Gabriela Suzana Wilder (MAC)</li>
      <li>Gilmar Roberto Jardim (ECA)</li>
      <li>Ismail Norberto Xavier (ECA)</li>
      <li>José Eduardo Vendramini (ECA)</li>
      <li>Lorenzo Mammi (ECA)</li>
      <li>Maria Dora Genis Mourão (ECA)</li>
      <li>Maria Lúcia de Souza Barros Pupo (ECA)</li>
      <li>Maria Otilia Bocchini (ECA)</li>
      <li>Miriam Rejowski (ECA)</li>
      <li>Plínio Martins Filho (ECA)</li>
      <li>Samira Youssef Campedelli (ECA)</li>
      <li>Sidinéia Gomes Freitas (ECA)</li>
      <li>Willy Corrêa de Oliveira (ECA)</li>


CH750 CIÊNCIA DA INFORMAÇÃO E MUSEOLOGIA

      <li>Heloisa Barbuy (MP)</li>
      <li>Nair Yumiko Kobashi (ECA)</li>
      <li>Ricardo Nogueira Bogus (MP)</li>
      <li>Teresa Cristina Toledo de Paula (MP)</li>

 

CH764 CIÊNCIAS SOCIAIS

      <li>Lília Katri Moritz Schwarz (FFLCH)</li>


CH770 EDUCAÇÃO, LAZER E RECREAÇÃO

      <li>Circe Maria Fernandes Bittencourt (FE)</li>
      <li>Nilson José Machado (FE)</li>

 

CH780 HISTÓRIA GERAL, HISTÓRIA DO BRASIL E GEOGRAFIA

      <li>Heloísa Liberalli Bellotto (FFLCH)</li>
      <li>Hilário Franco Júnior (FFLCH)</li>
      <li>Osvaldo Coggiola (FFLCH)</li>
      <li>Raquel Glezer (MP)</li>

CH790 LINGÜÍSTICA, LÍNGUAS, LITERATURA E TEORIA LITERÁRIA

      <li>Masa Nomura (FFLCH)</li>

  </div>

  

</div>
</div>    
    
    
    

    <!-- ###### Footer ###### -->
    </div>
<!-- ###### Footer ###### -->

    <div class="footer">
        <div class="well well-lg">
            <p>Desenvolvido com Tematres 1.81</p>                
            <p><?php echo LABEL_URI ?>: <span class="footerCol2"><a href="<?php echo $_SESSION["CFGURL"];?>"><?php echo $_SESSION["CFGURL"];?></a></span></p>
				<?php
				//are enable SPARQL
				if(CFG_ENABLE_SPARQL==1)
				{
					echo '<p><strong><a href="'.$_SESSION["CFGURL"].'sparql.php" title="'.LABEL_SPARQLEndpoint.'">'.LABEL_SPARQLEndpoint.'</a></strong></p>';
				}
                                
				if(CFG_SIMPLE_WEB_SERVICE==1)
				{
					echo '<p><a href="'.$_SESSION["CFGURL"].'services.php" title="API">API do WebService</a></p>';	
				}
				?>
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
 </body>
</html>
