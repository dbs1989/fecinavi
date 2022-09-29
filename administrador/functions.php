<?php
	require_once('../config.php');
	require_once(DBAPI);
	$titulos = null;
	$administradores = null;
	$administrador = null;
	session_start();
	/**	 *  Listagem dos administradores	 */
	function index() {
		global $administradores;
		$administradores = allAvalAdmin('administrador');
	}
	//PEsquisa da instituição
	function pegarId($nome){
		$pesquisa = findAnyThing('usuario','nome',"'".$nome."'");
		return $pesquisa['id_usuario'];
	}
	//Busca se o administrador trabalha na instituição
	function add() {
		if (!empty($_POST['administrador'])) {
			$administrador = $_POST['administrador'];
			$administrador["'senha'"] = password_hash('mudar123', PASSWORD_DEFAULT);
			$administrador["'fk_usuario'"] = pegarID($administrador["'fk_usuario'"]);
			save('administrador', $administrador);
			header('location: index.php');exit;
		}
	}


	//deletar o administrador
	function delete($id = null) {
		global $administrador;
		$administrador = remove('administrador','fk_usuario',$id);
		header('location: index.php');	exit;
	}

?>
