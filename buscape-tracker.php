<?php
/*
Plugin Name: Buscapé Tracker
Plugin URI: http://danielcosta.info/projetos/wp-plugins/buscape-tracker
Description: Opções para turbinar seu programa de afiliados Buscapé. Baseado no BuscapéEW do Manoel Netto que foi modificado pelo Douglas Correa e aperfeiçoado para o ClickTracker.
Version: 0.9
Date: Oct 21th, 2007
Author: Daniel Costa
Author URI: http://danielcosta.info

/**
 * Este plugin foi desenvolvido tomando como base o Buscape 1.3 feito pelo Manoel Netto 
 * do www.tecnocracia.com e o 0.3 feito pelo Douglas Silvio do www.douglascorrea.info
 * 
 * Ative-o no painel do Wordpress e configure-o em Opções -> Buscapé 
 */

// Definição de opções default [configurações]
$BP_Options = array (
	"Version" => "1.3",
	
	// Código de Afiliado Buscapé
	"BP_Aff" => "1201246",
	
	// Texto que abre e fecha a lista de links 
	"BP_preReplace" => '<p>Compare Pre&ccedil;os de: ',
	"BP_postReplace" => ' no Buscapé.</p>',
	
	// Lista de termos utilizados quando não houver definição no post [default]
	"BP_defLists" => array (
						"MP3, iPod, celulares, notebooks, cameras",
						"DVD, MP3, LCD, Plasma, HDTV, Home Theater",
						"games, PS2, PS3, Nintendo, Wii, iPod"
					 ),

	"BP_defMenuLists" => array (
						"MP3, iPod, celulares, notebooks, cameras",
						"DVD, MP3, LCD, Plasma, HDTV, Home Theater",
						"games, PS2, PS3, Nintendo, Wii, iPod"
					 ),
					 
					 
	// Definição de comportamentos
	"BP_openWindow" => "1",
	"BP_showBPinloco" => "1",
	"BP_showBPinBL" => "0",
	"BP_showDefBL" => "1",
	"BP_inPosts" => "1",
	"BP_inPages" => "1",
	"BP_inFeeds" => "1",
	"BP_addNofollow" => "0",
	"BP_familyEW" => "1",
	// Analytics
	"BP_mapClicks" => "1",
	"BP_mapFolder" => "buscape"	
	);


// -----------------------------------------------------------------------------------------
// Não edite nada após essa linha (a menos que saiba o que está fazendo)
// -----------------------------------------------------------------------------------------


function BP_Start() {
	global $BP_Options, $BP_URL, $bp_pattern, $bps_pattern, $CatBuscape;
	$Options = get_option('BP_Options');
	if (!$Options) add_option('BP_Options', $BP_Options);
	else $BP_Options = $Options;

	$site_origem = $BP_Options["BP_Aff"];
	$CatBuscape = array (
	"Flores" => "1456",
	"Notebook"=>  "6424",
	"PlacaMae"=>  "3623",
	"Impressora"=>  "3606",
	"Memoria"=>  "2464",
	"CartaoMemoria"=>  "52",
	"AcessorioNotebook"=>  "99",
	"AcessorioHandheld"=>  "90",
	"CameraDigital" => "93",
	"MiniaturaCarros" => "6836",
	"Gravador" => "6168",
	"HD" => "3737",
	"DVDs" => "2922",
	"HTheater" => "3643",
	"Livros" => "3482",
	"Monitor" => "36",
	"Guitarra" => "6756",
	"Perfume" => "3442",
	"Batera" => "8937",
	"AgTurismo" => "7784",
	"Emagrecedor" => "8571",
	"Camisinha" => "3756",
	"ApPressao" => "7096",
	"Tabacaria" => "3561",
	"ConsoleGame" => "6058",
	"Jogos" => "6409",
	"RevAvulsas" => "7835",
	"RevAssina" => "6108",
	"RevQuad" => "7815",
	"CarNew" => "3629",
	"CarUsado" => "7078",
	"MP3Player" => "18",
	"Futebol" => "1348",
	"Celular" => "77",
	"ArtigosReligiosos" => "6368",
	"AcessorioCelular" => "77",
	"SmartPhone" => "9674",
	"MotoNew" => "3840",
	"Pinga" => "1145",
	"Cerveja" => "502",
	"Vodka" => "1158",
	"Whisky" => "1159",	
	"MotoUsada" => "6687",
	"ModaFeminina" => "2472",	
	"ModaMasculina" => "2472",		
	"ModaMasculina" => "2471",			
	"Lingerie" => "2491",			
	"Cuecas" => "2469",			
	"ImoveisResidenciais" => "9532",
	"ImoveisTemporada" => "9552",
	"ImoveisComerciais" => "9551",
	"ArtesMarciais" => "9674",
	"Concursos" => "7157"
	);
	
	$BP_URL = "http://tracker.danielcosta.info/tracker/buscape/code/".$BP_Options["BP_Aff"]."/kw/";
	
	$bp_pattern = '/(\[BP(?:\:(\w+))?(?:\:(.*))?\](.*?)\[\/BP\])/i';
    $bps_pattern = '/((?:<p>)?\s*\[BL(?:\:(\d+))?(?:\:(.*))?\](.*?)\[\/BL\]\s*(?:<\/p>)?)/i'; 
}

