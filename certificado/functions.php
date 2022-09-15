<?php
	require_once('../config.php');
	require_once(DBAPI);
	$areas = null;
	$projetos = null;
	$projeto = null;
	$usuarios = null;
	$autores = null;
	$avaliadores = null;
	session_start();
	function index() {
		global $projetos;
		$projetos = projeto_area();
	}

	function getItens($id=null){
		global $projeto;
		$projeto = findAnyThing('projeto','id_projeto', $id);
		getUsuarios($id);
	}
	function getUsuarios($id){
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
	}

	function getAvaliadores(){
		global $avaliadores;
		$avaliadores = allAvaliadores();
	}
	function getUsers(){
		global $avaliadores;
		$avaliadores = allusers();
	}
    
    function getAdhoc(){
		global $avaliadores;
		$avaliadores = find('adhoc');
	}
	function getAvaliadorProjetos($id){
		global $projetos;
		$projetos = avaliadorProjetos($id);
	}

	function getProjetos() {
		global $projetos;
		$projetos = projeto_area();
	}
?>
