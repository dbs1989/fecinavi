<?php
	require_once('../config.php');
	require_once('dbProjeto.php');
	$areas = null;
	$projetos = null;
	$projeto = null;
	$usuarios = null;
	session_start();
	/**	 *  Listagem dos projetos	 */
	function index() {
		global $projetos;
		$projetos = projeto_area();
	}
	//busca o id do estudante
	function pegarId($nome){
		$pesquisa = findAnyThing('usuario','nome',"'".$nome."'");
		return $pesquisa['id_usuario'];
	}
	//busca o id do orientador


	//adicionar projeto
	function add() {
		if (!empty($_POST['projeto'])) {

			$projeto = $_POST['projeto'];
			$orientador2 = trim(array_pop($projeto));
			$orientador1 = trim(array_pop($projeto));
			$estudante3 = trim(array_pop($projeto));
			$estudante2 = trim(array_pop($projeto));
			$estudante1 = trim(array_pop($projeto));
			$projeto["'num_aval'"]=0;
			$projeto["'ano'"] = date("Y");

			//salva o projeto
			save('projeto',$projeto);
			saveProjetoUsuario($estudante1,$estudante2,$estudante3,$orientador1,$orientador2);
		//	header('location: add.php');exit;
		}
	}
	//edita o projeto
	function edit() {
		if (isset($_POST['projeto'])) {
			$projeto = $_POST['projeto'];
			$id = $projeto["'id_projeto'"];
			$orientador2 = trim(array_pop($projeto));
			$orientador1 = trim(array_pop($projeto));
			$estudante3 = trim(array_pop($projeto));
			$estudante2 = trim(array_pop($projeto));
			$estudante1 = trim(array_pop($projeto));
			if(empty($projeto["'convidado'"])){
			    $projeto["'convidado'"] = 0;
			}
			if($orientador1=="" || $estudante1==""){
				$_SESSION['type'] = "danger";
				$_SESSION['msgNome'] = "Estudante 1 e Orientador devem ter um nome";
				header('location: edit.php?id='.$id);exit;
			}
			update('projeto', $id, $projeto);
			apagaProjetoUsuario('projeto_usuario',$id);
			saveProjetoUsuario($estudante1,$estudante2,$estudante3,$orientador1,$orientador2,$id);
			header('location: index.php');exit;
		} else if (isset($_GET['id'])) {
			global $projeto;
			global $usuarios;
			getAreas();
			$id = $_GET['id'];
			$projeto = projeto_area($id);
			$usuarios = projeto_usuario($id);
		}else {
			header('location: index.php');exit;
		}
	}

	function saveProjetoUsuario($estudante1,$estudante2,$estudante3,$orientador1,$orientador2,$id=null){
		$estudante1 = pegarId($estudante1);
		if(empty($estudante1)){
			$_SESSION['type'] = "danger";
			$_SESSION['msgId'] = "Nome do Estudante 1 Incorreto";
			header('location: add.php?id='.$id);exit;
		}
			//verifica se o nome do orientador 1 está correto
		$orientador1 = pegarId($orientador1);
		if(empty($orientador1)){
			$_SESSION['type'] = "danger";
			$_SESSION['msgId'] = "Nome do Orientador Incorreto";
			header('location: add.php?id='.$id);exit;
		}
			//verifica se o nome do estudante 2 está correto
		if(!empty($estudante2)){
			$estudante2 = pegarId($estudante2);
			if(empty($estudante2)){
				$_SESSION['type'] = "danger";
				$_SESSION['msgId'] = "Nome do Estudante 2 Incorreto";
				header('location: add.php?id='.$id);exit;
			}
		}
			//verifica se o nome do estudante 3 está correto
		if(!empty($estudante3)){
			$estudante3 = pegarId($estudante3);
			if(empty($estudante3)){
				$_SESSION['type'] = "danger";
				$_SESSION['msgId'] = "Nome do Estudante 3 Incorreto";
				header('location: add.php?id='.$id);exit;
			}
		}
			//verifica se o nome do orientador 1 está correto
		if(!empty($orientador2)){
			$orientador2 = pegarId($orientador2);
			if(empty($orientador2)){
				$_SESSION['type'] = "danger";
				$_SESSION['msgId'] = "Nome do Coorientador Incorreto";
				header('location: add.php?id='.$id);exit;
			}
		}
		if($id==null){
			$projeto = selectMaxId('projeto');
			$projeto_usuario['fk_projeto'] = $projeto["id_projeto"];
		}else{
			$projeto_usuario['fk_projeto'] = $id;
		}

		$projeto_usuario['fk_usuario'] = $estudante1;
		$projeto_usuario['tipo'] = 3;
		save('projeto_usuario',$projeto_usuario);

		//verifica se o id do estudante 2 corresponde ao id selecionado
		if(!empty($estudante2)){
			$projeto_usuario['fk_usuario'] = $estudante2;
			save('projeto_usuario',$projeto_usuario);
		}
			//verifica se o id do estudante 3 corresponde ao id selecionado
		if(!empty($estudante3)){
			$projeto_usuario['fk_usuario'] = $estudante3;
			save('projeto_usuario',$projeto_usuario);
		}
		$projeto_usuario['fk_usuario'] = $orientador1;
		$projeto_usuario['tipo'] = 1;
		save('projeto_usuario',$projeto_usuario);

			//verifica se o id do orientador 2 corresponde ao id selecionado
		if(!empty($orientador2)){
			$projeto_usuario['fk_usuario'] = $orientador2;
			$projeto_usuario['tipo'] = 2;
			save('projeto_usuario',$projeto_usuario);
		}
	}

	//busca a area do projeto
	function getAreas(){
		global $areas;
		$areas = find_all('area');
	}
?>
