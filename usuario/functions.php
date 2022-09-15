<?php
	require_once('../config.php');
	require_once('dbUsuario.php');
	$usuarios = null;
	$usuario = null;
	$total_pag = null;
	session_start();
	/**	 *  Listagem dos usuarios	 */
	function index($pagina = null) {
		global $usuarios;
		if($pagina){
			$usuarios = usuario_inst(null,($pagina-1)*10, 10);
		}else{
			$usuarios = usuario_inst();
		}
	}

	function totalPaginas(){
		global $total_pag;
		$total_pag = totalDeRegistros('usuario');
	}
	//procura a intituição do usuario
	function procurar($table, $coluna, $id){
		$pesquisa = findAnyThing($table,$coluna,"'".$id."'");
		return $pesquisa['id_instituicao'];
	}
	//adicionar usuario
	function add() {
		if (!empty($_POST['usuario'])) {
			$usuario = $_POST['usuario'];
			$usuario["'fk_instituicao'"] = procurar('instituicao','nome',$usuario["'fk_instituicao'"]);
			save('usuario', $usuario);

			header('location: add.php');exit;
		}
	}
	function edit() {
		if (isset($_POST['usuario'])) {
			$usuario = $_POST['usuario'];
			$usuario["'fk_instituicao'"] = procurar('instituicao','nome',$usuario["'fk_instituicao'"]);
			update('usuario', $usuario["'id_usuario'"], $usuario);
			header('location: index.php');exit;
		} else if (isset($_GET['id'])) {
			global $usuario;
			$id = $_GET['id'];
			$usuario = usuario_inst($id);
		}else {
			header('location: index.php');exit;
		}
	}
	//adiciona a intituição do usuario
	function addInst() {
		if (!empty($_POST['instituicao'])) {
			$instituicao = $_POST['instituicao'];
			save('instituicao', $instituicao);
			header('location: add.php');exit;
		}
	}
	//edita usuario
	//visulaiza o usuario
	function view($id = null) {
		global $usuario;
		$usuario = find('usuario', $id);
	}
	//deleta o usuario
	function delete($id = null) {
		global $usuario;
		$usuario = remove('usuario', 'id_usuario', $id);
		header('location: usuarios.php');	exit;
	}

?>
