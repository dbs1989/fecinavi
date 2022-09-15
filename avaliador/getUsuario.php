<?php
	require_once('../config.php');
	require_once(DBAPI);

	if(!empty($_GET['nome'])){
		$usuarios = array();
		$nome = $_GET['nome'];
		$resultados = findList('usuario','nome',$nome);
		if($resultados){
			foreach ($resultados as $resultado){
				$usuario = new usuario;
				$usuario->id = $resultado['id_usuario'];
				$usuario->label = $resultado['nome'];
				$usuario->value = $resultado['nome'];
				array_push($usuarios,$usuario);
			}
		}
		echo json_encode($usuarios);
	}

	class usuario{
		public $id;
		public $label;
		public $value;
	}
?>