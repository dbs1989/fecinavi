<?php
	require_once('../config.php');
	require_once(DBAPI);

	if(!empty($_GET['nome'])){
		$instituicoes = array();
		$nome = $_GET['nome'];
		$resultados = findList('instituicao','nome',$nome);
		if($resultados){
			foreach ($resultados as $resultado){
				$instituicao = new instituicao;
				$instituicao->id = $resultado['id_instituicao'];
				$instituicao->label = $resultado['nome'];
				$instituicao->value = $resultado['nome'];
				array_push($instituicoes,$instituicao);
			}
		}
		echo json_encode($instituicoes);
	}

	class instituicao{
		public $id;
		public $label;
		public $value;
	}
?>
