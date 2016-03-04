<?php
    require '../../config.ws.php';
    require 'config.ws.php';
    include_once('fun.termbuilder.php');
		$params["TEMATRES_URI_SERVICE"]=$CFG_VOCABS[$CFG["DEFVOCAB"]]["URL_BASE"];

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
<html lang="<?php echo $_SESSION["vocab"]["lang"]; ?>">

<head>

        <?php
            echo HTMLmeta($_SESSION["vocab"],TERM_BUILDER_title.' ');
            echo HTMLestilosyjs();
        ?>

        <style type="text/css">
            .sidebar-nav {
                padding: 9px 0;
            }
            @media (max-width: 980px) {
                /* Enable use of floated navbar text */
                .navbar-text.pull-right {
                    float: none;
                    padding-left: 5px;
                    padding-right: 5px;
                }
            }
            .search-query:focus + button {
                z-index: 3;
            }
            .error {
                background:#ffe1da url('../images/icon_error.png') 13px 50% no-repeat;
                border:2px solid #f34f4f;
                border-bottom:2px solid #f34f4f;
                color:#be0b0b;
                font-size:120%;
                padding:10px 11px 8px 36px;
            }
            .errorNoImage{background:#ffe1da 13px 50% no-repeat;border:2px solid #f34f4f;color:#be0b0b;font-size:120%;padding:10px 11px 8px 36px;}
            .information{background:#dedfff url('../images/icon_information.png') 13px 50% no-repeat;border:2px solid #9bb8d9;color:#406299;font-size:120%;padding:10px 11px 8px 36px;}
            .success{background:#e2f9e3 url('../images/icon_success.png') 13px 50% no-repeat;border:2px solid #9c9;color:#080;font-size:120%;padding:10px 11px 8px 38px;}
            .warning{background:#fff8bf url('../images/icon_warning.png') 13px 50% no-repeat;border:2px solid #ffd324;color:#eb830c;font-size:120%;padding:10px 11px 8px 38px;}
            .successNoImage{background:#fff8bf;color:#080;padding:1px 5px;}
        /* end search form */
        </style>
        <!-- Initialize the plugin: -->
        <script type="text/javascript">
            var options, a;
            var onSelect = function(val, data) {
                $('#suggest-form #id').val(data);
            };
            jQuery(function() {
                options = {
                    serviceUrl:'../../common/proxy.php' ,
                    minChars:3,
                    delimiter: /(,|;)\s*/, // regex or character
                    maxHeight:300,
                    zIndex: 9999,
                    deferRequestBy: 0, //miliseconds
                    showNoSuggestionNotice: false,
                    params: { v:'<?php echo $v;?>'}, //aditional parameters
                    noCache: false, //default is false, set to true to disable caching
                    // callback function:
                    onSelect: function (suggestion) {
                        $('#error_suggest_term').html(suggestion.value +': término existente');
                    }
                };
                a = $('#suggest_string').autocomplete(options);
            });
        </script>

<!-- ###### Script para criar o pop-up do popterms ###### -->
<script>
    function creaPopup(url)
    {
      tesauro=window.open(url,
      "Tesauro",
      "directories=no, menubar =no,status=no,toolbar=no,location=no,scrollbars=yes,fullscreen=no,height=600,width=450,left=500,top=0"
      )
    }
 </script>

<!-- ###### Scripts do autocompletar ###### -->
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

						    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/vcusp-theme.css">

    </head>
						<?php echo USPBarra();?>

<!-- ###### Global Menu ###### -->

        <?php
            echo HTMLglobalMenu(array("CFG_VOCABS"=>$CFG_VOCABS));
        ?>




<!-- ###### Body Text ###### -->

<div class="row">
  <div class="col-xs-12 col-md-8">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">Construtor de termo para catalogação</h3>
    </div>
    <div class="panel-body">
    <div class="form-group">
        <form name="construtor">
    <label for="termoresposta">
       <a href="#" onclick="creaPopup('popterms/index.php?t=termoresposta&f=construtor&v=http://143.107.154.55/pt-br/services.php&loadConfig=1'); return false;">Consultar o VCUSP</a>
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
  <div class="col-xs-6 col-md-4">
    <div>
        <h3><?php echo TERM_BUILDER_title;?></h3>
        <p><?php echo sprintf(TERM_BUILDER_description);?></p>

    </div><!-- END box presentación -->
  </div>
</div>

<!-- ###### Footer ###### -->

            <?php
                echo HTMLglobalFooter(array());
            ?>

  </div>
        </div>
 </body>
</html>
