<?php
	require_once('config.php');
	require_once(DBAPI);
	$name = 'arquivo.txt';
	$text = "";
	$avaliacoes = findAvaliacoes('avaliacao');
			foreach($avaliacoes as $aval){
				foreach($aval as $campo => $valor){
					if($campo == 'fk_usuario'){
						$pesquisa = findAnyThing('usuario','id_usuario',$valor);
						$text .= "Avaliador = ".$pesquisa['nome']."\r\n";
					}else if ($campo=='fk_projeto'){
						$pesquisa = findAnyThing('projeto','id_projeto',$valor);
						$text .= "Projeto = ".$pesquisa['titulo']."\r\n";
					}else{
						$text .= $campo."=".($valor/10.0)."\t";
					}
				}
				$text .= "\r\n\n";
			}
			$file = fopen($name, 'w');
			fwrite($file, $text);
			fclose($file);
	
//	header("Location: index.php");exit;
?>