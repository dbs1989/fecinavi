<?php
	require_once('../config.php');
	require_once(DBAPI);
	$titulos = null;
	$avaliadores = null;
	$avaliador = null;
	$areas = null;
	$areaAval = null;
	$projetos = null;
	session_start();
	/**	 *  Listagem dos avaliadores	 */
	function index() {
		global $avaliadores;
		$avaliadores = allAvalAdmin('avaliador');
		global $areas;
		$areas = find_all('area');
	}
	//PEsquisa da instituição
	function pegarId($nome){
		$pesquisa = findAnyThing('usuario','nome',"'".$nome."'");
		return $pesquisa['id_usuario'];
	}

	function areaAval($id){
		global $areaAval;
		$areaAval = pegarAreaAval($id);
	}
	//Busca se o avaliador trabalha na instituição
	function add() {
		if (!empty($_POST['avaliador'])) {
			$avaliador = $_POST['avaliador'];
			$areas = array_pop($avaliador);
			$avaliador["'senha'"] = password_hash('mudar123', PASSWORD_DEFAULT);
			$avaliador["'fk_usuario'"] = pegarID($avaliador["'fk_usuario'"]);
			save('avaliador', $avaliador);
			$area_avaliador["'fk_usuario'"] = $avaliador["'fk_usuario'"];
			foreach ($areas as $area) {
				$area_avaliador["'fk_area'"] = $area;
				save('area_avaliador', $area_avaliador);
			}
			header('location: index.php');exit;
		}
	}
	function temAval($id){
		$pesquisa = findAnyThing('avaliacao','fk_usuario',$id);
		if(empty($pesquisa)){
			return 0;
		}
		return 1;
	}

	//deletar o avaliador
	function delete($id = null) {
		remove('area_avaliador','fk_usuario',$id);
		remove('avaliador','fk_usuario',$id);
		header('location: index.php');	exit;
	}

	function pesquisaAval($id){
		global $projetos;
		$projetos = avaliadorProjetos($id);
		global $avaliador;
		$avaliador = findAnyThing('usuario','id_usuario',$id);
	}

	function excluir(){
			if(!empty($_GET['excluir'])){
				remove('avaliacao','id_avaliacao',$_GET['excluir']);
				decrementaAvaliacao($_GET['id_projeto']);
				header('location: excluirAval.php?id='.$_GET['id']);	exit;
			}
	}

?>
