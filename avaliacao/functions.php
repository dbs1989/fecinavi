<?php

	require_once('../config.php');
	require_once(DBAPI);
	$projetos = null;
	$projetoAval = null;
	$totalAval = null;
	$orientador = null;
	$area = null;
	$usuarios = null;
	$autores = null;
	session_start();

	/**	 *  Listagem dos emprestimos	 */

	function index() {
		global $projetos;
		global $totalAval;
		if(!empty($_POST['avaliacao'])){
			$avaliacao = $_POST['avaliacao'];
			$projetos = findProjetos('projeto','fk_area',$avaliacao["'fk_area'"]);
			$res = contarAval();
			foreach($res as $key){
				foreach($key as $k => $v){
					$totalAval[$k] = $v;
				}
			}
		}
	}
	//busca a area
	function getAreas(){
		global $areas;
		$areas = find_all('area');
	}

	//busca o nome e id do avaliador
	function findUsuario($id = null) {
		global $usuario;
		$usuario = findAnyThing('usuario','id_usuario', $id);
	}
	//busca o nome, id e area do projeto
	function getItens($id=null){
		global $projetoAval;
		$projetoAval = findAnyThing('projeto','id_projeto', $id);
		getUsuarios($id);
		getArea($projetoAval['fk_area']);
	}
	//seleciona os estudantes do projeto
	function getUsuarios($id=null){
		global $usuarios;
		global $autores;
		$usuarios = projeto_usuario($id);
		$i = 0;
		foreach ($usuarios as $usuario){ 
			if($usuario['tipo']==3){
				$i++;
				$autores[$i] = $usuario;
			}else if($usuario['tipo']==2){
				while($i<3){
					$i++;
					$autores[$i]['nome']="";
				}
				$i++;
				$autores[$i] = $usuario;
			}else{
				while($i<4){
					$i++;
					$autores[$i]['nome']="";
				}
				$i++;
				$autores[$i] = $usuario;
			}
		}
		if(isset($autores[4]['id_usuario'] )){
			if($autores[4]['id_usuario'] == $_SESSION['id_user'] || $autores[5]['id_usuario'] == $_SESSION['id_user']){
				$_SESSION['type'] = "danger";
				$_SESSION['message'] = "Você é um orientador/coorientador desse projeto";
				header('location: index.php');exit;
			}
		}else{
			if($autores[5]['id_usuario'] == $_SESSION['id_user']){
				$_SESSION['type'] = "danger";
				$_SESSION['message'] = "Você é um orientador desse projeto";
				header('location: index.php');exit;
			}
		}
		$total = verAvaliado($id);
		if(!empty($total)){
			foreach($total as $res){
				if($res['fk_usuario']==$_SESSION['id_user']){
					$_SESSION['type'] = "danger";
					$_SESSION['message'] = "Você já avaliou esse projeto";
					header('location: index.php');exit;
				}
			}
		}
	}
	
	function getArea($id=null){
		global $area;
		$area = findAnyThing('area','id_area',$id);
	}


?>
