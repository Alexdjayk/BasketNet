<?php
function pr($mVar2Display){
	// debug_backtrace  Génère le contexte de déboguage
	$debug = debug_backtrace();
	echo'<pre style="background-color: #EBEBEB; border: 1px dashed black; width: 100%; margin-left:250px; padding: 10px;">';
	print_r('<font color="green">[FICHIER] : '.$debug[0]['file']."</font>\n");
	print_r('<font color="brown">[LIGNE] : '.$debug[0]['line']."</font>\n\n");
	print_r('<font color="blue">[RESULTAT] : '."\n");
	print_r($mVar2Display);
	echo '</font></pre>';
}