<?php
require_once('../config.php');
    session_start();
	require_once(DBAPI);
	if(!empty($_POST['avaliacao'])){

		$avaliacao = $_POST['avaliacao'];
    print_r($avaliacao);
		//CONTAR NUMERO DE AVALIAÇÕES.
		$projeto = findAnyThing('projeto','id_projeto',$avaliacao["'fk_projeto'"]);
		$num_aval = numAvaliacoes();
		if($num_aval['total']>0){
			if($projeto['num_aval']>=3){
				$_SESSION['message'] = 'Trabalho Atingiu o limite de avaliações';
				$_SESSION['type'] = 'danger';
				header('location: index.php');exit;
			}
		}else{
			if($projeto['num_aval']>=5){
				$_SESSION['message'] = 'Trabalho Atingiu o limite de avaliações';
				$_SESSION['type'] = 'danger';
				header('location: index.php');exit;
			}
		}

		//TESTAR AVALIADOR
		$cont = 0;
		$lista = pesquisaAvaliacao('avaliacao','fk_usuario',$avaliacao["'fk_usuario'"]);
		if($lista){
			foreach($lista as $key => $value) {
				if($value['fk_projeto']==$avaliacao["'fk_projeto'"]){
					$cont = 1;
				}
			}
		}
		if($cont==0){
			save('avaliacao',$avaliacao);
			addAvaliacao($avaliacao["'fk_projeto'"]);
			$name = 'arquivo.txt';
			$text = null;
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
			$_SESSION['message'] = 'Avaliação Enviada';
			$_SESSION['type'] = 'success';
		}else{
			$_SESSION['message'] = 'A sua avalição já foi enviada anteriormente';
			$_SESSION['type'] = 'danger';
		}
	}
	header('location: index.php');exit;

?>
