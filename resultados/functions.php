<?php
	require_once('../config.php');
	require_once(DBAPI);
	$projetos = null;
	$projetoAval = null;
	$autores = null;
	$area = null;
	session_start();
	/**	 *  Listagem dos emprestimos	 */

	function index() {
		global $projetos;
		//verifica se houve avaliações
		if(!empty($_POST['avaliacao'])){
			$avaliacao = $_POST['avaliacao'];
			$projetos = findProjetos('projeto','id_area',$avaliacao["'id_area'"]);
		}
	}
	//busca a area
	function getAreas(){
		global $areas;
		$areas = find_all('area');
	}

	//busca o avaliador
	function findAvaliador($id = null) {
		global $usuario;
		$usuario = findAnyThing('avaliador','id_avaliador', $id);

	}
	//busca o administrador
	function findAdministrador($id = null) {
		global $usuario;
		$usuario = findAnyThing('administrador','id_administrador', $id);
	}
	//busca a area e o id do projeto
	function getItens($id=null){
		global $projetoAval;
		$projetoAval = findAnyThing('projeto','id_projeto', $id);
		getEstudantes($id);
		getArea($projetoAval['id_area']);
		getOrientador($id);
	}
	//busca os estudantes
	function getEstudantes($id=null){
		global $estudantes;
		$estudantes = findEstudantesProjeto($id);
	}
	//autores
	function allAutores($usuarios){
		global $autores;
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
	}


	function getArea($id=null){
		global $area;
		$area = findAnyThing('area','id_area',$id);
	}

?>