function BP_Clean($text) {
	global $BP_Options, $BP_URL, $bp_pattern, $bps_pattern;
	$text = preg_replace($bp_pattern, "$3", $text);
	$text = preg_replace($bps_pattern, "", $text);
	return $text;
}

function BPMenu() {
	global $BP_Options, $BP_URL, $bp_pattern, $bps_pattern, $CatBuscape;
	$target = $BP_Options["BP_openWindow"]?"target=\"_blank\"":"";
	$mapFolder = $BP_Options["BP_mapClicks"]?$BP_Options["BP_mapFolder"]:false;
	if ($BP_Options["BP_defMenuLists"]) {
		$BP_defMenuLists = $BP_Options["BP_defMenuLists"];
		$maxIndexMenu = sizeof($BP_defMenuLists);
		$randIndexMenu = rand(0, $maxIndexMenu-1);
		$listaMenuBP = "[BL]".$BP_defMenuLists[$randIndexMenu]."[/BL]";
		$textMenu .= $listaMenuBP;
	}
	
	//echo $textMenu;
	
    if (preg_match ($bps_pattern, $textMenu, $matches)) {
        $bplist_exists = 1;
        unset($mtags);
		$categ = $matches[2][$m];
        $mtags = explode(",", $matches[3]);
        for ($i=0; $i<count($mtags); $i++) {
			if (strstr($mtags[$i],":")) list($mtags[$i], $categ) = split(":",$mtags[$i]);
	            if($categ != "") {
						$bptags .= '<a href="' . $BP_URL.urlencode(trim($mtags[$i])). '/cat/'.(isset($CatBuscape[$categ[0]]) ? $CatBuscape[$categ[0]] : $categ) . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . (isset($categ[1]) ? $categ[1] : trim($mtags[$i])) . '</a>';
				}
				else {
						$bptags .= '<a href="' . $BP_URL . urlencode(trim($mtags[$i])) . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . trim($mtags[$i]) . '</a>';
				}
			if ($i<count($mtags)-1) { $bptags .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
            $bps_count += 1;
        }
    }
    
    # If tags were found, include them in the post
    if ($bps_count>0) {
        if ($bplist_exists == 1) { 
            $textMenu = preg_replace($bps_pattern,$bptags,$textMenu); 
        } else {
            $textMenu .= $bptags;
        }
    }
	echo $textMenu;
}


function BPEW($text) {
	global $BP_Options, $BP_URL, $bp_pattern, $bps_pattern, $CatBuscape;
    
	if ((is_home()||is_single())&&!$BP_Options["BP_inPosts"]&&!$BP_Options["BP_familyEW"]) return BP_Clean($text);
	if (is_page()&&!$BP_Options["BP_inPages"]&&!$BP_Options["BP_familyEW"]) return BP_Clean($text);
	if (is_feed()&&!$BP_Options["BP_inFeeds"]&&!$BP_Options["BP_familyEW"]) return BP_Clean($text);
	
    $bps_count = 0;       
    $bplist_exists = 0; 
	
	$target = $BP_Options["BP_openWindow"]?"target=\"_blank\"":"";
	$mapFolder = $BP_Options["BP_mapClicks"]?$BP_Options["BP_mapFolder"]:false;
	
	// Adiciona uma lista default randomica? A lista existe?
	if ($BP_Options["BP_showDefBL"] && $BP_Options["BP_defLists"] && !preg_match ($bps_pattern, $text, $matches)) {
		$BP_defLists = $BP_Options["BP_defLists"];
		$maxIndex = sizeof($BP_defLists);
		$randIndex = rand(0, $maxIndex-1);
		$listaBP = "\n<p>[BL]".$BP_defLists[$randIndex]."[/BL]</p>";
		$text .= $listaBP;
	}

    # Verifica a presença das tags [BP] [/BP] no texto
    if (preg_match_all ($bp_pattern, $text, $matches)) {
        unset($bptags);
        if($BP_Options["BP_showBPinBL"]) $bptags = $BP_Options["BP_preReplace"];
        for ($m=0; $m<count($matches[0]); $m++) {
            unset($mtags);
			$categ = $matches[2][$m];
			$pesquisa = $matches[3][$m];
            $mtags = explode(",", $matches[4][$m]);
			$bpLink = "";
            for ($i=0; $i<count($mtags); $i++) {
				if (strstr($mtags[$i],":")) list($mtags[$i], $categ) = split(":",$mtags[$i]);
				if($pesquisa == "") $pesquisa = $mtags[$i];
				if($categ != "") {
					if(!(is_int($categ)) && array_key_exists($categ, $CatBuscape)) $categ = $CatBuscape[$categ];
					$bpLink .= '<a class="extlink" href="' . $BP_URL . urlencode(trim($pesquisa)). '/cat/'. $categ . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . trim($mtags[$i]) . '</a>';
				}
				else {
					$bpLink .= '<a class="extlink" href="' . $BP_URL . urlencode(trim($pesquisa)) . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . trim($mtags[$i]) . '</a>';
                }
				if ($i<count($mtags)-1) {$bpLink.= ", "; }
                if ($BP_Options["BP_showBPinBL"]) $bps_count++;
            }
			$bptags .= $BP_Options["BP_showBPinBL"]?$bpLink:"";
			if ($BP_Options["BP_showBPinloco"]) 
				$text = str_replace($matches[0][$m],$bpLink,$text);
			else
				$text = str_replace($matches[0][$m],$matches[4][$m],$text);
				
            $bptags.= ($m<count($matches[0])-1 && $BP_Options["BP_showBPinBL"])?", ":"";
        } 
    }
    
    # Check for [BL] [/BL]
    if (preg_match ($bps_pattern, $text, $matches)) {
        $bplist_exists = 1;
        if ($bps_count==0 || !$BP_Options["BP_showBPinBL"]) { 
            $bptags = $BP_Options["BP_preReplace"];
        } else { 
            $bptags .= ", ";
        }
        
        unset($mtags);
		$mtags = explode(",", $matches[4]);
        for ($i=0; $i<count($mtags); $i++) {
        	$categ = ""; $pesquisa = "";
			if (strstr($mtags[$i],":")) list($mtags[$i], $categ, $pesquisa) = split(":",$mtags[$i]);
			if($pesquisa == "") $pesquisa = $mtags[$i];
			if($categ != "") {
					if(!(is_int($categ)) && array_key_exists($categ, $CatBuscape)) $categ = $CatBuscape[$categ];
	            	$bptags .= '<a class="extlink" href="' . $BP_URL.urlencode(trim($pesquisa)). '/cat/'. $categ . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . trim($mtags[$i]) . '</a>';
				}
				else {
					$bptags .= '<a class="extlink" href="' . $BP_URL . urlencode(trim($pesquisa)) . '" rel="external nofollow" ' .$target ." ".($mapFolder?"onClick=\"urchinTracker('/$mapFolder/".urlencode(trim($mtags[$i]))."');\"":"")." >" . trim($mtags[$i]) . '</a>';
				}
			if ($i<count($mtags)-1) { $bptags .= ", "; }
            $bps_count += 1;
        }
    }
    
    
    # If tags were found, include them in the post
    if ($bps_count>0) {
        $bptags .= $BP_Options["BP_postReplace"];
        //if ($bplist_exists == 1) { 
        //    $text = preg_replace($bps_pattern,$bptags,$text);
        //} else {
            $text .= $bptags;
        //}
    }
    return $text;
}

// Adiciona a op&#35119; no menu Options
function BP_addOptionsPage() {
		add_options_page('Op&ccedil;&otilde;es do Buscap&eacute; Tracker', 'Buscap&eacute; Tracker', 'manage_options', basename(__FILE__), 'BP_optionsPanel');
}

// Tela do Painel
function BP_optionsPanel() {
  global $BP_Options, $CatBuscape;
  if (isset($_POST['BP_Updt'])) {
	$BP_Options["BP_Aff"] = $_POST["BP_Aff"];
	$BP_Options["BP_preReplace"] = $_POST["BP_preReplace"];
	$BP_Options["BP_postReplace"] = $_POST["BP_postReplace"];
	$BP_Options["BP_defLists"] = explode("\n", $_POST["BP_defLists"]);
	$BP_Options["BP_defMenuLists"] = explode("\n", $_POST["BP_defMenuLists"]);
	$BP_Options["BP_showBPinloco"] = $_POST["BP_showBPinloco"]?"1":"0";
	$BP_Options["BP_showBPinBL"] = $_POST["BP_showBPinBL"]?"1":"0";
	$BP_Options["BP_showDefBL"] = $_POST["BP_showDefBL"]?"1":"0";
	$BP_Options["BP_inPosts"] = $_POST["BP_inPosts"]?"1":"0";
	$BP_Options["BP_inPages"] = $_POST["BP_inPages"]?"1":"0";
	$BP_Options["BP_inFeeds"] = $_POST["BP_inFeeds"]?"1":"0";
	$BP_Options["BP_openWindow"] = $_POST["BP_openWindow"]?"1":"0";
	$BP_Options["BP_addNofollow"] = $_POST["BP_addNofollow"]?"1":"0";
	$BP_Options["BP_familyEW"] = $_POST["BP_familyEW"]?"1":"0";
	$BP_Options["BP_mapClicks"] = $_POST["BP_mapClicks"]?"1":"0";
	$BP_Options["BP_mapFolder"] = $_POST["BP_mapFolder"];
    update_option('BP_Options', $BP_Options);
    ?>
    <div class="updated">
      <p>
        <strong>
          Dados atualizados com sucesso.
        </strong>
      </p>
    </div>
    <?php
  }
  ?>
  <style type="text/css">
  <!--
  label { display:block; width:140px; margin-right:20px; font-size:11pt; float:left; }
  //-->
  </style>
  <div class="wrap">
    <h2>Buscapé Tracker</h2>
      <form method="post">
        <fieldset class="options">
          <label for="BP_Aff">Código de Afiliado </label>
          <input name="BP_Aff" type="text" id="BP_Aff" value="<?=$BP_Options['BP_Aff'];?>" size="25" maxlength="25" />
          <br />
		  <p><strong>Configuração de exibição da listagem</strong><br />
          <label for="BP_preReplace">Texto antes</label>
          <textarea name="BP_preReplace" id="BP_preReplace" cols="60" rows="3" ><?=stripslashes($BP_Options['BP_preReplace']);?></textarea>
          <br />
          <label for="BP_postReplace">Texto depois</label>
          <textarea name="BP_postReplace" id="BP_postReplace" cols="60" rows="3" ><?=stripslashes($BP_Options['BP_postReplace']);?></textarea>
          <br />
		  <p><strong>O que exibir?</strong><br />
          <input type="checkbox" name="BP_showBPinloco" value="1" <?=$BP_Options['BP_showBPinloco']==1?"checked=\"checked\"":"";?>/>
          Exibir links do Buscapé dentro do texto [inline]<br />
          <input type="checkbox" name="BP_showBPinBL" value="1"  <?=$BP_Options['BP_showBPinBL']==1?"checked=\"checked\"":"";?>/>
          Exibir links do Buscapé no fim do texto, em forma de lista<br />
          <input type="checkbox" name="BP_showDefBL" value="1"  <?=$BP_Options['BP_showDefBL']==1?"checked=\"checked\"":"";?>/>
          Exibir lista de links pré-definida em textos sem links presentes</p>
		  <p><strong>Onde exibir?</strong><br />
	  	  <input name="BP_inPosts" type="checkbox" id="BP_inPosts" value="1"  <?=$BP_Options['BP_inPosts']==1?"checked=\"checked\"":"";?>/>
				Exibir nos Posts<br />
		  		<input name="BP_inPages" type="checkbox" id="BP_inPages" value="1"  <?=$BP_Options['BP_inPages']==1?"checked=\"checked\"":"";?>/>
				Exibir nas Páginas<br />
		  		<input name="BP_inFeeds" type="checkbox" id="BP_inFeeds" value="1"  <?=$BP_Options['BP_inFeeds']==1?"checked=\"checked\"":"";?>/>
			Exibir nos Feeds</p>
		  <p><strong>Lista de links pré-definida</strong><br />
		  	Separe as palavras com vírgula. Para randomizar, crie listas diferentes separando com &lt;enter&gt; <br />
		  	<textarea name="BP_defLists" cols="70" rows="4" id="BP_defLists"><?=implode("\n",$BP_Options['BP_defLists']);?></textarea>
		  </p>
		  <p><strong>Lista de links pré-definida - MENU</strong><br />
		  	Separe as palavras com vírgula. Para randomizar, crie listas diferentes separando com &lt;enter&gt; <br />
		  	<textarea name="BP_defMenuLists" cols="70" rows="4" id="BP_defMenuLists"><?=implode("\n",$BP_Options['BP_defMenuLists']);?></textarea>
		  </p>
		  <p><strong>Configurações Avançadas</strong><br />
		  	<input type="checkbox" name="BP_openWindow" value="1" <?=$BP_Options['BP_openWindow']==1?"checked=\"checked\"":"";?>/>
		  	Abrir link em nova janela (usando &quot;target=_blank&quot;)<br />
		  	<input type="checkbox" name="BP_addNofollow" value="1" <?=$BP_Options['BP_addNofollow']==1?"checked=\"checked\"":"";?>/>
		  	Adicionar rel='nofollow' aos links<br />
		  	<input type="checkbox" name="BP_familyEW" value="1" <?=$BP_Options['BP_familyEW']==1?"checked=\"checked\"":"";?>/>
		  	Integrar com a família EveryWhere<br />
		  	<input type="checkbox" name="BP_mapClicks" value="1" <?=$BP_Options['BP_mapClicks']==1?"checked=\"checked\"":"";?>/>
		  	Mapear clicks com o Google Analytics. Pasta 
	  	   	<input name="BP_mapFolder" type="text" id="BP_mapFolder" value="<?=$BP_Options['BP_mapFolder'];?>" size="30" maxlength="30" />
		  [<a href="http://www.tecnocracia.com.br/arquivos/mapeando-cliques-e-buscas-com-o-analytics">o que é isso?</a>] </p>
		  <div class="submit" style="text-align: left;margin-top:10px">
            <input type="submit" name="BP_Updt" value="Atualizar" />
          </div>
        </fieldset>
      </form>
    
    <h2>Instruções</h2>
    <div id="legendas" style="width:200px;border:1px;background-color:#EEE;padding:10px;float:right;clear:right;">
    	<h3>LEGENDAS</h3>
	    <strong>9999</strong> - é o código da categoria no Buscapé (pode ser utilizado um atalho de categoria)<br /><br />
		<strong>palavra</strong> - é a palavra que vai ser exibida no seu post<br /><br />
		<strong>pesquisa</strong> - é a palavra que vai ser pesquisada no Buscapé, dentro da categoria indicada<br /><br />
		<strong>categoria</strong> - segunda opção de categoria, só que usando um nome ao invés do código (confira abaixo a lista dos atalhos de categorias)
    </div>
    <h3>Links</h3>
    <p>Para utilizar o plugin com palavras dentro do seu texto, basta utilizar qualquer uma das possibilidades de código abaixo:</p>
    <ul>
    <li><strong>[BP]palavra[/BP]</strong></li>
    <li><strong>[BP:9999]palavra[/BP]</strong> ou <strong>[BP:categoria]palavra[/BP]</strong></li>
    <li><strong>[BP:9999:pesquisa]palavra[/BP]</strong> ou <strong>[BP:categoria:pesquisa]palavra[/BP]</strong></li>
    </ul>
    <h3>Lista</h3>
    <p>Para gerar uma lista personalizada de links exibidos no final do seu texto, basta utilizar qualquer uma das possibilidades de código abaixo:</p>
    <ul>
    <li><strong>[BL]palavra 1, palavra 2[/BL]</strong></li>
    <li><strong>[BL]palavra 1:9999, palavra 2:8888[/BL]</strong></li>
    <li><strong>[BL]palavra 1:categoria 1, palavra 2:categoria 2[/BL]</strong></li>
    <li><strong>[BL]palavra 1:9999:pesquisa 1, palavra 2:8888:pesquisa 2[/BL]</strong></li>
    <li><strong>[BL]palavra 1:categoria 1:pesquisa 1, palavra 2:categoria 2:pesquisa 2[/BL]</strong></li>
    </ul>
    <p>Obs.: É aconselhável inserir esse código dentro de um bloco de comentários HTML: <strong>&lt;-- código -- &gt;</strong>, pois caso você desative o plugin, seu texto não ficará poluído.</p>
    <h3>Atalhos de categorias</h3>
    <table border="0" cellpadding="2" cellspacing="1">
    <tr bgcolor="#DDD"><th>Categoria (atalho)</th><th>Código (Buscapé)</th></tr>
    <?php
    foreach($CatBuscape as $nome => $valor): if($bgcolor=="#EEE"){$bgcolor="#FFF";} else {$bgcolor="#EEE";}?>
    <tr bgcolor="<?=$bgcolor?>"><td><?php echo $nome; ?></td><td><?php echo $valor; ?></td></tr>
    <?php endforeach; ?>
    </table>
    
    <h2>Sobre</h2>
    <h3>Buscapé Tracker 1.0</h3>
    <p>Este plugin foi desenvolvido por <a href="http://danielcosta.info/">Daniel Costa</a> para facilitar a vida do editor que utiliza <a href="http://wordpress.org/">Wordpress</a> e monetiza seu blog com o <a href="http://www.buscape.com.br/">Buscapé</a>. Com ele os artigos recebem automaticamente os links personalizados necess&aacute;rios para que o programa funcione no seu blog.</p>
    <p><strong>Este plugin exibe automaticamente notificações de atualização pois está cadastrado na base oficial de plugins do Wordpress.</strong></p>
    
  </div>
<?php
}

// Actions and Filters
// ---------------------------------------------
add_action('init', 'BP_Start');
add_action('admin_menu', 'BP_addOptionsPage');
add_filter('the_content', 'BPEW');
?>